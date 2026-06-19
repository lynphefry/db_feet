<?php

// Get raw callback response from Safaricom
$callbackJSON = file_get_contents('php://input');

// Save it for debugging first (VERY IMPORTANT)
$logFile = "mpesa_callback_log.txt";
file_put_contents($logFile, $callbackJSON . PHP_EOL, FILE_APPEND);

// Convert JSON to PHP array
$callbackData = json_decode($callbackJSON, true);

// Check if payment was successful
$resultCode = $callbackData['Body']['stkCallback']['ResultCode'] ?? null;

if ($resultCode == 0) {

    $amount = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
    $mpesaReceipt = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
    $phone = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];

    // Save to database later (for now just log it)
    file_put_contents("success_log.txt",
        "Paid: $amount | Receipt: $mpesaReceipt | Phone: $phone" . PHP_EOL,
        FILE_APPEND
    );

} else {

    file_put_contents("failed_log.txt",
        "Payment Failed" . PHP_EOL,
        FILE_APPEND
    );
}

echo "Callback received successfully";
?>