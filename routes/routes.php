<?php
declare(strict_types = 1);

namespace App\Routes;

use SaQle\Routes\Router;

Router::resolve('get', '/', HomeResolver::class);

Router::get("/", 'cta')->compose_with(['landing'])->name('app.landing');

Router::get("/about/", 'about')->compose_with(['landing'])->name('app.about');

?>