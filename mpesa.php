<?php
require_once __DIR__ . "/config.php";
function getAccessToken()
{
    $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

    $credentials = base64_encode(CONSUMER_KEY . ":" . CONSUMER_SECRET);

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Authorization: Basic " . $credentials
    ]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        die("cURL Error: " . curl_error($curl));
    }

    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    $result = json_decode($response);

    if ($httpCode == 200 && isset($result->access_token)) {
        return $result->access_token;
    }

    echo "<h3>HTTP Status: $httpCode</h3>";
    echo "<pre>";
    print_r($result);
    echo "</pre>";

    die("Failed to get access token.");
}
?>