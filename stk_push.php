<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

/* -------------------------
   GET ACCESS TOKEN
--------------------------*/
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

/* -------------------------
   USER DATA
--------------------------*/
$phone = $_POST['phone'];
$amount = $_POST['amount'];

/* Fix phone format */
if (substr($phone, 0, 1) == '0') {
    $phone = '254' . substr($phone, 1);
}

/* -------------------------
   STK PUSH DATA
--------------------------*/
$shortcode = "174379";
$passkey = "YOUR_PASSKEY"; // MUST BE REAL PASSKEY

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

echo $response;
?>