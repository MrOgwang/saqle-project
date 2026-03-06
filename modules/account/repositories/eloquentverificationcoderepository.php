<?php

namespace App\Modules\Account\Repositories;

use SaQle\Auth\Interfaces\VerificationCodeRepositoryInterface;
use App\Modules\Account\Models\Vercode;

class EloquentVerificationCodeRepository implements VerificationCodeRepositoryInterface {

     public function find_by_code(string $code): ? object {
         return Vercode::get()->where('code__eq', $code)->first_or_default();
     }

     public function find_last_by_contact(string $contact): ?object {
         return Vercode::get()->where('contact__eq', $contact)->last_or_default();
     }

     public function save(string $contact, string $code, int $expires_at, string $type = 'verification') : object {
         return Vercode::create([
             'contact' => $contact,
             'code' => $code,
             'date_expires' => $expires_at,
             'code_type' => $type
         ])->now();
     }
}