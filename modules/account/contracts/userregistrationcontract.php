<?php

namespace App\Modules\Account\Contracts;

use SaQle\Core\Support\{
     BindFrom, 
     RequestContract
};
use SaQle\Core\Files\UploadedFile;

class UserRegistrationContract extends RequestContract {

     #[BindFrom('input', rules: ['required:true', 'max_length:100'])]
     public string $fullname;

     #[BindFrom('input', rules: ['required:true', 'max_length:50'])]
     public string $username;

     #[BindFrom('input', rules: ['required:true', 'max_length:50'])]
     public string $password;

     #[BindFrom('input', rules: ['required:true', 'choices:male,female'])]
     public string $gender;

     #[BindFrom('input', rules: ['required:true', 'mime_types:image/jpg,image/jpeg,image/png', 'max_size:2'])]
     public UploadedFile $profilephoto;

     #[BindFrom('input', rules: ['required:true', 'email:true'])]
     public string $email;

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
