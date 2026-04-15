<?php
namespace App\Middlewares;

use SaQle\Middleware\IMiddleware;
use SaQle\Http\Response\Response;
use SaQle\Http\Request\Request;
use SaQle\Auth\Guards\Guard;

class GuestOnlyMiddleware extends IMiddleware {
     public function handle(Request $request, ?Response $response = null){

         if(Guard::check('authenticated', $request->user)){
             redirect(config('app.root_domain'));
         }

         parent::handle($request, $response);
     }
}
?>