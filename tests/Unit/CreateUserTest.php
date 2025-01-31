<?php

use App\Core\Container;
use App\User\Contracts\UserRepository;
use App\User\Repositories\InMemoryUserRepository;

beforeEach(function () {
    $this->container = new Container();
    $this->container->bind(UserRepository::class, fn () => new InMemoryUserRepository());
});

it('can create a user', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password',
    ];

    /**
     * @var App\User\Actions\CreateUser $action
     */
    $action = $this->container->get(App\User\Actions\CreateUser::class);

    $user = $action->handle($data);

    expect($user->name->value())->toBe('John Doe')
        ->and($user->email->value())->toBe('johndoe@example.com')
        ->and($user->password->value())->toBe('password')
    ;
});
