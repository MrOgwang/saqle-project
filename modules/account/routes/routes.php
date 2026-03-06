<?php
declare(strict_types = 1);

namespace App\Modules\Account\Routes;

use SaQle\Routes\Router;

Router::match(['GET', 'POST'], "/signin/", 'signin')->compose_with(['landing']);
Router::match(['GET', 'POST'], "/signup/", 'signup')->compose_with(['landing']);
Router::get("/signout/", 'signout@signout');

?>