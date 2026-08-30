<?php
namespace App\Modules\Auth\Listeners;

use App\Modules\Auth\Services\AuthenticationService;
use SaQle\Auth\Events\Logout;

final class RecordUserLogOut {
    
     public function __construct(
         private AuthenticationService $auth_service
     ){}

     public function handle(Logout $event): void {
         $user = $event->user;

         if($user){
             $this->auth_service->record_logout($user->user_id);

             $this->auth_service->toggle_online($user->user_id, false);
         }
         
     }
}
