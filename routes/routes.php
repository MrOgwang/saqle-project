<?php
declare(strict_types = 1);

namespace App\Routes;

use SaQle\Routes\Router;

Router::resolve('get', '/', HomeResolver::class);

Router::get("/", 'cta')->layout(['landing'])->name('app.landing');

Router::get("/about", 'about')->layout(['landing'])->name('app.about');

?>