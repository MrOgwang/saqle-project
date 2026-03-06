<?php
namespace App\Middlewares;

use SaQle\Middleware\IMiddleware;
use SaQle\Middleware\MiddlewareRequestInterface;
use App\Modules\Account\Models\User;

class AppContextMiddleware extends IMiddleware {
     public function handle(MiddlewareRequestInterface $request){
         //attach contextual app data here

         //$request->session->set('key', 'value');
        
         parent::handle($request);
     }
}
?>