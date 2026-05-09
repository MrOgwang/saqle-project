<?php
namespace App\Middlewares;

use SaQle\Http\Response\Message;
use SaQle\Middleware\MiddlewareInterface;

class AppContextMiddleware implements MiddlewareInterface {
     public function handle($request, $response = null) : ?Message {
         return null;
     }
}
?>