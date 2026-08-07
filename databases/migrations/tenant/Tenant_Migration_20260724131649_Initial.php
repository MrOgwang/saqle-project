<?php
use SaQle\Core\Migration\Base\BaseMigration;

class Tenant_Migration_20260724131649_Initial extends BaseMigration{
	public function get_migration_name() : string {
		return 'Initial';
	}

	public function get_migration_timestamp() : int {
		return '20260724131649';
	}

	public function snapshots() : array {
		return [
			'main.saqle_project' => [
				'path' => 'D:\xampp_lite_8_5\www\saqle-project\databases\snapshots\tenant\AccountsSchema_20260724131649_Initial.php',
				'name' => 'AccountsSchema_20260724131649_Initial',
			],
		];
	}

	public function up() : array {
		return [
			'main.saqle_project' => [
				['action' => 'create_table', 'params' => ['name' => 'users', 'model' => 'App\Modules\Account\Models\User']],
				['action' => 'create_table', 'params' => ['name' => 'contacts', 'model' => 'App\Modules\Account\Models\Contact']],
				['action' => 'create_table', 'params' => ['name' => 'verificationcodes', 'model' => 'App\Modules\Account\Models\Vercode']],
			],
		];
	}

	public function down() : array {
		return [
			'main.saqle_project' => [
				['action' => 'drop_table', 'params' => ['name' => 'users', 'model' => 'App\Modules\Account\Models\User']],
				['action' => 'drop_table', 'params' => ['name' => 'contacts', 'model' => 'App\Modules\Account\Models\Contact']],
				['action' => 'drop_table', 'params' => ['name' => 'verificationcodes', 'model' => 'App\Modules\Account\Models\Vercode']],
			],
		];
	}
}
