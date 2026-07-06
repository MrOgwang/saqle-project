<?php

/**
 * Database configurations
 * */

use App\Databases\Schemas\AccountsSchema;
use App\Databases\Seeders\DatabaseSeeder;

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
                 env('db_name', '') => AccountsSchema::class
             ]
         ],
     ],
	 
	 /**
	 * The seeder class will be used when you run db:seed command to fill
     * your tables with intial data as you will have defined in the seeding data files.
	 */
 	 'seeder' => DatabaseSeeder::class,
]
?>