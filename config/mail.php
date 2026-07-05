<?php

/**
 * Email configurations
 * */

return [
     //Email driver
     'driver' => 'smtp',
     
     //Email user name
     'username' => env('email_user_name', ''),

     //Email password
     'password' => env('email_password', ''),

     //Email host
     'host' => env('email_host', ''),

     //Email port
     'port' => env('email_port'),

     //Email sender name
     'sender_name' => 'SaQle Project Team',

     //Email sender address
     'sender_address' => env('email_sender_address', ''),

     //Email encryption
     'encryption' => 'ssl'
 ]

?>