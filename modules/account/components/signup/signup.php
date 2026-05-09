<?php
namespace App\Modules\Account\Components\Signup;

use App\Modules\Account\Services\{
	 UserRegistrationService, 
	 AuthenticationService
};
use App\Modules\Account\Contracts\UserRegistrationContract;
use SaQle\Http\Response\Message;

class Signup {
	 
	 private $reg_service;
	 private $auth_service;
    
     public function __construct(){
     	 /**
     	  * Note: It is important to manually resolve services, especially
     	  * when you have service methods that emit generic events events.
     	  * 
     	  * The service is wrapped in a proxy, and may not always work with
     	  * type hinting and auto wiring!
     	  * */
         $this->reg_service = resolve(UserRegistrationService::class);
         $this->auth_service = resolve(AuthenticationService::class);
     }

	 public function post(UserRegistrationContract $reg_contract){
	 	 $result = $this->reg_service->register(...$reg_contract->validated());
		 $this->auth_service->login('password', ['username' => $result->username, 'password' => $result->password]);

		 return Message::redirect(config('app.root_domain'))->as_get();
	 }
    
	 public function get(?string $name = null, ?string $code = null){
		 return Message::ok([
		 	 'name'          => $name,
             'code'          => $code,
             'fullname'      => '', 
             'contact'       => '',
             'username'      => '',
             'password'      => ''
         ]);
	 }
}
?>