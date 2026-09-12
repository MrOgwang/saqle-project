<?php

/**
 * Admin configurations
 * */

return [

     /**
      * --------------------------------------------------
      * ADMIN AUTHORIZATION
      * -------------------------------------------------
      * 
      * Protect the adminsitrator panel or individual resource
      * access with authorization guards
      * 
      * */
     'authorization' => [
     	 /**
     	  * Global guards are checked for all the resources
     	  * 
     	  * @var string
     	  * 
     	  * Example: authenticated && admin
     	  * */
     	 'global' => 'authenticated && admin',

         /**
          * List resource specific guards here
          * 
          * @var array<key, value>
          * */
     	 'resources' => [

     	 ]
     ],

     /**
      * -------------------------------------------------
      * ADMIN MIDDLEWARE
      * -------------------------------------------------
      * 
      * A list of middleware to be run for admin
      * resource routes
      * 
      * */
     'middleware' => [
         /**
          * Global middleware to be run for all resource routes
          * 
          * @var array
          *
          * */
         'global' => [
             'authentication',
             'authorization'
         ],

         /**
          * List resource specific middleware here
          * 
          * @var array<key, value>
          * */
         'resources' => [

         ]
     ],

	 /**
	  * ------------------------------------------------
	  * ADMIN ROUTES
	  * ------------------------------------------------
	  * 
	  * How your adminsitrator routes should be
	  * mounted
	  * 
	  * */
	 'routes' => [
	 	 'prefix' => '_admin',
	 	 'name_prefix' => 'admin',
	 ]
 ]
?>