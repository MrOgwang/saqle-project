<?php
namespace App\Authorization\Providers;

use SaQle\Core\Services\Providers\ServiceProvider;
use App\Modules\Account\Models\User;
use SaQle\Auth\Guards\Guard;

class AuthorizationProvider extends ServiceProvider {
     public function register(): void {

         $this->app->guards->add(
             'authenticated', 

             function(?User $user = null){
                 return $user ? true : false;
             },

             function($request){
                 if($request->is_web_request()){
                     $request->session->set('auth.next', $request->uri(), true);
                     redirect(route('app.login.form'));
                 }

                 throw new AuthenticationException('User not authenticated!');
             } 
         );

     }
}
?>
