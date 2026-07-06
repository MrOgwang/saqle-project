<?php

namespace App\Modules\Account\Models;

use SaQle\Auth\Models\BaseUser;
use App\Utils\FileUtils;
use SaQle\Orm\Entities\Model\Schema\Table;

class User extends BaseUser {

	 protected function table_schema(Table $table) : void {

	 	 $upload_to = function(mixed $user){
	 	 	 return saqle_dir()->path('users.profiles', $user->get_data());
	 	 };

	 	 $default_url = function(mixed $user){
	 	 	 return $user->gender == "female" ? 
	 	 	 config('root_domain')."/public/static/images/layout/female.jpg" : 
	 	 	 config('root_domain')."/public/static/images/layout/male.jpg";
	 	 };

	 	 $rename = function(mixed $user, string $file_name, int $file_index = 0){
	 	 	 return FileUtils::rename_file($user, $file_name, $file_index, 'user_id', 'profile');
	 	 };

		 $table->fields([
			 'gender' => Table::choice_field([
			 	 'male' => 'Male', 
			 	 'female' => 'Female'
			 ], true)->default('male'),

			 'profilephoto' => Table::image_field()->max_size(2)->upload_to($upload_to)->default_url($default_url)
			  ->rename_to($rename)->depends_on(['user_id', 'gender'])->resize(['max_width' => 500, 'max_height' => 500]),

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