<?php

namespace App\User\Repositories;

use App\User\Contracts\UserRepository;
use App\User\Exceptions\UserNotFoundException;
use App\User\Models\User;
use App\User\ValueObjects\Id;
use Exception;

class InMemoryUserRepository implements UserRepository
{
    protected array $users = [];

    protected int $lastId = 0;

    public function create(User $data): User
    {
        $this->lastId++;
        $data->id = $this->lastId;
        $this->users[$this->lastId] = $data;

        return $data;
    }

    public function update(Id $id, User $data): bool
    {
        try {
            if (!isset($this->users[$id->value()])) {
                return false;
            }

            $this->users[$id->value()] = $data;

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function delete(Id $id): bool
    {
        try {

            if (!isset($this->users[$id->value()])) {
                return false;
            }

            unset($this->users[$id->value()]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function find(Id $id): ?User
    {
        return $this->users[$id->value()] ?? null;
    }

    /**
     * @throws UserNotFoundException
     */
    public function findOrFail(Id $id): User
    {
        if (!isset($this->users[$id->value()])) {
            throw new UserNotFoundException();
        }

        return $this->users[$id->value()];
    }

    public function all(): array
    {
        return $this->users;
    }

    public static function make(): static
    {
        return new static();
    }
}
