<?php

namespace App\Services\Providers;

use SaQle\Core\Services\Providers\ServiceProvider;
use SaQle\Auth\Interfaces\{
     VerificationCodeRepositoryInterface,
     UserRepositoryInterface,
     ContactRepositoryInterface
};
use App\Modules\Account\Repositories\{
     EloquentVerificationCodeRepository,
     EloquentUserRepository,
     EloquentContactRepository
};

class DIProvider extends ServiceProvider {
     public function register(): void {
         $this->app->container->bind(
             VerificationCodeRepositoryInterface::class, 
             EloquentVerificationCodeRepository::class
         );

         $this->app->container->bind(
             UserRepositoryInterface::class, 
             EloquentUserRepository::class
         );

         $this->app->container->bind(
             ContactRepositoryInterface::class, 
             EloquentContactRepository::class
         );
     }
}
?>
