<?php
namespace App\Authentication\Providers;

use SaQle\Core\Services\Providers\ServiceProvider;

class AuthenticationProvider extends ServiceProvider {
     public function register(): void {
         /**
          * Register the user provider. This provides the user object 
          * to be injected into the request. This allows you the chance
          * to define how the session user is fetched and the kind of properties you 
          * want in the user object
          * */
         $this->app->container->singleton(
             UserProviderInterface::class,
             fn() => new SessionUserProvider(config('auth.model_class'))
         );
         
     }
}
?>
