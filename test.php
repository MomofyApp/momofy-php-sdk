<?php
use Momofy\MomofyClient;

require_once 'vendor/autoload.php';

// Make Request

$customer = new Momofy\Customer("Kojo","kojo@yahoo.com","1234567890");

$amount = 100;
$channel = "mobile_money";
$currency = "GHS";
$provider = "MTN";
$referenceCode = "1234567890";
$transactionNote = "Payment for goods";

$client = new MomofyClient();
$response = $client->requestPayment($amount, $channel, $currency, $customer, $provider, $referenceCode, $transactionNote);
echo $response;

// Verify Transaction

$transactionReference = "1234567890";
$response = $client->verifyTransaction($transactionReference);
echo $response;

// List Transactions

$page = 0;
$size = 100;
$response = $client->listTransactions($page, $size);
echo $response;
?>
