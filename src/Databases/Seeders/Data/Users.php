<?php
/**
 * WARNING: Never add users via seeding, this here is to just demonstrate how
 * to seed your database with initial data. 
 * 
 * Only seed the database with data that can be added without side effects, like
 * configurations, settings etc.
 * 
 * Adding users must be done through your user registration process, and to
 * setup up admins, use the add admin command via cli.
 * 
 * Before running the db:seed command, remove this as well as the 
 * ['model' => User::class, 'file' => "data/users.php"] entry in the
 * DatabaseSeeder class
 * */
return [
    [
        "first_name" => "Saqle",
        "last_name" => "Project",
        "gender" => "female",
        "username" => "supersaqle@gmail.com",
        "password" => md5("Luck1e@L00k!"),
        "label" => "SUPER-ADMIN"
    ],
    [
        "first_name" => "Wycliffe",
        "last_name" => "Ortiz",
        "gender" => "male",
        "username" => "wikimosh",
        "password" => md5("Cliff@12#!"),
        "label" => "ADMIN"
    ],
];
?>