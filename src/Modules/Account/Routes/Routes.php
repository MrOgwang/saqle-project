<?php
declare(strict_types = 1);

namespace App\Modules\Account\Routes;

use SaQle\Routing\Router;

Router::route("/signup", 'app.account.signup')
     ->layout(['app.landing'])
     ->middleware(['guestonly'])
     ->name("app.signup")
     ->methods(function(){
		 Router::method("GET", "get")->name('form');
		 Router::method("POST", "post")->name('submit');
	 });

Router::route("/signin", 'app.account.signin')
	 ->layout(['app.landing'])
	 ->middleware(['guestonly'])
	 ->name("app.login")
	 ->methods(function(){
		 Router::method("GET", "get")->name('form');
		 Router::method("POST", "post")->name('submit');
	 });

Router::get("/signout", 'app.account.signout@signout')
	 ->middleware(['authentication', 'authorization'])
	 ->authorize('authenticated')
	 ->name('app.logout');

?>