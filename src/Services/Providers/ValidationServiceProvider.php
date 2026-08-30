<?php
namespace App\Services\Providers;

use SaQle\Core\Services\Providers\ServiceProvider;

use App\Modules\Auth\Validators\{
     FullNameValidator
};

class ValidationServiceProvider extends ServiceProvider {
     public function register(): void {
         $this->app->rules->add('full_name', FullNameValidator::class);
     }
}

