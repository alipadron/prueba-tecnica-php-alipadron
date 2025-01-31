<?php

namespace App\User\ValueObjects;

use App\User\Exceptions\InvalidEmailException;
use InvalidArgumentException;

class Email
{
    /**
     * @throws InvalidEmailException
     */
    public function __construct(protected string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            self::invalidEmailException();
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @throws InvalidEmailException
     */
    public static function invalidEmailException(): void
    {
        throw new InvalidEmailException();
    }
}
