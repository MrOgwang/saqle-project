<?php

use SaQle\App\App;
use SaQle\Core\Support\Environment;

 return 
 App::console(dirname(__DIR__, 2))
 ->environment(Environment::DEVELOPMENT)
 ->commands(function($commands){

 })
 ->build();