<?php

use App\Core\Container;
use App\User\Contracts\UserRepository;
use App\User\Models\User;
use App\User\Repositories\InMemoryUserRepository;
use App\User\ValueObjects\Id;

beforeEach(function () {
    $this->container = new Container();

    $this->container->bind(UserRepository::class, function () {
        return InMemoryUserRepository::make();
    });

    $this->repository = $this->container->get(UserRepository::class);

    $this->user = User::make([
        'name' => 'John Doe',
        'email' => 'jhondoe@example.com',
        'password' => 'password',
    ]);
});

it('should create a user', function () {

    $user = $this->user;

    $this->repository->create($user);

    expect($this->repository->all())->toHaveCount(1)
        ->and($this->repository->find(new Id(1)))->toBe($user)
        ->and($user->id->value())->toBe(1);
});

it('should update a user', function () {
    $user = $this->user;

    $createdUser = $this->repository->create($user);

    $createdUser->name = 'Changed Name';

    $updated = $this->repository->update(new Id(1), $createdUser);

    expect($updated)->toBeTrue()
        ->and($this->repository->find(new Id(1))->name->value())->toBe('Changed Name');

    $updated = $this->repository->update(new Id(1_000_000), $createdUser);

    expect($updated)->toBeFalse();
});

it('should delete a user', function () {
    $user = $this->user;

    $this->repository->create($user);

    $deleted = $this->repository->delete(new Id(1));

    expect($deleted)->toBeTrue()
        ->and($this->repository->all())->toHaveCount(0);

    $deleted = $this->repository->delete(new Id(1_000_000));

    expect($deleted)->toBeFalse();
});

it('should find a user', function () {
    $user = $this->user;

    $this->repository->create($user);

    $found = $this->repository->find(new Id(1));

    expect($found)->toBe($user);

    $found = $this->repository->find(new Id(1_000_000));

    expect($found)->toBeNull();
});

it('should return all users', function () {
    $user = $this->user;

    /**
     * @var User $created
     */
    $created = $this->repository->create($user);

    $users = $this->repository->all();

    expect($users)->toHaveCount(1)
        ->and($users[$created->id->value()])->toBe($created);
});

it('should throw an exception when user is not found', function () {
    $this->repository->findOrFail(new Id(1));
})->throws(App\User\Exceptions\UserNotFoundException::class);
