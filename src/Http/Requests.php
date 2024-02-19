<?php

namespace Momofy\Http;

use Momofy\Momofy\Momofy;

class Requests
{
    public function requestPayment($referenceCode, $amount, $channel, $currency, $customerData, $provider, $transactionNote)
    {
        $url = Momofy::API_V1_URL . "transactions/request";
        $data = [
            "amount" => $amount,
            "channel" => $channel,
            "currency" => $currency,
            "customer" => [
                "name" => $customerData['name'],
                "email" => $customerData['email'],
                "phoneNumber" => $customerData['phoneNumber']
            ],
            "provider" => $provider,
            "reference_code" => $referenceCode ?: null,
            "transaction_note" => $transactionNote
        ];

        $data_string = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            'Authorization: Bearer ' . Momofy::$secret_key
        ]);
        $response = curl_exec($ch);

        if ($response === false) {
            throw new \Exception(curl_error($ch));
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}
