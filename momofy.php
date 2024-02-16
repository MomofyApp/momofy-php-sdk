<?php

namespace Momofy;

interface IMomofyClient
{
    public function requestPayment($amount, $channel, $currency, $customer, $provider, $referenceCode, $transactionNote);
    public function verifyTransaction($transactionReference);
    public function listTransactions($page = 0, $size = 100);
}

class Customer
{
    public $name;
    public $email;
    public $phoneNumber;

    function __construct($name, $email, $phoneNumber)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }
}

$customer = new Customer("", "", "");

class MomofyClient implements IMomofyClient
{
    public function requestPayment($amount, $channel, $currency, $customer, $provider, $referenceCode, $transactionNote)
    {

        $url = "https://api.momofy.com/transactions/request";
        $data = array(
            "amount" => $amount,
            "channel" => $channel,
            "currency" => $currency,
            "customer" => array(
                "name" => $customer->name,
                "email" => $customer->email,
                "phoneNumber" => $customer->phoneNumber
            ),
            "provider" => $provider,
            "referenceCode" => $referenceCode,
            "transactionNote" => $transactionNote
        );

        $data_string = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            'Authorization: Bearer ' . SECRET_KEY
        ));
        $result = curl_exec($ch);
        return $result;
    }

    /**
     * Use this method to verify a transaction
     * @param $transactionReference
     */

    public function verifyTransaction($transactionReference)
    {
        $url = "https://api.momofy.com/transactions/verify/" . $transactionReference;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . SECRET_KEY
        ));
        $result = curl_exec($ch);
        return $result;
    }

    public function listTransactions($page = 0, $size = 100)
    {
        $url = "https://api.momofy.com/transactions?page=" . $page . "&size=" . $size;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . SECRET_KEY
        ));
        $result = curl_exec($ch);
        return $result;
    }
}
