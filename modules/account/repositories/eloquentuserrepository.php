<?php

namespace App\Modules\Account\Repositories;

use SaQle\Auth\Interfaces\UserRepositoryInterface;
use App\Modules\Account\Models\User;
use SaQle\Auth\Interfaces\UserInterface;

class EloquentUserRepository implements UserRepositoryInterface {

     public function find_by_username(string $username): ?UserInterface {
         return User::find()->where('username__eq', $username)->first_or_null();
     }

}