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

$result = json_decode($response);

echo $result->access_token;