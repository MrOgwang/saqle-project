<?php

namespace App\Modules\Admin\Components\Dashboard;

use SaQle\Http\Response\Message;

class Dashboard {
     public function get() {
        return Message::ok();
     }
}
