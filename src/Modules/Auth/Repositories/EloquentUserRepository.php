<?php

namespace App\Modules\Auth\Repositories;

use SaQle\Auth\Interfaces\UserRepositoryInterface;
use App\Modules\Auth\Models\User;
use SaQle\Auth\Identity\User\Interfaces\UserInterface;

class EloquentUserRepository implements UserRepositoryInterface {

     public function find_by_username(string $username): ?UserInterface {
         return User::find()->where('username__eq', $username)->first_or_null();
     }

}