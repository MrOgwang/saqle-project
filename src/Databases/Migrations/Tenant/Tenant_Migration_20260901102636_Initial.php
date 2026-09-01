<?php
use SaQle\Core\Migration\Base\BaseMigration;

class Tenant_Migration_20260901102636_Initial extends BaseMigration{
	public function get_migration_name() : string {
		return 'Initial';
	}

	public function get_migration_timestamp() : int {
		return '20260901102636';
	}

	public function snapshots() : array {
		return [
			'main.saqle_project' => [
				'path' => 'D:\xampp_lite_8_5\www\saqle-project\src\Databases\Snapshots\Tenant\DefaultDbSchema_20260901102636_Initial.php',
				'name' => 'DefaultDbSchema_20260901102636_Initial',
			],
		];
	}

	public function up() : array {
		return [
			'main.saqle_project' => [
				['action' => 'create_table', 'params' => ['name' => 'users', 'model' => 'App\Modules\Auth\Models\User']],
				['action' => 'create_table', 'params' => ['name' => 'contacts', 'model' => 'App\Modules\Auth\Models\Contact']],
				['action' => 'create_table', 'params' => ['name' => 'logins', 'model' => 'App\Modules\Auth\Models\Login']],
				['action' => 'create_table', 'params' => ['name' => 'verification_codes', 'model' => 'App\Modules\Auth\Models\Vercode']],
			],
		];
	}

	public function down() : array {
		return [
			'main.saqle_project' => [
				['action' => 'drop_table', 'params' => ['name' => 'users', 'model' => 'App\Modules\Auth\Models\User']],
				['action' => 'drop_table', 'params' => ['name' => 'contacts', 'model' => 'App\Modules\Auth\Models\Contact']],
				['action' => 'drop_table', 'params' => ['name' => 'logins', 'model' => 'App\Modules\Auth\Models\Login']],
				['action' => 'drop_table', 'params' => ['name' => 'verification_codes', 'model' => 'App\Modules\Auth\Models\Vercode']],
			],
		];
	}
}
