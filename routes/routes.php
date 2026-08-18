<?php
declare(strict_types = 1);

namespace App\Routes;

use SaQle\Routing\Router;

Router::get("/", 'app.cta')
     ->middleware(['guestonly'])
     ->layout(['app.landing'])
     ->name('app.cta');

Router::get("/about", 'app.about')
     ->middleware(['guestonly'])
     ->layout(['app.landing'])
     ->name('app.about');

Router::get("/waffle", 'app.account.waffle')
     ->middleware(['authentication', 'authorization'])
     ->authorize('authenticated')
     ->name('app.waffle');

?>