<?php

namespace App\User\Actions;

use App\User\Contracts\UserRepository;
use App\User\Models\User;

class CreateUser
{
    public function __construct(
        protected UserRepository $repository,
    ) {
    }

    public function handle(array $data): User
    {
        $user = User::make($data);

        return $this->repository->create($user);
    }
}
