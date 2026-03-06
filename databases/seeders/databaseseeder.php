<?php
namespace App\Databases\Seeders;

use SaQle\Core\Migration\Seed\DbSeeder;
use App\Modules\Account\Models\User;

class DatabaseSeeder extends DbSeeder {
	 public static function get_seeds() : array {
		 return [
			 ['model' => User::class, 'file' => "data/users.php"]
		 ];
	 }
}

?>