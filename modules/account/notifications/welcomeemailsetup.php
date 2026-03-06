<?php
namespace App\Modules\Account\Notifications;

use SaQle\Communication\Notifications\Email\EmailSetup;

class WelcomeEmailSetup extends EmailSetup {
	 public function __construct(...$configurations){
		 $this->email_message = "
		     Welcome To Saqle, Hi {{ userToWelcomeName }}, welcome to Saqle.
			 We are delighted to be working with you.
			 Your current credentials are: User Name: {{ userToWelcomeEmail }}, Password: {{ userToWelcomePassword }}.
			 Do enjoy your stay at Saqle.
			 Kind Regards, Saqle Team.
		 ";
		 $this->email_subject = "Welcome To Gaso";
		 $this->email_template_path = config('base_path')."components/welcome_email/welcome_email.html";
		 parent::__construct(...$configurations);
	 }
}

?>