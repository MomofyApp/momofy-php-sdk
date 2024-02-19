<?php

namespace Momofy;

use Momofy\Exception\MissingFieldException;
use Momofy\Exception\ValidTransactionMethod;
use Momofy\Http\Requests;

class Transaction
{
    private $amount;
    private $channel;
    private $currency;
    private $customer;
    private $provider;
    private $referenceCode;
    private $transactionNote;
    private $email;
    private $phone;

    /**
     * @throws \Exception
     */
    public function amount($amount): Transaction
    {
        $this->amount = ValidTransactionMethod::validPaymentAmount($amount);
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function channel($channel): Transaction
    {
        $this->channel = ValidTransactionMethod::validPaymentChannel($channel);
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function currency($currency): Transaction
    {
        $this->currency = ValidTransactionMethod::validPaymentCurrency($currency);
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function phone($phone): Transaction
    {
        $this->phone = ValidTransactionMethod::validPhoneNumber($phone);
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function email($email): Transaction
    {
        $this->email = ValidTransactionMethod::validEmailAddress($email);
        return $this;
    }

    public function customer($customer): Transaction
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function provider($provider): Transaction
    {
        $this->provider = ValidTransactionMethod::validPaymentProvider($provider);
        return $this;
    }

    public function reference($referenceCode): Transaction
    {
        $this->referenceCode = $referenceCode;
        return $this;
    }

    public function note($transactionNote): Transaction
    {
        $this->transactionNote = $transactionNote;
        return $this;
    }

    /**
     * @throws MissingFieldException
     */
    private function validateFields()
    {
        $requiredFields = ['amount', 'channel', 'currency', 'customer', 'provider', 'transactionNote'];
        foreach ($requiredFields as $field) {
            if (empty($this->$field)) {
                throw new MissingFieldException($field);
            }
        }
    }

    /**
     * @throws MissingFieldException
     */
    public function request()
    {
        $this->validateFields();
        $request = new Requests();
        $customerData = ["name" => $this->customer,
            "email" => $this->email,
            "phoneNumber" => $this->phone];

//        return $customerData;
        return $request->requestPayment($this->referenceCode, $this->amount, $this->channel, $this->currency, $customerData, $this->provider, $this->transactionNote);
//        return [
//            'amount' => $this->amount,
//            'channel' => $this->channel,
//            'currency' => $this->currency,
//            'customer' => $this->customer,
//            'provider' => $this->provider,
//            'referenceCode' => $this->referenceCode,
//            'transactionNote' => $this->transactionNote,
//        ];
    }

}
