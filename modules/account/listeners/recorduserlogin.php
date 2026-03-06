<?php
namespace App\Modules\Account\Listeners;

use App\Modules\Account\Services\AuthenticationService;
use SaQle\Auth\Events\LoginSucceeded;

final class RecordUserLogIn {
    
     public function __construct(
         private AuthenticationService $auth_service
     ){}

     public function handle(LoginSucceeded $event): void {
         $user = $event->user;

         if($user){
             $this->auth_service->record_login($user->user_id);

             $this->auth_service->toggle_online($user->user_id, true);
         }
         
     }
}
