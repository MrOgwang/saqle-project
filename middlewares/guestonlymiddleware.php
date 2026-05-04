<?php
namespace App\Middlewares;

use SaQle\Http\Response\HttpMessage;
use SaQle\Middleware\MiddlewareInterface;
use SaQle\Auth\Guards\Guard;

class GuestOnlyMiddleware implements MiddlewareInterface {
     public function handle($request, $response = null) : ?HttpMessage {

         if(Guard::check('authenticated', $request->user)){
             return redirect(config('app.root_domain'));
         }

         return null;
     }
}
?>