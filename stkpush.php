<?php

require_once "config.php";
require_once "mpesa.php";

$accessToken = getAccessToken();

$timestamp = date("YmdHis");

$password = base64_encode(
    BUSINESS_SHORTCODE .
    PASSKEY .
    $timestamp
);

$data = array(
    "BusinessShortCode" => BUSINESS_SHORTCODE,
    "Password" => $password,
    "Timestamp" => $timestamp,
    "TransactionType" => "CustomerPayBillOnline",
    "Amount" => 1,
    "PartyA" => "254714775388",
    "PartyB" => BUSINESS_SHORTCODE,
    "PhoneNumber" => "254714775388",
    "CallBackURL" => CALLBACK_URL,
    "AccountReference" => "FEET TO FIT",
    "TransactionDesc" => "Gym Membership Payment"
);

$url = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Authorization: Bearer ".$accessToken
));

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);

curl_close($curl);

echo "<pre>";
print_r(json_decode($response));
echo "</pre>";

?>