<?php
use SaQle\Core\Migration\Base\BaseMigration;

class Migration_20260912055956_UserAdmin extends BaseMigration{
	public function get_migration_name() : string {
		return 'UserAdmin';
	}

	public function get_migration_timestamp() : int {
		return '20260912055956';
	}

	public function snapshots() : array {
		return [
			'default.default' => [
				'path' => 'D:\xampp_lite_8_5\www\saqle-project\src\Databases\Snapshots\DefaultDbSchema_20260912055956_UserAdmin.php',
				'name' => 'DefaultDbSchema_20260912055956_UserAdmin',
			],
			'default.system' => [
				'path' => 'D:\xampp_lite_8_5\www\saqle-project\src\Databases\Snapshots\SystemSchema_20260912055956_UserAdmin.php',
				'name' => 'SystemSchema_20260912055956_UserAdmin',
			],
		];
	}

	public function up() : array {
		return [
			'default.default' => [
				['action' => 'add_columns', 'params' => ['name' => 'users', 'model' => 'App\Modules\Auth\Models\User', 'columns' => [
						'is_admin' => 'is_admin INT NULL',
				]]],
			],
			'default.system' => [
				['action' => 'add_columns', 'params' => ['name' => 'users', 'model' => 'App\Modules\Auth\Models\User', 'columns' => [
						'is_admin' => 'is_admin INT NULL',
				]]],
			],
		];
	}

	public function down() : array {
		return [
			'default.default' => [
				['action' => 'drop_columns', 'params' => ['name' => 'users', 'model' => 'App\Modules\Auth\Models\User', 'columns' => [
						'is_admin' => 'is_admin INT NULL',
				]]],
			],
			'default.system' => [
				['action' => 'drop_columns', 'params' => ['name' => 'users', 'model' => 'App\Modules\Auth\Models\User', 'columns' => [
						'is_admin' => 'is_admin INT NULL',
				]]],
			],
		];
	}
}
