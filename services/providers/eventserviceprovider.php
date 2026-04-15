<?php
namespace App\Services\Providers;

use SaQle\Core\Services\Providers\ServiceProvider;
use SaQle\Auth\Events\{
     LoginSucceeded, 
     Logout
};
use App\Modules\Account\Listeners\{
     RecordUserLogIn, 
     RecordUserLogOut
};

class EventServiceProvider extends ServiceProvider {

     public function register(): void {

         $this->app->events->add(LoginSucceeded::class, [
             RecordUserLogIn::class
         ]);

         $this->app->events->add(Logout::class, [
             RecordUserLogOut::class
         ]);
         
     }
}
?>
