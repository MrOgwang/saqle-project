<?php

spl_autoload_register(function ($class){
     $base_paths = [
         'App\\' => __DIR__,
     ];

     foreach($base_paths as $namespace_prefix => $base_dir){
         if(strpos($class, $namespace_prefix) === 0){
             $relative_class = substr($class, strlen($namespace_prefix));
             
             $file_path = strtolower(str_replace('\\', DIRECTORY_SEPARATOR, $relative_class));
             $file = rtrim($base_dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$file_path.'.php';

             if(file_exists($file)){
                 require_once $file;
             }

             return;
         }
     }
 });