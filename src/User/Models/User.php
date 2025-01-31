<?php

namespace App\User\Models;

use App\User\ValueObjects\Email;
use App\User\ValueObjects\Id;
use App\User\ValueObjects\Name;
use App\User\ValueObjects\Password;


final class User extends Model
{
    protected Id $id;
    protected Name $name;
    protected Email $email;
    protected Password $password;
}
