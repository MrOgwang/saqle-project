<?php
use SaQle\Core\Migration\Base\BaseMigration;

class Migration_20260912043043_Initial extends BaseMigration{
	public function get_migration_name() : string {
		return 'Initial';
	}

	public function get_migration_timestamp() : int {
		return '20260912043043';
	}

	public function snapshots() : array {
		return [
			'default.default' => [
				'path' => 'D:\xampp_lite_8_5\www\saqle-project\src\Databases\Snapshots\DefaultDbSchema_20260912043043_Initial.php',
				'name' => 'DefaultDbSchema_20260912043043_Initial',
			],
			'default.system' => [
				'path' => 'D:\xampp_lite_8_5\www\saqle-project\src\Databases\Snapshots\SystemSchema_20260912043043_Initial.php',
				'name' => 'SystemSchema_20260912043043_Initial',
			],
		];
	}

	public function up() : array {
		return [
			'default.default' => [
				['action' => 'create_table', 'params' => ['name' => 'users', 'model' => 'App\Modules\Auth\Models\User']],
				['action' => 'create_table', 'params' => ['name' => 'contacts', 'model' => 'App\Modules\Auth\Models\Contact']],
				['action' => 'create_table', 'params' => ['name' => 'logins', 'model' => 'App\Modules\Auth\Models\Login']],
				['action' => 'create_table', 'params' => ['name' => 'verification_codes', 'model' => 'App\Modules\Auth\Models\Vercode']],
			],
			'default.system' => [
				['action' => 'create_table', 'params' => ['name' => 'migrations', 'model' => 'SaQle\Core\Migration\Models\Migration']],
				['action' => 'create_table', 'params' => ['name' => 'users', 'model' => 'App\Modules\Auth\Models\User']],
				['action' => 'create_table', 'params' => ['name' => 'sessions', 'model' => 'SaQle\Session\Models\Session']],
				['action' => 'create_table', 'params' => ['name' => 'queue_failed_jobs', 'model' => 'SaQle\Core\Queue\Models\FailedJob']],
				['action' => 'create_table', 'params' => ['name' => 'queue_jobs', 'model' => 'SaQle\Core\Queue\Models\Job']],
				['action' => 'create_table', 'params' => ['name' => 'queue_job_batches', 'model' => 'SaQle\Core\Queue\Models\JobBatch']],
			],
		];
	}

	public function down() : array {
		return [
			'default.default' => [
				['action' => 'drop_table', 'params' => ['name' => 'users', 'model' => 'App\Modules\Auth\Models\User']],
				['action' => 'drop_table', 'params' => ['name' => 'contacts', 'model' => 'App\Modules\Auth\Models\Contact']],
				['action' => 'drop_table', 'params' => ['name' => 'logins', 'model' => 'App\Modules\Auth\Models\Login']],
				['action' => 'drop_table', 'params' => ['name' => 'verification_codes', 'model' => 'App\Modules\Auth\Models\Vercode']],
			],
			'default.system' => [
				['action' => 'drop_table', 'params' => ['name' => 'migrations', 'model' => 'SaQle\Core\Migration\Models\Migration']],
				['action' => 'drop_table', 'params' => ['name' => 'users', 'model' => 'App\Modules\Auth\Models\User']],
				['action' => 'drop_table', 'params' => ['name' => 'sessions', 'model' => 'SaQle\Session\Models\Session']],
				['action' => 'drop_table', 'params' => ['name' => 'queue_failed_jobs', 'model' => 'SaQle\Core\Queue\Models\FailedJob']],
				['action' => 'drop_table', 'params' => ['name' => 'queue_jobs', 'model' => 'SaQle\Core\Queue\Models\Job']],
				['action' => 'drop_table', 'params' => ['name' => 'queue_job_batches', 'model' => 'SaQle\Core\Queue\Models\JobBatch']],
			],
		];
	}
}
