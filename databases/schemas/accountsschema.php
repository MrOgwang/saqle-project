<?php
declare(strict_types = 1);

namespace App\Databases\Schemas;

use SaQle\Orm\Database\Schema;
use App\Modules\Account\Models\{
	 User,
	 Contact,
	 Vercode
};

class AccountsSchema extends Schema {

	 protected array $models = [
	  	 'users' => User::class,
	  	 'contacts' => Contact::class,
	  	 'verificationcodes' => Vercode::class

	  	 //list all other tables and models here
	 ];

}
?>