<?php
namespace App\Services\Providers;

use SaQle\Core\Ui\Template;
use SaQle\Core\Services\Providers\ServiceProvider;

class TemplateContextProvider extends ServiceProvider {
     public function register(): void {

         //define shared contexts
         Template::context('base_url', config('app.root_domain'));
         Template::context('layout_image_path', config('app.root_domain')."static/images/layout");
         Template::context('app_name', config('app.name'));

     }
}
?>
