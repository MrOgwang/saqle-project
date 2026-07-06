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
use SaQle\Core\Support\Environment;

return function(array $overrides = []){
     return new App(new AppSetup(

         base_path: dirname(__DIR__),

         framework_path: realpath(dirname(__DIR__).'/../saqle'),

         document_root: __DIR__.'/../public',

         environment: Environment::DEVELOPMENT,

         config_dir: dirname(__DIR__).'/config',

         cors: $overrides['cors'] ?? [
             'required_headers' => ['Origin', 'Host', 'Referer', 'Accept', 'Content-Type'],
             'credentials'      => true,
             'origins'          => ['*']
         ],

         providers: $overrides['providers'] ?? [
             DIProvider::class,
             AuthorizationProvider::class,
             TemplateContextProvider::class,
             EventServiceProvider::class,
             ValidationServiceProvider::class,
             MiddlewareServiceProvider::class
         ],
     ));
};