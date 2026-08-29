<?php
use SaQle\Core\Migration\Base\BaseMigration;

class Tenant_Migration_20260807181138_VerificationCodes extends BaseMigration{
	public function get_migration_name() : string {
		return 'VerificationCodes';
	}

	public function get_migration_timestamp() : int {
		return '20260807181138';
	}

	public function snapshots() : array {
		return [
			'main.saqle_project' => [
				'path' => 'D:\xampp_lite_8_5\www\saqle-project\databases\snapshots\tenant\AccountsSchema_20260807181138_VerificationCodes.php',
				'name' => 'AccountsSchema_20260807181138_VerificationCodes',
			],
		];
	}

	public function up() : array {
		return [
			'main.saqle_project' => [
				['action' => 'rename_table', 'params' => ['old' => 'verificationcodes', 'new' => 'verification_codes', 'model' => 'App\Modules\Account\Models\Vercode']],
			],
		];
	}

	public function down() : array {
		return [
			'main.saqle_project' => [
				['action' => 'rename_table', 'params' => ['old' => 'verification_codes', 'new' => 'verificationcodes', 'model' => 'App\Modules\Account\Models\Vercode']],
			],
		];
	}
}
