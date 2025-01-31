<?php

use App\User\Exceptions\InvalidEmailException;
use App\User\Exceptions\NameCannotBeEmptyException;
use App\User\Exceptions\PasswordShouldHaveAtLeastEightCharactersException;
use App\User\Models\User;

it('instantiates a user', function () {
    expect(User::make())->toBeInstanceOf(User::class)
        ->and(new User())->toBeInstanceOf(User::class);
});

it('creates a user using attributes', function () {
    $user = User::make([
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password',
    ]);

    expect($user->name->value())->toBe('John Doe')
        ->and($user->email->value())->toBe('johndoe@example.com')
        ->and($user->password->value())->toBe('password');
});

it('creates a user then assigns attributes', function () {
    $user = User::make();

    $user->name = 'John Doe';
    $user->email = 'johndoe@example.com';
    $user->password = 'password';

    expect($user->name->value())->toBe('John Doe')
        ->and($user->email->value())->toBe('johndoe@example.com')
        ->and($user->password->value())->toBe('password');
});

it(
    'throws an exception when creating a user with an empty name',
    function () {
        $user = User::make();

        $user->name = '';
    }
)->throws(NameCannotBeEmptyException::class);

it(
    'throws an exception when creating a user with password less than eight characters',
    function () {
        $user = User::make();

        $user->password = 'pass';
    }
)->throws(PasswordShouldHaveAtLeastEightCharactersException::class);

it('throws an exception when creating a user with an invalid email', function () {
    $user = User::make();

    $user->email = 'invalid-email';
})->throws(InvalidEmailException::class);
