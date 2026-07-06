<?php
declare(strict_types = 1);

namespace App\Modules\Account\Routes;

use SaQle\Routes\Router;

Router::match(['GET', 'POST'], "/signin/", 'account.signin')
->compose_with(['landing'])
->name(['app.login.form', 'app.login.submit']);

Router::match(['GET', 'POST'], "/signup/", 'account.signup')
->compose_with(['landing'])
->name(['app.account.form', 'app.account.submit']);

Router::get("/signout/", 'account.signout@signout')
->name(['app.logout']);

?>