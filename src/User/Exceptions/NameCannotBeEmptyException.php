<?php

namespace App\User\Exceptions;

use Exception;

class NameCannotBeEmptyException extends Exception
{
    public function __construct($message = 'Name cannot be empty', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
