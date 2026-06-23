<?php
include_once __DIR__ . '/assets/config.php';

$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

$credentials = base64_encode($consumerKey . ':' . $consumerSecret);

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Authorization: Basic ' . $credentials
]);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
curl_close($curl);

$data = json_decode($response);

if (!isset($data->access_token)) {
    die("Failed to get token. Response: " . $response);
}

echo $data->access_token;
?>