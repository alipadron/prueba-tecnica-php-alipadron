<?php

namespace App\User\Exceptions;

use Exception;

class PasswordShouldHaveAtLeastEightCharactersException extends Exception
{
    public function __construct($message = 'Password should have at least eight characters', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
