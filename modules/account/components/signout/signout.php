<?php
namespace App\Modules\Account\Components\Signout;

use App\Modules\Account\Services\AuthenticationService;

class Signout {
	 private $auth_service;
    
     public function __construct(){
         $this->auth_service = resolve(AuthenticationService::class);
     }

	 public function signout() {
	 	 $this->auth_service->logout();
	 	 
	 	 redirect(ROOT_DOMAIN);
	 	 
	 	 return ok();
	 }
}
?>