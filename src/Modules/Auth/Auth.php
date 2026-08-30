<?php

namespace App\Modules\Auth;

use SaQle\Core\Modules\{
	 Module,
	 ModuleBuilder
};
use SaQle\App\App;
use SaQle\Core\Services\Providers\ServiceProvider;
use SaQle\Auth\Interfaces\{
     VerificationCodeRepositoryInterface,
     UserRepositoryInterface,
     ContactRepositoryInterface,
     UserRegistrationInterface
};
use App\Modules\Auth\Repositories\{
     EloquentVerificationCodeRepository,
     EloquentUserRepository,
     EloquentContactRepository
};
use App\Modules\Auth\Services\UserRegistrationService;
use App\Modules\Auth\Validators\FullNameValidator;
use SaQle\Auth\Events\{
     LoginSucceeded, 
     Logout
};
use App\Modules\Auth\Listeners\{
     RecordUserLogIn, 
     RecordUserLogOut
};
use App\Modules\Auth\Models\User;
use SaQle\Auth\Guards\Guard;
use SaQle\Auth\Exceptions\AuthenticationException;
use App\Modules\Auth\Middleware\GuestOnlyMiddleware;
use SaQle\Auth\Middleware\{
      AuthorizationMiddleware,
      AuthenticationMiddleware
};

class Auth extends Module {

	 public function register(App $app): void {

	 	 //register to DI container
	 	 $app->container->bind(
             VerificationCodeRepositoryInterface::class, 
             EloquentVerificationCodeRepository::class
         );

         $app->container->bind(
             UserRepositoryInterface::class, 
             EloquentUserRepository::class
         );

         $app->container->bind(
             ContactRepositoryInterface::class, 
             EloquentContactRepository::class
         );

         $app->container->bind(
             UserRegistrationInterface::class, 
             UserRegistrationService::class
         );

         //register guards
         $app->guards->add(
             'authenticated', 

             function(?User $user = null){
                 return $user ? true : false;
             },

             function($request){
                 if($request->is_web_request()){
                     redirect(route('app.login.form', [], ['next' => $request->uri()]));
                 }

                 throw new AuthenticationException('User not authenticated!');
             } 
         );

         //register validators
         $app->rules->add('full_name', FullNameValidator::class);

         //register events
         $app->events->add(LoginSucceeded::class, [
             RecordUserLogIn::class
         ]);

         $app->events->add(Logout::class, [
             RecordUserLogOut::class
         ]);

         //register http middleware
         $app->http_middleware->add('authentication', AuthenticationMiddleware::class, false);
         $app->http_middleware->add('authorization', AuthorizationMiddleware::class, false);
         $app->http_middleware->add('guestonly', GuestOnlyMiddleware::class, false, false);

     } 

}