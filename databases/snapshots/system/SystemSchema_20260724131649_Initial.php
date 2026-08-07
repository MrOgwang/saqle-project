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

class SystemSchema_20260724131649_Initial extends DbSnapshot{
	public function get_models(){
		return [
			'users' => 'App\Modules\Account\Models\User',
			'tenants' => 'SaQle\Auth\Models\BaseTenant',
			'migrations' => 'SaQle\Core\Migration\Models\Migration',
			'tenant_migrations' => 'SaQle\Core\Migration\Models\TenantMigration',
			'sessions' => 'SaQle\Session\Models\Session',
			'queue_failed_jobs' => 'SaQle\Core\Queue\Models\FailedJob',
			'queue_jobs' => 'SaQle\Core\Queue\Models\Job',
			'queue_job_batches' => 'SaQle\Core\Queue\Models\JobBatch',
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
			'tenants' => [
				'tenant_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\UuidField',
					'def' => 'tenant_id VARCHAR(100) PRIMARY KEY NOT NULL',
					'params' => [
					],
				],
				'tenant_name' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharField',
					'def' => 'tenant_name VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'slug' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\SlugField',
					'def' => 'slug VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'url' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\UrlField',
					'def' => 'url VARCHAR(100) NOT NULL',
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
			],
			'migrations' => [
				'migration_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\UuidField',
					'def' => 'migration_id VARCHAR(100) PRIMARY KEY NOT NULL',
					'params' => [
					],
				],
				'migration_name' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\TextField',
					'def' => 'migration_name TEXT NOT NULL',
					'params' => [
					],
				],
				'migration_timestamp' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\IntegerField',
					'def' => 'migration_timestamp BIGINT NOT NULL',
					'params' => [
					],
				],
				'prev_migration_name' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\TextField',
					'def' => 'prev_migration_name TEXT NULL',
					'params' => [
					],
				],
				'prev_migration_timestamp' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\IntegerField',
					'def' => 'prev_migration_timestamp BIGINT NULL',
					'params' => [
					],
				],
				'is_migrated' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\BooleanField',
					'def' => 'is_migrated INT NOT NULL',
					'params' => [
					],
				],
				'type' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\TextField',
					'def' => 'type TEXT NOT NULL',
					'params' => [
					],
				],
			],
			'tenant_migrations' => [
				'migration_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\UuidField',
					'def' => 'migration_id VARCHAR(100) PRIMARY KEY NOT NULL',
					'params' => [
					],
				],
				'tenant_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\OneToOne',
					'def' => 'tenant_id VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'migration_name' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\TextField',
					'def' => 'migration_name TEXT NOT NULL',
					'params' => [
					],
				],
				'migration_timestamp' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\IntegerField',
					'def' => 'migration_timestamp BIGINT NOT NULL',
					'params' => [
					],
				],
				'prev_migration_name' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\TextField',
					'def' => 'prev_migration_name TEXT NULL',
					'params' => [
					],
				],
				'prev_migration_timestamp' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\IntegerField',
					'def' => 'prev_migration_timestamp BIGINT NULL',
					'params' => [
					],
				],
				'is_migrated' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\BooleanField',
					'def' => 'is_migrated INT NOT NULL',
					'params' => [
					],
				],
				'type' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\TextField',
					'def' => 'type TEXT NOT NULL',
					'params' => [
					],
				],
			],
			'sessions' => [
				'id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\UuidField',
					'def' => 'id VARCHAR(100) PRIMARY KEY NOT NULL',
					'params' => [
					],
				],
				'session_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharField',
					'def' => 'session_id VARCHAR(100) NOT NULL',
					'params' => [
					],
				],
				'session_data' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\TextField',
					'def' => 'session_data TEXT NULL',
					'params' => [
					],
				],
			],
			'queue_failed_jobs' => [
				'id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\UuidField',
					'def' => 'id VARCHAR(100) PRIMARY KEY NOT NULL',
					'params' => [
					],
				],
				'job_id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\UuidField',
					'def' => 'job_id VARCHAR(100) NULL',
					'params' => [
					],
				],
				'payload' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\TextField',
					'def' => 'payload LONGTEXT NULL',
					'params' => [
					],
				],
				'exception' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\TextField',
					'def' => 'exception LONGTEXT NULL',
					'params' => [
					],
				],
				'failed_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'failed_at BIGINT NULL',
					'params' => [
					],
				],
			],
			'queue_jobs' => [
				'id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\UuidField',
					'def' => 'id VARCHAR(100) PRIMARY KEY NOT NULL',
					'params' => [
					],
				],
				'queue' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\CharField',
					'def' => 'queue VARCHAR(100) NOT NULL DEFAULT "default"',
					'params' => [
					],
				],
				'payload' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\TextField',
					'def' => 'payload LONGTEXT NULL',
					'params' => [
					],
				],
				'attempts' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\IntegerField',
					'def' => 'attempts INT NULL',
					'params' => [
					],
				],
				'max_attempts' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\IntegerField',
					'def' => 'max_attempts INT NULL DEFAULT 3',
					'params' => [
					],
				],
				'priority' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\IntegerField',
					'def' => 'priority INT NULL',
					'params' => [
					],
				],
				'reserved_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'reserved_at BIGINT NULL',
					'params' => [
					],
				],
				'available_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'available_at BIGINT NULL',
					'params' => [
					],
				],
				'created_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'created_at BIGINT NULL',
					'params' => [
					],
				],
			],
			'queue_job_batches' => [
				'id' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\UuidField',
					'def' => 'id VARCHAR(100) PRIMARY KEY NOT NULL',
					'params' => [
					],
				],
				'total_jobs' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\IntegerField',
					'def' => 'total_jobs MEDIUMINT NULL',
					'params' => [
					],
				],
				'pending_jobs' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\IntegerField',
					'def' => 'pending_jobs MEDIUMINT NULL',
					'params' => [
					],
				],
				'failed_jobs' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\IntegerField',
					'def' => 'failed_jobs MEDIUMINT NULL',
					'params' => [
					],
				],
				'created_at' => [
					'field' => 'SaQle\Orm\Entities\Field\Types\DateTimeField',
					'def' => 'created_at BIGINT NULL',
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
			'tenants' => [
				'basetenant_tenant_name_unique' => [
					'tenant_name',
				],
			],
			'migrations' => [
			],
			'tenant_migrations' => [
			],
			'sessions' => [
			],
			'queue_failed_jobs' => [
			],
			'queue_jobs' => [
			],
			'queue_job_batches' => [
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
			'tenants' => [
			],
			'migrations' => [
			],
			'tenant_migrations' => [
				'tenant_id' => [
					'ref_table' => 'tenants',
					'ref_col' => 'tenant_id',
					'delete_action' => 'restrict',
					'update_action' => 'cascade',
					'local_field' => 'tenant',
					'constraint_name' => 'fk_tenant_migrations_tenant',
				],
			],
			'sessions' => [
			],
			'queue_failed_jobs' => [
			],
			'queue_jobs' => [
			],
			'queue_job_batches' => [
			],
		];
	}

}
