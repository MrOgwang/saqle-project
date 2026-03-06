<?php

/**
 * Email configurations
 * */

return [
     //Email user name
     'username' => $_ENV['EMAIL_USER_NAME'],

     //Email password
     'password' => $_ENV['EMAIL_PASSWORD'],

     //Email host
     'host' => $_ENV['EMAIL_HOST'],

     //Email port
     'port' => $_ENV['EMAIL_PORT'],

     //Email sender name
     'sender_name' => 'Saqle Project Team',

     //Email sender address
     'sender_address' => $_ENV['EMAIL_SENDER_ADDRESS']
 ]

?>