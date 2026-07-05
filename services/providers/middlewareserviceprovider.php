<?php
namespace App\Services\Providers;

use SaQle\Core\Services\Providers\ServiceProvider;
use App\Middlewares\GuestOnlyMiddleware;
use SaQle\Http\Request\RequestScope;

class MiddlewareServiceProvider extends ServiceProvider {

     public function register(): void {

         //register middleware
         $this->app->middleware->add('guestonly', GuestOnlyMiddleware::class, RequestScope::WEB);

         //assign middlware
         $this->app->middleware->request([
             'guestonly' => ['tsandcs', 'app.login.form', 'app.login.submit', 'account.create.form', 'account.create.submit']
         ]);

         $this->app->middleware->response([
             
         ]);
     }
}

