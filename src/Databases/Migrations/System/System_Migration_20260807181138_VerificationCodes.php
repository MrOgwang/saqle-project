<?php
use SaQle\Core\Migration\Base\BaseMigration;

class System_Migration_20260807181138_VerificationCodes extends BaseMigration{
	public function get_migration_name() : string {
		return 'VerificationCodes';
	}

	public function get_migration_timestamp() : int {
		return '20260807181138';
	}

	public function snapshots() : array {
		return [
			'framework.saqle_project_system' => [
				'path' => 'D:\xampp_lite_8_5\www\saqle-project\databases\snapshots\system\SystemSchema_20260807181138_VerificationCodes.php',
				'name' => 'SystemSchema_20260807181138_VerificationCodes',
			],
		];
	}

	public function up() : array {
		return [
			'framework.saqle_project_system' => [
			],
		];
	}

	public function down() : array {
		return [
			'framework.saqle_project_system' => [
			],
		];
	}
}
