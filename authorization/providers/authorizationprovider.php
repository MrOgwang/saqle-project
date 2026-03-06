<?php
namespace App\Authorization\Providers;

use SaQle\Core\Services\Providers\ServiceProvider;
use App\Modules\Account\Models\User;
use App\Modules\Fan\Models\TalkSpace;
use SaQle\Auth\Guards\Guard;
class AuthorizationProvider extends ServiceProvider {
     public function register(): void {

         //add guards
         $this->app->guards->add('authenticated', function(?User $user = null){
             return $user ? true : false;
         });

         $this->app->guards->add('onboarded', function(?User $user = null){
             return Guard::check('authenticated') && $user->account_status >= 2;
         });

         $this->app->guards->add('celeb', function(?User $user = null){
             return Guard::check('authenticated') && $user->label === 'CELEB';
         });

         $this->app->guards->add('business', function(?User $user = null){
             return Guard::check('authenticated') && $user->label === 'BUSINESS';
         });

         $this->app->guards->add('expert', function(?User $user = null){
             return Guard::check('authenticated') && $user->label === 'EXPERT';
         });

         $this->app->guards->add('mentee', function(?User $user = null){
             return Guard::check('authenticated') && $user->label === 'MENTEE';
         });

         $this->app->guards->add('none', function(?User $user = null){
             return Guard::check('authenticated') && $user->label === 'NONE';
         });

         $this->app->guards->add('provider', function(?User $user = null){
             return Guard::check('authenticated') && $user->label === 'PROVIDER';
         });

         $this->app->guards->add('fan', function(?User $user = null){
             return Guard::check('authenticated') && $user->label === 'FAN';
         });

         $this->app->guards->add('backoffice', function(?User $user = null){
             return Guard::check('authenticated') && $user->label === 'BACKOFFICE';
         });

         $this->app->guards->add('super-user', function(?User $user = null){
             return Guard::check('authenticated') && $user->label === 'SUPER';
         });

         $this->app->guards->add('manage-space', function(?User $user = null, ?TalkSpace $space = null){
             return Guard::check('authenticated') && $space && $user->user_id === $space->author->user_id;
         });

         $this->app->guards->add('talent', function(?User $user = null, ?TalkSpace $space = null){
             return Guard::check('celeb') || Guard::check('business') || Guard::check('expert') || Guard::check('provider') || Guard::check('mentee') || Guard::check('none');
         });

         $this->app->guards->add('onboarded-talent', function(?User $user = null){
             return Guard::check('authenticated') && Guard::check('onboarded') && Guard::check('talent');
         });
     }
}
?>
