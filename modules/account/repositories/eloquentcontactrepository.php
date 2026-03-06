<?php

namespace App\Modules\Account\Repositories;

use SaQle\Auth\Interfaces\ContactRepositoryInterface;
use App\Modules\Account\Models\Contact;

class EloquentContactRepository implements ContactRepositoryInterface {

     public function exists(string $contact, ?string $type = null, ?string $owner_type = null) : bool {
         $query = Contact::get()->where('contact__eq', $contact);
         
         if($type){
             $query->where('contact_type__eq', $type);
         }

         if($owner_type){
             $query->where('owner_type__eq', $owner_type);
         }

         return $query->first_or_null() ? true : false;
     }

}