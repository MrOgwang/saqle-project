<?php
declare(strict_types = 1);

namespace App\Modules\Account\Routes;

use SaQle\Routes\Router;

Router::match(['GET', 'POST'], "/signin/", 'signin')->compose_with(['landing'])->name(['app.login.form', 'app.login.submit']);
Router::match(['GET', 'POST'], "/signup/", 'signup')->compose_with(['landing'])->name(['app.account.form', 'app.account.submit']);
Router::get("/signout/", 'signout@signout')->name(['app.logout']);

?>