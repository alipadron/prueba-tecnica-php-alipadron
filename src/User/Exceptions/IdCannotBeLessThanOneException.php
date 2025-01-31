<?php

namespace App\User\Exceptions;

use Exception;

class IdCannotBeLessThanOneException extends Exception
{
    public function __construct($message = 'Id cannot be less than one', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
