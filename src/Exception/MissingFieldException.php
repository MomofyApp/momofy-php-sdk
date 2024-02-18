<?php

namespace Momofy\Exception;

class MissingFieldException extends \Exception
{
    public function requiredTransactionFields($field)
    {
        $message = "The field '$field' is required.";
        parent::__construct($message);
    }
}
