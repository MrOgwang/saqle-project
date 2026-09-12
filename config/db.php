<?php

/**
 * Database configurations
 * */

use App\Databases\Schemas\DefaultDbSchema;
use SaQle\Orm\Database\SystemSchema;

return [
     /**
      * List all your database connections here!
      * */
     'connections' => [
         'default' => [ 
             'driver'    => 'mysql', 
             'port'      => 3306, 
             'username'  => env('db_user_name', ''), 
             'password'  => env('db_password', ''),
             'host'      => env('db_host', 'localhost'),
             'databases' => [ 
                 'default' => [
                     'name' => env('db_name', ''),
                     'schema' => DefaultDbSchema::class
                 ],

                 'system' => [ 
                     'name' => env('db_name', '').'_system',
                     'schema' => SystemSchema::class
                 ]
             ] 
         ],
     ]
]
?>