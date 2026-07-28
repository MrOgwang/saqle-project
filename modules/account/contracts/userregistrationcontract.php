<?php

namespace App\Modules\Account\Contracts;

use SaQle\Core\Support\{
     BindFrom, 
     MapTo,
     Validation,
     RequestContract
};
use SaQle\Core\Files\UploadedFile;
use App\Modules\Account\Models\User;
 
class UserRegistrationContract extends RequestContract {

     #[BindFrom('input')]
     #[MapTo(model: User::class, field: 'first_name,last_name', glue: " ")]  
     #[Validation(rules: ['required:true', 'max_length:100', 'full_name:true'])]
     public string $fullname;

     #[BindFrom('input')] 
     #[Validation(rules: ['required:true', 'email:true'])]
     public string $email;

     #[BindFrom('input')]
     #[MapTo(model: User::class)]
     #[Validation(inherit: true, rules: ['max_length:50'])]
     public string $username;

     #[BindFrom('input')]
     #[MapTo(model: User::class)]
     #[Validation(inherit: true, rules: ['max_length:50'])]
     public string $password;
  
     /**
      * This contract is for self registration.
      * Therefore no permissions required
      * */ 
     protected function authorize(): bool {
         return true;
     }
	 
	 protected function after_validation(){ 
         $fullname = $this->validated_data['fullname'];
         $names = explode(" ", $fullname);

         $this->validated_data['first_name'] = $names[0];
         $this->validated_data['last_name'] = $names[1];
     }
}
