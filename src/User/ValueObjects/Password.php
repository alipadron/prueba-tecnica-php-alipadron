<?php

namespace App\User\ValueObjects;

use App\User\Exceptions\PasswordShouldHaveAtLeastEightCharactersException;
use InvalidArgumentException;

class Password
{
    /**
     * @throws PasswordShouldHaveAtLeastEightCharactersException
     */
    public function __construct(protected string $value)
    {
        if (strlen($value) < 8) {
            self::passwordShouldHaveAtLeastEightCharactersException();
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
     * @throws PasswordShouldHaveAtLeastEightCharactersException
     */
    public static function passwordShouldHaveAtLeastEightCharactersException(): void
    {
        throw new PasswordShouldHaveAtLeastEightCharactersException();
    }
}
