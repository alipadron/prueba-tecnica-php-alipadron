<?php

namespace App\User\Contracts;

use App\User\Models\User;
use App\User\ValueObjects\Id;

interface UserRepository
{
    public function create(User $data): User;
    public function update(Id $id, User $data): bool;
    public function delete(Id $id): bool;
    public function find(Id $id): ?User;
    public function findOrFail(Id $id): User;
    public function all(): array;
    public static function make(): static;
}
