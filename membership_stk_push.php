<?php
include 'includes/auth.php';
include 'includes/db.php';
require_once "config.php";
require_once "mpesa.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: membership.php");
    exit();
}

$phone = trim($_POST['phone']);
$amount = (int)$_POST['amount'];
$plan = $_POST['plan'];

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
    "Amount" => $amount,
    "PartyA" => $phone,
    "PartyB" => BUSINESS_SHORTCODE,
    "PhoneNumber" => $phone,
    "CallBackURL" => CALLBACK_URL,
    "AccountReference" => $plan,
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

if (curl_errno($curl)) {
    die(curl_error($curl));
}

curl_close($curl);

$result = json_decode($response);

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

<?php if(isset($result->ResponseCode) && $result->ResponseCode == "0"){ ?>

<div class="alert alert-success">
<h3>✅ Payment Request Sent Successfully</h3>

<p>Please check your phone and enter your M-PESA PIN.</p>

<p><strong>Plan:</strong> <?= htmlspecialchars($plan) ?></p>

<p><strong>Amount:</strong> Ksh <?= number_format($amount) ?></p>

</div>

<?php } else { ?>

<div class="alert alert-danger">

<pre><?php print_r($result); ?></pre>

</div>

<?php } ?>

<a href="membership.php" class="btn btn-primary">
Back
</a>

</div>

<?php include 'includes/footer.php'; ?>