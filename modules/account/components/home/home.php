<?php

namespace App\Modules\Account\Components\Home;

use SaQle\Http\Response\Message;

class Home {
	 public function get(){
	 	 return Message::ok();
	 }
}
?>