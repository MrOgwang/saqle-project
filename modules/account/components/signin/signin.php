<?php
namespace App\Modules\Account\Components\Signin;

use App\Modules\Account\Services\AuthenticationService;
use SaQle\Auth\Utils\AuthResult;
use SaQle\Http\Response\Message;

class Signin {
	 private $auth_service;
    
     public function __construct(){
         $this->auth_service = resolve(AuthenticationService::class);
     }

	 public function post(
	 	 string $username, 
	 	 string $password,
	 	 ?string $auth_next = null
	 ){
		 $auth_result = $this->auth_service->login('password', ['username' => $username, 'password' => $password]);

		 if($next){
		 	 $auth_result->next = $next;
		 }

		 if(!$auth_result->success)
		 	 bad_request_exception('Invalid Credentials!');

		 $user = $auth_result->user;

         //Is user account disabled
		 if($user->disabled === 1) 
		 	 bad_request_exception('Your account has been disabled. Please consult system administrator');

		 //Is user account deleted
		 if($user->deleted === 1) 
		 	 not_found_exception('Invalid credentials!');

		 return Message::ok($auth_result);
	 }
	 
	 public function get(){
		 return Message::ok(['message' => '']);
	 }
}
?>