<?php
declare(strict_types = 1);

namespace App\Routes;

use SaQle\Routes\Router;

Router::get("/", 'cta')
->middleware(['guestonly'])
->layout(['landing'])
->name('app.landing');

Router::get("/about", 'about')
->middleware(['guestonly'])
->layout(['landing'])
->name('app.about');

Router::get("/waffle", 'account.home')
->middleware(['authentication', 'authorization'])
->authorize('authenticated')
->name('app.waffle');

?>