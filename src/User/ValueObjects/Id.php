<?php

namespace App\User\ValueObjects;

use App\User\Exceptions\IdCannotBeLessThanOneException;
use InvalidArgumentException;

class Id
{
    /**
     * @throws IdCannotBeLessThanOneException
     */
    public function __construct(protected int $value)
    {
        if ($value < 1) {
            self::idCannotBeLessThanOneException();
        }
    }

    public function value(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @throws IdCannotBeLessThanOneException
     */
    public static function idCannotBeLessThanOneException(): void
    {
        throw new IdCannotBeLessThanOneException();
    }

}
