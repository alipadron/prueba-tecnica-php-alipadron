<?php

namespace App\Core;

use App\Core\Contracts\Container as ContainerContract;
use Closure;
use ReflectionClass;
use ReflectionException;

class Container implements ContainerContract
{

    protected array $bindings = [];

    public function bind(string $abstract, Closure $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
    }

    /**
     * @throws ReflectionException
     */
    public function get(string $abstract)
    {
        if (isset($this->bindings[$abstract])) {
            return $this->bindings[$abstract]();
        }

        return $this->autowire($abstract);
    }

    /**
     * @throws ReflectionException
     */
    public function autowire(string $abstract): mixed
    {
        $reflection = new ReflectionClass($abstract);

        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            return new $abstract;
        }

        $parameters = $constructor->getParameters();

        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependencies[] = $this->get($parameter->getType()->getName());
        }

        return $reflection->newInstanceArgs($dependencies);
    }
}
