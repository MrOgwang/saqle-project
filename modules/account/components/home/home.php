<?php
namespace App\Modules\Account\Components\Home;

use SaQle\Http\Response\Message;

class Home {
	 public function get() {
	 	 return Message::ok([
	 		'isloggedin'   => request()->user ? true : false,
	 		'profilephoto' => request()->user ? request()->user->profilephoto : '',
	 	 ]);
	 }
}
?>