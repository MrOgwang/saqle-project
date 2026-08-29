<?php
/**
* This is an auto generated file.
*
* The code here is designed to work as is, and must not be modified unless you know what you are doing.
*
* If you find ways that the code can be improved to enhance speed, efficiency or memory, be kind enough
* to share with the author at wycliffomondiotieno@gmail.com or +254741142038. The author will not mind a cup
* of coffee either.
*
* Commands to generate file:
* 1. php manage.php make:migrations
* On your terminal, cd into project root and run the above commands
* 
* A database snapshot keeps a record of the database, tables and columns structures as at the time makemigrations is run.
* */

use SaQle\Core\Migration\Base\DbSnapshot;

class AccountsSchema_20260724131649_Initial extends DbSnapshot{
	public function get_models(){
		return [
			'users' => 'App\Modules\Account\Models\User',
			'contacts' => 'App\Modules\Account\Models\Contact',
			'verificationcodes' => 'App\Modules\Account\Models\Vercode',
		];
	}

	public function get_model_fields(){
		return [
			'users' => [
				'user_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\UuidField',
					'def' => 'user_id VARCHAR(100) PRIMARY KEY NOT NULL',
					'params' => [
					],
				],
				'gender' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharChoiceField',
					'def' => 'gender VARCHAR(100) NULL DEFAULT "male"',
					'params' => [
					],
				],
				'online' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\BooleanField',
					'def' => 'online INT NULL',
					'params' => [
					],
				],
				'account_status' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\IntegerChoiceField',
					'def' => 'account_status INT NULL',
					'params' => [
					],
				],
				'first_name' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharField',
					'def' => 'first_name VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'last_name' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharField',
					'def' => 'last_name VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'username' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharField',
					'def' => 'username VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'password' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\PasswordField',
					'def' => 'password VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'is_super_admin' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\BooleanField',
					'def' => 'is_super_admin INT NOT NULL',
					'params' => [
					],
				],
				'avatar' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\ImageField',
					'def' => 'avatar TEXT NULL',
					'params' => [
					],
				],
				'author_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\OneToOne',
					'def' => 'author_id VARCHAR(100) NULL',
					'params' => [
					],
				],
				'modifier_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\OneToOne',
					'def' => 'modifier_id VARCHAR(100) NULL',
					'params' => [
					],
				],
				'remover_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\OneToOne',
					'def' => 'remover_id VARCHAR(100) NULL',
					'params' => [
					],
				],
				'created_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'created_at BIGINT NULL',
					'params' => [
					],
				],
				'modified_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'modified_at BIGINT NULL',
					'params' => [
					],
				],
				'removed_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'removed_at BIGINT NULL',
					'params' => [
					],
				],
				'is_removed' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\BooleanField',
					'def' => 'is_removed INT NULL',
					'params' => [
					],
				],
			],
			'contacts' => [
				'contact_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\UuidField',
					'def' => 'contact_id VARCHAR(100) PRIMARY KEY NOT NULL',
					'params' => [
					],
				],
				'contact_type' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharChoiceField',
					'def' => 'contact_type VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'contact_class' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharChoiceField',
					'def' => 'contact_class VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'contact' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharField',
					'def' => 'contact VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'owner_type' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharChoiceField',
					'def' => 'owner_type VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'owner_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharField',
					'def' => 'owner_id VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'author_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\OneToOne',
					'def' => 'author_id VARCHAR(100) NULL',
					'params' => [
					],
				],
				'modifier_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\OneToOne',
					'def' => 'modifier_id VARCHAR(100) NULL',
					'params' => [
					],
				],
				'remover_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\OneToOne',
					'def' => 'remover_id VARCHAR(100) NULL',
					'params' => [
					],
				],
				'created_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'created_at BIGINT NULL',
					'params' => [
					],
				],
				'modified_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'modified_at BIGINT NULL',
					'params' => [
					],
				],
				'removed_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'removed_at BIGINT NULL',
					'params' => [
					],
				],
				'is_removed' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\BooleanField',
					'def' => 'is_removed INT NULL',
					'params' => [
					],
				],
			],
			'verificationcodes' => [
				'id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\UuidField',
					'def' => 'id VARCHAR(100) PRIMARY KEY NOT NULL',
					'params' => [
					],
				],
				'code' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharField',
					'def' => 'code VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'code_type' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharField',
					'def' => 'code_type VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'contact' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharField',
					'def' => 'contact VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'date_expires' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'date_expires BIGINT NULL',
					'params' => [
					],
				],
				'author_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\OneToOne',
					'def' => 'author_id VARCHAR(100) NULL',
					'params' => [
					],
				],
				'modifier_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\OneToOne',
					'def' => 'modifier_id VARCHAR(100) NULL',
					'params' => [
					],
				],
				'remover_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\OneToOne',
					'def' => 'remover_id VARCHAR(100) NULL',
					'params' => [
					],
				],
				'created_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'created_at BIGINT NULL',
					'params' => [
					],
				],
				'modified_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'modified_at BIGINT NULL',
					'params' => [
					],
				],
				'removed_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'removed_at BIGINT NULL',
					'params' => [
					],
				],
				'is_removed' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\BooleanField',
					'def' => 'is_removed INT NULL',
					'params' => [
					],
				],
			],
		];
	}

	public function get_unique_constraints(){
		return [
			'users' => [
			],
			'contacts' => [
				'unique_contact_per_person' => [
					'contact',
					'owner_id',
				],
			],
			'verificationcodes' => [
			],
		];
	}

	public function get_fk_constraints(){
		return [
			'users' => [
				'author_id' => [
					'ref_table' => 'users',
					'ref_col' => 'user_id',
					'delete_action' => 'restrict',
					'update_action' => 'cascade',
					'local_field' => 'author',
					'constraint_name' => 'fk_users_author',
				],
				'modifier_id' => [
					'ref_table' => 'users',
					'ref_col' => 'user_id',
					'delete_action' => 'restrict',
					'update_action' => 'cascade',
					'local_field' => 'modifier',
					'constraint_name' => 'fk_users_modifier',
				],
				'remover_id' => [
					'ref_table' => 'users',
					'ref_col' => 'user_id',
					'delete_action' => 'restrict',
					'update_action' => 'cascade',
					'local_field' => 'remover',
					'constraint_name' => 'fk_users_remover',
				],
			],
			'contacts' => [
				'author_id' => [
					'ref_table' => 'users',
					'ref_col' => 'user_id',
					'delete_action' => 'restrict',
					'update_action' => 'cascade',
					'local_field' => 'author',
					'constraint_name' => 'fk_contacts_author',
				],
				'modifier_id' => [
					'ref_table' => 'users',
					'ref_col' => 'user_id',
					'delete_action' => 'restrict',
					'update_action' => 'cascade',
					'local_field' => 'modifier',
					'constraint_name' => 'fk_contacts_modifier',
				],
				'remover_id' => [
					'ref_table' => 'users',
					'ref_col' => 'user_id',
					'delete_action' => 'restrict',
					'update_action' => 'cascade',
					'local_field' => 'remover',
					'constraint_name' => 'fk_contacts_remover',
				],
			],
			'verificationcodes' => [
				'author_id' => [
					'ref_table' => 'users',
					'ref_col' => 'user_id',
					'delete_action' => 'restrict',
					'update_action' => 'cascade',
					'local_field' => 'author',
					'constraint_name' => 'fk_verificationcodes_author',
				],
				'modifier_id' => [
					'ref_table' => 'users',
					'ref_col' => 'user_id',
					'delete_action' => 'restrict',
					'update_action' => 'cascade',
					'local_field' => 'modifier',
					'constraint_name' => 'fk_verificationcodes_modifier',
				],
				'remover_id' => [
					'ref_table' => 'users',
					'ref_col' => 'user_id',
					'delete_action' => 'restrict',
					'update_action' => 'cascade',
					'local_field' => 'remover',
					'constraint_name' => 'fk_verificationcodes_remover',
				],
			],
		];
	}

}
