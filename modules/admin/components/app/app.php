<?php

namespace App\Modules\Admin\Components\App;

use SaQle\Http\Response\Message;

class App {
     public function get() {
        return Message::ok();
     }
}
