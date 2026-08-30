<?php

use SaQle\App\App;
use App\Providers\{
    SharedTemplateContext
};
use SaQle\Core\Support\Environment;
use SaQle\Routing\Middleware\{
     CanonicalUrlMiddleware
};
use SaQle\Http\Request\Middleware\CsrfMiddleware;
use SaQle\Http\Cors\Middlewares\CorsMiddleware;
use SaQle\Http\Request\RequestScope;

 return 
 App::http(dirname(__DIR__, 2))
 ->environment(Environment::DEVELOPMENT)
 ->providers(
     SharedTemplateContext::class
 )
 ->cors(fn($cors) => $cors
     ->allow_origins('*')
     ->allow_credentials()
     ->required_headers(
         'Origin',
         'Host',
         'Referer',
         'Accept',
         'Content-Type'
     )
 )
 ->middleware(function($middleware){ 
     $middleware->add(
         name: 'canonicalurl', 
         class: CanonicalUrlMiddleware::class,
         is_global: true,
         is_api: false
     );

     $middleware->add(
         name: 'cors', 
         class: CorsMiddleware::class,
         is_global: true
     );

     $middleware->add(
         name: 'csrf', 
         class: CsrfMiddleware::class,
         is_global: false,
         is_api: false
     );
 })
 ->build();