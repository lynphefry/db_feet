<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';



$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

$credentials = base64_encode($consumerKey . ':' . $consumerSecret);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Authorization: Basic ' . $credentials
]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
$data = json_decode($response, true);

$token = $data['access_token'] ?? null;

if (!$token) {
    die("Failed to get access token");
}



$phone = $_POST['phone'];
$amount = $_POST['amount'];


if (substr($phone, 0, 1) == '0') {
    $phone = '254' . substr($phone, 1);
}

   

$shortcode = "174379";
$passkey = "YOUR_PASSKEY"; 

$timestamp = date("YmdHis");

$password = base64_encode($shortcode . $passkey . $timestamp);

$url = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $token
]);

$data = [
    "BusinessShortCode" => $shortcode,
    "Password" => $password,
    "Timestamp" => $timestamp,
    "TransactionType" => "CustomerPayBillOnline",
    "Amount" => $amount,
    "PartyA" => $phone,
    "PartyB" => $shortcode,
    "PhoneNumber" => $phone,
    "CallBackURL" => "https://yourdomain.com/callback.php",
    "AccountReference" => "FeetToFit",
    "TransactionDesc" => "Gym Payment"
];

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
curl_close($curl);

$result = json_decode($response, true);

if (isset($result['ResponseCode']) && $result['ResponseCode'] == "0") {

    $user_id = $_SESSION['user_id'];

    foreach ($_SESSION['cart'] as $item) {

        $quantity = $item['quantity'];
        $total = $item['price'] * $quantity;

        $stmt = $conn->prepare("
            INSERT INTO orders
            (user_id, product_name, quantity, total_price)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "isid",
            $user_id,
            $item['name'],
            $quantity,
            $total
        );

        $stmt->execute();
    }

    // Empty cart
    unset($_SESSION['cart']);

    header("Location: my_orders.php?success=1");
    exit();

} else {

    echo "<h3 class='text-danger text-center mt-5'>
            Payment request failed.
          </h3>";

    echo "<pre>";
    print_r($result);
    echo "</pre>";
}
?>