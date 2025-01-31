<?php

namespace App\Core\Contracts;

use Closure;

interface Container
{
    public function bind(string $abstract, Closure $concrete): void;

    public function get(string $abstract);

    public function autowire(string $abstract): mixed;
}
