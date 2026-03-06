<?php
namespace App\Modules\Account\Components\Home;

class Home {
	 public function get() {
	 	 return ok([
	 		'isloggedin'   => request()->user ? true : false,
	 		'profilephoto' => request()->user ? request()->user->profilephoto : '',
	 	 ]);
	 }
}
?>