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
	 	 string  $username, 
	 	 string  $password,
	 	 ?string $next = null
	 ){
		 $auth_result = $this->auth_service->login('password', ['username' => $username, 'password' => $password]);

		 if($next){
		 	 $auth_result->next = $next;
		 }

		 if(!$auth_result->success){
		 	 throw bad_request_exception($auth_result->message);
		 }

		 $user = $auth_result->user;

         //is user account disabled
		 if($user->account_status === 3){
		 	 throw bad_request_exception('Account disabled. Consult your system administrator');
		 } 
		 	 
		 //is user account deleted
		 if($user->deleted === 1){

		 	 //here one may want to trigger an account recovery flow instead
		 	 throw not_found_exception('Invalid credentials!');
		 }

		 return Message::ok($auth_result);

		 //return Message::redirect(route('app.waffle'));
	 }
	 
	 public function get(){
		 return Message::ok([
		 	 'message' => flash_from_session('__errors', null)
		 ]);
	 }
}
?>