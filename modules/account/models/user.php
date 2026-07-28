<?php

namespace App\Modules\Account\Models;

use SaQle\Auth\Models\BaseUser;
use App\Utils\FileUtils;
use SaQle\Orm\Entities\Model\Schema\Table;

class User extends BaseUser {

	 protected function table_schema(Table $table) : void {

		 $table->fields([
			 'gender' => Table::choice_field([
			 	 'male' => 'Male', 
			 	 'female' => 'Female'
			 ], true)->default('male'),
			 
			 'online' => Table::boolean_field()->default(false),

			 'account_status' => Table::choice_field([
			 	 'New', 
			 	 'Onboarding', 
			 	 'Active', 
			 	 'Disabled'
			 ], true)->default(0)
		 ]);

		 parent::table_schema($table);
	 }
}
?>