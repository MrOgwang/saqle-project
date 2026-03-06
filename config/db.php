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
      * If not provided, the first connection in the list
      * of connections will be used as the default connection
      * */
     'default_connection' => 'accounts',

     /**
      * The framework connection. This defines the database where the framework
      * will keep its tables, such as sessions and migrations.
      * 
      * For most applications, a single database for the project
      * and for the framework is sufficient, but this can be a different database 
      * if desired
      * 
      * If not provided, the default connection will be used instead
      * */
     'framework_connection' => 'accounts',

     /**
      * List all your database connections here!
      * */
     'connections' => [
         'accounts' => [
             'database' => $_ENV['MySQL_DB_NAME'], 
             'driver'   => 'mysql', 
             'port'     => 3306, 
             'username' => $_ENV['MySQL_DB_USER_NAME'], 
             'password' => $_ENV['MySQL_DB_PASSWORD'],
             'host'     => $_ENV['MySQL_DB_HOST']
         ],
     ],

     /**
      * List all the schemas for all the available
      * connections here.
      * 
      * A schema is a class that defines tables and their associated models.
      * 
      * Note: Saqle models are not associated to tables in and by themselevs, they are simply
      * domain objects. To associate models to tables, you must define a schema
      * */
     'schemas' => [
         'accounts' => AccountsSchema::class,
     ],
	 
	 /**
	 * The seeder class will be used when you run db:seed command to fill
     * your tables with intial data as you will have defined in the seeding data files.
	 */
 	 'seeder' => DatabaseSeeder::class,
]
?>