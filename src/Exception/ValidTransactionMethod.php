<?php

namespace Momofy\Exception;

use Momofy\Momofy\Momofy;

class ValidTransactionMethod
{
    /**
     * @throws \Exception
     */
    public static function validPaymentChannel($channel)
    {
        if (!in_array($channel, ['mobile_money', 'bank'])) {
            throw new \Exception("Payment channel must be a supported channel e.g. mobile_money");
        }
        return $channel;
    }


    /**
     * @throws \Exception
     */
    public static function validPaymentProvider($channel)
    {
        if (isset($channel) && !in_array($channel, Momofy::channels())) {
            throw new \Exception("Payment provider must be a supported channel e.g. 'MTN', 'VODAFONE', 'AIRTELTIGO', 'MPESA', 'OTHERS'");
        }
        return $channel;
    }

    /**
     * @throws \Exception
     */
    public static function validPaymentAmount($amount)
    {
        if (isset($amount) && !is_numeric($amount)) {
            throw new \Exception("Requested amount must be in a  supported format e.g. 10.0 or 1.5 ");
        }
        return $amount;
    }

    /**
     * @throws \Exception
     */
    public static function validPaymentCurrency($currency)
    {
        if (isset($currency) && !in_array($currency, Momofy::currencies())) {
            throw new \Exception("Payment currency must be a supported currency e.g. 'GHS', 'NGN', 'USD'");
        }
        return $currency;
    }

    /**
     * @throws \Exception
     */
    public static function validEmailAddress($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid email address");
        }
        return $email;
    }

    /**
     * @throws \Exception
     */
    public static function validPhoneNumber($phone)
    {
        // Validate phone number format here using a regular expression
        $pattern = "/^\+?[0-9]{7,}$/";
        if (!preg_match($pattern, $phone)) {
            throw new \Exception("Invalid phone number format");
        }
        return $phone;
    }

}
