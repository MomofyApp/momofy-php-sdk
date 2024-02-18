<?php

namespace Momofy\Momofy;

interface IMomofyClientInterface
{
    public function requestPayment($amount, $channel, $currency, $customer, $provider, $referenceCode, $transactionNote);
    public function verifyTransaction($transactionReference);
    public function listTransactions($page = 0, $size = 100);
}