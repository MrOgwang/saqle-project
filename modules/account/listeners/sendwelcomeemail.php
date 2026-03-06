<?php
namespace App\Listeners;

use SaQle\Core\Support\Listens;
use SaQle\Core\Events\GenericEvent;
use App\Modules\Account\Notifications\WelcomeEmailSetup;
use SaQle\Communication\Notifications\Notifier;
use SaQle\Communication\Notifications\NotifierTypes;

#[Listens('user.account.created')]
final class SendWelcomeEmail {
     public function handle(GenericEvent $event): void {
         $user     = $event->context->result()->user;
         $email    = $event->context->result()->email;
         $password = $event->context->result()->password;

         $email_configurations = [
             'rec_email'          => $email,
             'rec_name'           => $user->first_name,
             'placeholder_values' => [
                'userToWelcomeName'      => $user->first_name,
                 'userToWelcomeEmail'    => $user->username,
                 'userToWelcomePassword' => $password
             ],
             'cc_address'  => [],
             'bcc_address' => [],
             'attachments' => []
         ];
         $notifier = new Notifier(NotifierTypes::EMAIL, new WelcomeEmailSetup(...$email_configurations));
         $result = $notifier->notify();
     }
}
