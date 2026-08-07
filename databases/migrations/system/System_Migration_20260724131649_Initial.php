<?php
use SaQle\Core\Migration\Base\BaseMigration;

class System_Migration_20260724131649_Initial extends BaseMigration{
	public function get_migration_name() : string {
		return 'Initial';
	}

	public function get_migration_timestamp() : int {
		return '20260724131649';
	}

	public function snapshots() : array {
		return [
			'framework.saqle_project_system' => [
				'path' => 'D:\xampp_lite_8_5\www\saqle-project\databases\snapshots\system\SystemSchema_20260724131649_Initial.php',
				'name' => 'SystemSchema_20260724131649_Initial',
			],
		];
	}

	public function up() : array {
		return [
			'framework.saqle_project_system' => [
				['action' => 'create_table', 'params' => ['name' => 'users', 'model' => 'App\Modules\Account\Models\User']],
				['action' => 'create_table', 'params' => ['name' => 'tenants', 'model' => 'SaQle\Auth\Models\BaseTenant']],
				['action' => 'create_table', 'params' => ['name' => 'migrations', 'model' => 'SaQle\Core\Migration\Models\Migration']],
				['action' => 'create_table', 'params' => ['name' => 'tenant_migrations', 'model' => 'SaQle\Core\Migration\Models\TenantMigration']],
				['action' => 'create_table', 'params' => ['name' => 'sessions', 'model' => 'SaQle\Session\Models\Session']],
				['action' => 'create_table', 'params' => ['name' => 'queue_failed_jobs', 'model' => 'SaQle\Core\Queue\Models\FailedJob']],
				['action' => 'create_table', 'params' => ['name' => 'queue_jobs', 'model' => 'SaQle\Core\Queue\Models\Job']],
				['action' => 'create_table', 'params' => ['name' => 'queue_job_batches', 'model' => 'SaQle\Core\Queue\Models\JobBatch']],
			],
		];
	}

	public function down() : array {
		return [
			'framework.saqle_project_system' => [
				['action' => 'drop_table', 'params' => ['name' => 'users', 'model' => 'App\Modules\Account\Models\User']],
				['action' => 'drop_table', 'params' => ['name' => 'tenants', 'model' => 'SaQle\Auth\Models\BaseTenant']],
				['action' => 'drop_table', 'params' => ['name' => 'migrations', 'model' => 'SaQle\Core\Migration\Models\Migration']],
				['action' => 'drop_table', 'params' => ['name' => 'tenant_migrations', 'model' => 'SaQle\Core\Migration\Models\TenantMigration']],
				['action' => 'drop_table', 'params' => ['name' => 'sessions', 'model' => 'SaQle\Session\Models\Session']],
				['action' => 'drop_table', 'params' => ['name' => 'queue_failed_jobs', 'model' => 'SaQle\Core\Queue\Models\FailedJob']],
				['action' => 'drop_table', 'params' => ['name' => 'queue_jobs', 'model' => 'SaQle\Core\Queue\Models\Job']],
				['action' => 'drop_table', 'params' => ['name' => 'queue_job_batches', 'model' => 'SaQle\Core\Queue\Models\JobBatch']],
			],
		];
	}
}
