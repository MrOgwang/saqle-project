<?php

declare(strict_types = 1);

namespace App\Databases\Schemas;

use SaQle\Orm\Database\Schema;
use App\Modules\Auth\Auth;

class DefaultDbSchema extends Schema {

	 protected function models() : array {
	 	 return [
	  	     ...Auth::get_models(with_seeders: true)
	 	 ];
	 }

}