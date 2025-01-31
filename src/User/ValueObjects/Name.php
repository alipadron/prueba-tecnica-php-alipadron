<?php

namespace App\User\ValueObjects;

use App\User\Exceptions\NameCannotBeEmptyException;
use InvalidArgumentException;

class Name
{
    /**
     * @throws NameCannotBeEmptyException
     */
    public function __construct(protected string $value)
    {
        if (strlen($value) === 0) {
            self::nameCannotBeEmptyException();
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
     * @throws NameCannotBeEmptyException
     */
    public static function nameCannotBeEmptyException(): void
    {
        throw new NameCannotBeEmptyException();
    }
}
