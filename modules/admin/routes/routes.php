<?php
declare(strict_types = 1);

namespace App\Modules\Account\Routes;

use SaQle\Routes\Router;

Router::get("/backoffice/dashboard/", 'dashboard')
->compose_with(['app'])
->name("admin.dashboard.show");

?>