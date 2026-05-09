<?php
namespace App\Modules\Account\Components\Signout;

use App\Modules\Account\Services\AuthenticationService;
use SaQle\Http\Response\Message;

class Signout {
	 private $auth_service;
    
     public function __construct(){
         $this->auth_service = resolve(AuthenticationService::class);
     }

	 public function signout(){
	 	 $this->auth_service->logout();
	 	 return Message::redirect(ROOT_DOMAIN)->as_get();
	 }
}
?>