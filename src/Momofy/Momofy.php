<?php

namespace Momofy\Momofy;

class Momofy
{
    const VERSION = 1.0;
    const API_V1_URL = 'https://api.momofy.com/';
    // your momofy secret key. You can get it from your momofy dashboard
    public static $secret_key = 'secret_test_01HPYBWNJGZNRT8P3DCDJ38DQE';

    public function authentication($secret_key)
    {
        if (!is_string($secret_key) || !(substr($secret_key, 0, 12) === 'secret_test_')) {
            throw new \InvalidArgumentException('A Valid Momofy Secret Key must start with \'secret_test_\'.');
        }
        $this->secret_key = $secret_key;
    }

    public static function currencies(): array
    {
        return [
            'GHS', 'NGN', 'USD'
        ];
    }

    public static function channels(): array
    {
        return [
            'MTN', 'VODAFONE', 'AIRTELTIGO', 'MPESA', 'OTHERS'
        ];
    }

}