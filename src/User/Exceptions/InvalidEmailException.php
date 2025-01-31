<?php

namespace App\User\Exceptions;

use Exception;

class InvalidEmailException extends Exception
{
    public function __construct($message = 'Invalid email address', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
