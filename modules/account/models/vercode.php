<?php
namespace App\Modules\Account\Models;

use SaQle\Orm\Entities\Model\Schema\{Model, Table};

class Vercode extends Model {
	
	 protected function table_schema(Table $table) : void {

	 	 $table->primary_key("id");

	 	 $table->fields([
		     'code'         => Table::char_field()->required()->length(100),
		     'code_type'    => Table::char_field()->required()->length(50),
		     'contact'      => Table::char_field()->required()->length(200),
		     'date_expires' => Table::datetime_field()
	 	 ]);

	 }
}
