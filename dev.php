<?php

require 'vendor/autoload.php';

use Momofy\Transaction;


// Instantiate the Transaction class and set values using method chaining
try {
    $transactionData = (new Transaction())
        ->amount("100.00")
        ->channel('mobile_money')
        ->currency('USD')
        ->customer('John Doe')
        ->email('JohnDoe@gmail.com')
        ->phone('024567893')
        ->provider('MTN')
        ->reference('ABC123')
        ->note('Payment for services')
        ->request();

// Do something with $transactionData
    print_r($transactionData);

} catch (Exception $e) {
    echo $e;
}
