<?php

/**
 * Database configurations
 * */

use App\Databases\Schemas\DefaultDbSchema;

return [
     /**
      * The default connection to use.
      * 
      * This only takes effect where more than one connection is listed.
      * 
      * If not provided, the first connection in the list
      * of connections will always be used as the default connection.
      * 
      * */
     'default_connection' => 'main',

     /**
      * The default database to use.
      * 
      * This only takes effect where more than one database is listed for the default connection.
      * 
      * If not provided, the first database in the list
      * of databases for the default connection will be 
      * used as the default database.
      * 
      * */
     'default_database' => env('db_name', ''),

     /**
      * List all your database connections here!
      * */
     'connections' => [
         'main' => [
             'driver'    => 'mysql', 
             'port'      => 3306, 
             'username'  => env('db_user_name', ''), 
             'password'  => env('db_password', ''),
             'host'      => env('db_host', 'localhost'),
             'databases' => [
                 env('db_name', '') => DefaultDbSchema::class
             ]
         ],
     ]
]
?>