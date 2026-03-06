<?php
namespace App\Modules\Account\Models;

use SaQle\Orm\Entities\Model\Schema\{Model, Table};

class Login extends Model {
	
	 protected function table_schema(Table $table) : void {

	 	 $table->primary_key('login_id');

	 	 $table->fields([
			 'login_count' => integer_field()->required()->unsigned()->min(1),

			 'login_datetime' => integer_field()->size('big')->required()->unsigned(),

			 'logout_datetime' => integer_field()->size('big')->unsigned(),

			 'login_span' => integer_field()->unsigned()->min(1),

			 'login_location' => char_field()->length(200),

			 'login_device' => char_field()->length(200),

			 'login_browser' => char_field()->length(200),

			 'user_id' => uuid_field()->required()
	 	 ]);

	 }
}
