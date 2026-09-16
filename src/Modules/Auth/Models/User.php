<?php

namespace App\Modules\Auth\Models;

use SaQle\Auth\Models\BaseUser;
use SaQle\Orm\Entities\Model\Schema\Table;
use SaQle\Core\Support\SchemaIndex;

#[SchemaIndex(0)]
class User extends BaseUser {

	 protected function table_schema(Table $table) : void {

		 $table->fields([
			 'gender' => Table::choice_field([
			 	 'male' => 'Male', 
			 	 'female' => 'Female'
			 ], true)->default('male'),
			 
			 'online' => Table::boolean_field()->default(false)
			 ->description("Whether this user is currently logged in or not"),

			 'account_status' => Table::choice_field([
			 	 'New', 
			 	 'Onboarding', 
			 	 'Active', 
			 	 'Disabled'
			 ], true)->default(0),

			 'is_admin' => Table::boolean_field()->default(false)
			 ->description("Whether this user is an administrator or not")
		 ]);

		 parent::table_schema($table);
	 }
}
?>