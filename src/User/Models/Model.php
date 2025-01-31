<?php

namespace App\User\Models;

use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use ReflectionProperty;

abstract class Model
{
    /**
     * @throws Exception
     */
    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->setProperty($key, $value);
        }
    }


    public function __get(string $key)
    {
        return $this->$key;
    }

    /**
     * @throws Exception
     */
    public function __set(string $key, $value): void
    {
        $this->setProperty($key, $value);
    }

    /**
     * @throws Exception
     */
    public static function make(array $attributes = []): static
    {
        return new static($attributes);
    }

    /**
     * @throws Exception
     */
    protected function setProperty(string $key, $value): void
    {
        try {
            $property = new ReflectionProperty($this, $key);

            $type = $property->getType();

            if ($type === null) {
                $this->$key = $value;
                return;
            }

            if ($type->allowsNull() && $value === null) {
                $this->$key = null;
                return;
            }

            if ($type->isBuiltin()) {
                $this->$key = $value;
                return;
            }

            if ($type instanceof ReflectionNamedType) {
                $class = new ReflectionClass($type->getName());

                if ($value instanceof $class) {
                    $this->$key = $value;
                    return;
                }

                if ($class->isInstantiable()) {
                    $this->$key = $class->newInstance($value);
                    return;
                }

                throw new Exception("Property `$key` is an interface and must be an instance of " . $type->getName());
            }

            throw new Exception("Property `$key` is a type that is not supported");
        } catch (ReflectionException) {
            throw new Exception("Property `$key` does not exist in " . static::class);
        }
    }
}
