<?php
namespace App\Middlewares;

use SaQle\Http\Response\Message;
use SaQle\Middleware\RequestMiddleware;
use SaQle\Auth\Guards\Guard;

class GuestOnlyMiddleware implements RequestMiddleware {

     public function before($request) : ? Message {

         if(Guard::check('authenticated', $request->user)){

             if(!str_starts_with($request->uri(), "/waffle")){
                 return redirect(route('app.waffle'));
             }
         }

         return null;
     }

}
?>