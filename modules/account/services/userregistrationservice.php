<?php
namespace App\Modules\Account\Services;

use SaQle\Auth\Interfaces\UserRegistrationInterface;
use SaQle\Core\Support\{Emits, Db};
use SaQle\Auth\Services\{
	 VerificationCodeService, 
	 ContactService, 
	 AccountValidationService
};
use SaQle\Core\Services\IService;
use App\Modules\Account\Models\{User, Contact};

class UserRegistrationService implements IService, UserRegistrationInterface {

	 public function __construct(
	 	 private VerificationCodeService  $code_service,
	 	 private ContactService           $contact_service,
	 	 private AccountValidationService $acc_validation_service
	 ){}

     #[Emits(after: ['user.registered'])]
	 public function register(...$data) : mixed {

         return Db::transaction(function() use ($data){
			 $user = User::create([
			 	 'first_name' => $data['first_name'],
			 	 'last_name' => $data['last_name'],
			 	 'username' => $data['username'],
			 	 'password' => md5($data['password']),
			 	 'is_superuser' => $data['is_superuser'],
			 	 'gender' => $data['gender'],
			 	 'profilephoto' => $data['profilephoto']
			 ])->save();

			 $contact = Contact::create([
			 	 'contact_type' => 'email',
			 	 'contact_class' => 'primary',
			 	 'contact' => $data['email'],
			 	 'owner_type' => 'user',
			 	 'owner_id' => $user->user_id
			 ])->save();

			 return (Object)['user' => $user, 'password' => $data['password'], 'username' => $data['username']];
         });

	 }
}
?>