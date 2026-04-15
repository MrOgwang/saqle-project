<?php

use SaQle\App;
use SaQle\Core\Config\AppSetup;

use App\Services\Providers\{
    TemplateContextProvider,
    DIProvider,
    EventServiceProvider,
    ValidationServiceProvider,
    MiddlewareServiceProvider
};
use App\Authorization\Providers\AuthorizationProvider;
use App\Authentication\Providers\AuthenticationProvider;
use App\Middlewares\{
    AppContextMiddleware
};

use Dotenv\Dotenv;

return function(array $overrides = []) {
     return new App(new AppSetup(

         base_path: dirname(__DIR__),

         framework_path: realpath(dirname(__DIR__).'/../saqle'),

         document_root: __DIR__.'/../public',

         environment: 'development',

         environment_loader: function(string $env){
             Dotenv::createImmutable(dirname(__DIR__).'/env/'.$env)->load();
         },

         config_dir: dirname(__DIR__).'/config',

         cors: $overrides['cors'] ?? [
             'required_headers' => ['Origin', 'Host', 'Referer', 'Accept', 'Content-Type'],
             'credentials'      => true,
         ],

         providers: $overrides['providers'] ?? [
             DIProvider::class,
             AuthorizationProvider::class,
             AuthenticationProvider::class,
             TemplateContextProvider::class,
             EventServiceProvider::class,
             ValidationServiceProvider::class,
             MiddlewareServiceProvider::class
         ],
     ));
};