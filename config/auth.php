<?php

/**
 * Authentication and authorization configurations
 * */

use App\Modules\Account\Models\User;
use App\Modules\Account\Services\AuthenticationService;

return [
	 //This is the model that represents a user
	 'model_class' => User::class,

	 //This is the service class that is responsible for authentication.
 	 'backend_class' => AuthenticationService::class,
     
     //the jwt token key
 	 'jwt_key' => $_ENV['JWT_KEY'] ?? '',

 	 /**
 	  * When a jwt token is issued, this is the number of minutes it is to remain valid.
 	  * Defaults to 5 minutes
 	  * */
 	 'jwt_ttl' => $_ENV['JWT_TTL'] ?? 5,

 	 //the jwt issuer
 	 'jwt_iss' => $_ENV['JWT_ISS'] ?? ''
 ]
?>