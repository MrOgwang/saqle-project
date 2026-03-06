<?php
require dirname(__DIR__).'/vendor/autoload.php';

use SaQle\App;
use SaQle\Core\Config\AppSetup;

use App\Services\Providers\{
     TemplateContextProvider,
     DIProvider,
     EventServiceProvider
};
use App\Authorization\Providers\AuthorizationProvider;
use App\Authentication\Providers\AuthenticationProvider;
use App\Middlewares\AppContextMiddleware;

use Dotenv\Dotenv;

$app = new App(new AppSetup(

     base_path: dirname(__DIR__),

     document_root: __DIR__,

     environment: 'development',

     environment_loader: function(string $env){
         Dotenv::createImmutable(dirname(__DIR__).'/env/'.$env)->load();
     },

     config_dir:  dirname(__DIR__).'/config',

     cors: [
         'required_headers' => ['Origin', 'Host', 'Referer', 'Accept', 'Content-Type'],
         'credentials'      => true,
     ],

     middlewares: [
         AppContextMiddleware::class,
     ],

     providers: [
         DIProvider::class,
         AuthorizationProvider::class,
         AuthenticationProvider::class,
         TemplateContextProvider::class,
         EventServiceProvider::class
     ],
));

$app->run();
