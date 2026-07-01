<?php

include 'includes/db.php';

// Get callback JSON from Safaricom
$callbackJSON = file_get_contents("php://input");

// Save raw callback for debugging
file_put_contents("callback_response.json", $callbackJSON);

// Decode JSON
$result = json_decode($callbackJSON, true);

// Check if callback exists
if (isset($result['Body']['stkCallback'])) {

    $callback = $result['Body']['stkCallback'];

    $resultCode = $callback['ResultCode'];
    $resultDesc = $callback['ResultDesc'];

    if ($resultCode == 0) {

        $items = $callback['CallbackMetadata']['Item'];

        $amount = 0;
        $receipt = "";
        $phone = "";
        $transactionDate = "";

        foreach ($items as $item) {

            if ($item['Name'] == "Amount") {
                $amount = $item['Value'];
            }

            if ($item['Name'] == "MpesaReceiptNumber") {
                $receipt = $item['Value'];
            }

            if ($item['Name'] == "PhoneNumber") {
                $phone = $item['Value'];
            }

            if ($item['Name'] == "TransactionDate") {
                $transactionDate = $item['Value'];
            }
        }

        // Save into database
        $sql = "INSERT INTO payments
                (amount, phone, receipt, status)
                VALUES
                ('$amount','$phone','$receipt','Successful')";

        mysqli_query($conn, $sql);

    } else {

        // Save failed transaction
        $sql = "INSERT INTO payments
                (status)
                VALUES
                ('Failed')";

        mysqli_query($conn, $sql);
    }
}

// Tell Safaricom callback received
http_response_code(200);

echo "OK";

?>