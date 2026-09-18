<?php
declare(strict_types = 1);

namespace App\Modules\Auth\Routes;

use SaQle\Routing\Router;

Router::get("/", 'app.auth.cta')
     ->middleware(['guestonly'])
     ->layout(['app.auth.landing'])
     ->name('app.cta');

Router::get("/about", 'app.auth.about')
     ->middleware(['guestonly'])
     ->layout(['app.auth.landing'])
     ->name('app.about');

Router::get("/waffle", 'app.auth.waffle')
     ->middleware(['authentication', 'authorization'])
     ->authorize('authenticated')
     ->name('app.waffle');

Router::route("/signup", 'app.auth.signup')
     ->layout(['app.auth.landing'])
     ->middleware(['guestonly'])
     ->name("app.signup")
     ->methods(function(){
		 Router::method("GET", "get")->name('form');
		 Router::method("POST", "post")->name('submit');
	 });

Router::route("/signin", 'app.auth.signin')
	 ->layout(['app.auth.landing'])
	 ->middleware(['guestonly'])
	 ->name("app.login")
	 ->methods(function(){
		 Router::method("GET", "get")->name('form');
		 Router::method("POST", "post")->name('submit');
	 });

Router::post("/signout", 'app.auth.signout@signout')
	 ->middleware(['authentication', 'authorization'])
	 ->authorize('authenticated')
	 ->name('app.logout');

?>