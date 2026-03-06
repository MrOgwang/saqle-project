<?php
declare(strict_types = 1);

namespace App\Routes;

use SaQle\Routes\Router;

Router::get("/", 'cta')->compose_with(['landing']);
Router::get("/about/", 'about')->compose_with(['landing']);

?>