<?php

/**
 * WARNING: Never add users via seeding, this here is to just demonstrate how
 * to seed your database with initial data. 
 * 
 * Only seed the database with data that can be added without side effects, like
 * configurations, settings etc.
 * 
 * Adding users must be done through your user registration service or via the 
 * make:user and make:superuser cli commands.
 * 
 * */
return [
     [
         "first_name" => "Saqle",
         "last_name" => "Project",
         "gender" => "male",
         "username" => "supersaqle@gmail.com",
         "password" => "Luck1e@L00k!",
         "is_super_admin" => 0,
         "account_status" => 0
     ],
     [
         "first_name" => "Wycliffe",
         "last_name" => "Ortiz",
         "gender" => "male",
         "username" => "wikimosh",
         "password" => "S0m3t1m3s_1n_Apr1l_1994#",
         "is_super_admin" => 0,
         "account_status" => 0
     ],
];
?>