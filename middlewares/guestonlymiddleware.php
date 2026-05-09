<?php
namespace App\Middlewares;

use SaQle\Http\Response\Message;
use SaQle\Middleware\MiddlewareInterface;
use SaQle\Auth\Guards\Guard;

class GuestOnlyMiddleware implements MiddlewareInterface {
     public function handle($request, $response = null) : ?Message {

         if(Guard::check('authenticated', $request->user)){
             return Message::redirect(config('app.root_domain'))->as_get();
         }

         return null;
     }
}
?>