<?php

namespace App\Providers;

use SaQle\Core\Ui\Template;
use SaQle\Core\Services\Providers\ServiceProvider;

class SharedTemplateContext extends ServiceProvider {

     public function register(): void {
        
         Template::context('layout_image_path', config('app.domain.root')."/static/images/layout");

     }

}
?>
