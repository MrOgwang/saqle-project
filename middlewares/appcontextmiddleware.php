<?php
namespace App\Middlewares;

use SaQle\Http\Response\HttpMessage;
use SaQle\Middleware\MiddlewareInterface;

class AppContextMiddleware implements MiddlewareInterface {
     public function handle($request, $response = null) : ?HttpMessage {
         return null;
     }
}
?>