<?php
namespace App\Services\Providers;

use SaQle\Core\Services\Providers\ServiceProvider;
use App\Middlewares\{
     AppContextMiddleware,
     GuestOnlyMiddleware
};
use SaQle\Http\Request\RequestScope;

class MiddlewareServiceProvider extends ServiceProvider {

     public function register(): void {

         //register middleware
         $this->app->middleware->add('guestonly', GuestOnlyMiddleware::class, RequestScope::WEB);
         $this->app->middleware->add('context', AppContextMiddleware::class);

         //assign middlware
         $this->app->middleware->request([
             'guestonly' => ['tsandcs', 'app.login.form', 'app.login.submit', 'account.create.form', 'account.create.submit'],
             'context'
         ]);

         $this->app->middleware->response([
             
         ]);
     }
}

