<?php

use SaQle\App\App;
use App\Services\Providers\{
    TemplateContextProvider,
    DIProvider,
    EventServiceProvider,
    ValidationServiceProvider
};
use App\Authorization\Providers\AuthorizationProvider;
use SaQle\Core\Support\Environment;
use App\Middlewares\{
     AppContextMiddleware,
     GuestOnlyMiddleware
};
use SaQle\Routing\Middleware\{
     CanonicalUrlMiddleware
};
use SaQle\Http\Request\Middleware\CsrfMiddleware;
use SaQle\Auth\Middleware\{
      AuthorizationMiddleware,
      TenantMiddleware,
      AuthenticationMiddleware
};
use SaQle\Http\Cors\Middlewares\CorsMiddleware;
use SaQle\Http\Request\RequestScope;

 return 
 App::http(dirname(__DIR__))
 ->environment(Environment::DEVELOPMENT)
 ->providers(
     DIProvider::class,
     AuthorizationProvider::class,
     TemplateContextProvider::class,
     EventServiceProvider::class,
     ValidationServiceProvider::class
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

     $middleware->add('authentication', AuthenticationMiddleware::class);
     $middleware->add('canonicalurl', CanonicalUrlMiddleware::class, RequestScope::WEB);
     $middleware->add('cors', CorsMiddleware::class);
     $middleware->add('csrf', CsrfMiddleware::class, RequestScope::WEB);
     $middleware->add('authorization', AuthorizationMiddleware::class);
     //$middleware->add('tenantcontext', TenantMiddleware::class);
     $middleware->add('guestonly', GuestOnlyMiddleware::class, RequestScope::WEB);

     $middleware->global([
         'canonicalurl',
         'cors',
         'csrf',
         //'tenantcontext'
     ]);

 })
 ->build();