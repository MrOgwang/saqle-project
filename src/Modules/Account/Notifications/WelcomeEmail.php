<?php

namespace App\Modules\Account\Notifications;

use SaQle\Core\Support\Mailable;

class WelcomeEmail extends Mailable {

     public function build() : void {

         $this->subject("Welcome To SaQle")
         ->to($this->data['email'], $this->data['firstname'])
         ->view('components/welcomeemail/welcomeemail.html', 
         [
             'userToWelcomeName'     => $this->data['firstname'],
             'userToWelcomeEmail'    => $this->data['username'],
             'userToWelcomePassword' => $this->data['password']
         ]);
     }
     
}