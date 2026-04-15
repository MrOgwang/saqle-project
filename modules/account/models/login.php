<?php
namespace App\Modules\Account\Models;

use SaQle\Orm\Entities\Model\Schema\{Model, Table};

class Login extends Model {
	
	 protected function table_schema(Table $table) : void {

	 	 $table->primary_key('login_id');

	 	 $table->fields([
			 'login_count' => Table::integer_field()->required()->unsigned()->min(1),

			 'login_datetime' => Table::integer_field()->size('big')->required()->unsigned(),

			 'logout_datetime' => Table::integer_field()->size('big')->unsigned(),

			 'login_span' => Table::integer_field()->unsigned()->min(1),

			 'login_location' => Table::char_field()->length(200),

			 'login_device' => Table::char_field()->length(200),

			 'login_browser' => Table::char_field()->length(200),

			 'user_id' => Table::uuid_field()->required()
	 	 ]);

	 }
}
