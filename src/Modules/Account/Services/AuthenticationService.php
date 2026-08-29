<?php
namespace App\Modules\Account\Services;

use SaQle\Auth\Services\AuthenticationService as SaqleAuthenticationService;
use App\Modules\Account\Models\{User, Login};

class AuthenticationService extends SaqleAuthenticationService {

	 public function toggle_online(string|int $user_id, bool $is_online = true) : void {
		 User::update([
		 	 'online' => $is_online ? 1 : 0
		 ])->where('user_id__eq', $user_id)->now();
	 }

     public function record_login(string | int $user_id) {
		 Login::create([
		 	'login_count' => 1, 
		 	'login_datetime' => time(), 
		 	'user_id' => $user_id,
		 	'logout_datetime' => 1,
		 	'login_span' => 1
		 ])->now();
	 }

	 public function record_logout(mixed $user_id) : void {
		 $last_login = Login::get()->where('user_id__eq', $user_id)->order(["login_id"], "DESC")->limit(1, 1)->first_or_default();
		 if($last_login){
		 	 $logout_datetime = time();
		 	 $login_span = $logout_datetime - $last_login->login_datetime;
			 Login::update(['logout_datetime' => time(), 'login_span' => $login_span])->where('login_id__eq', $last_login->login_id)->now();
		 }
	 }
}
?>