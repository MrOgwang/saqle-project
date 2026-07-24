<?php
declare(strict_types = 1);

namespace App\Modules\Account\Routes;

use SaQle\Routes\Router;

Router::route("/signup", 'account.signup')
->layout(['landing'])
->middleware(['guestonly'])
->name("app.account")
->methods(function(){
	 Router::method("GET", "get")->name('form');
	 Router::method("POST", "post")->name('submit');
});

Router::route("/signin", 'account.signin')
->layout(['landing'])
->middleware(['guestonly'])
->name("app.login")
->methods(function(){
	 Router::method("GET", "get")->name('form');
	 Router::method("POST", "post")->name('submit');
});

Router::get("/signout/", 'account.signout@signout')->name('app.logout');

?>