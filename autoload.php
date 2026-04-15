<?php

spl_autoload_register(function ($class) {
     $base_paths = [
         'SaQle\\'  => dirname(__DIR__).'/saqle',
         'App\\' => __DIR__,
     ];

     foreach($base_paths as $namespace_prefix => $base_dir){
         if(strpos($class, $namespace_prefix) === 0) {
             $relative_class = substr($class, strlen($namespace_prefix));
             $parts = explode('\\', $relative_class);

             if($namespace_prefix === 'SaQle\\'){
                 //Folders lowercase, filename matches class name
                 $file_name = array_pop($parts); // actual class name
                 $folder_path = implode(DIRECTORY_SEPARATOR, array_map('strtolower', $parts));
                 
                 $file_path1 = $folder_path !== '' ? $folder_path.DIRECTORY_SEPARATOR.$file_name : $file_name;
                 $file_path2 = $folder_path !== '' ? $folder_path.DIRECTORY_SEPARATOR.strtolower($file_name) : strtolower($file_name);
             }else{
                 //Everything lowercase for App
                 $file_path1 = strtolower(str_replace('\\', DIRECTORY_SEPARATOR, $relative_class));
                 $file_path2 = strtolower(str_replace('\\', DIRECTORY_SEPARATOR, $relative_class));
             }

             $file1 = rtrim($base_dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$file_path1.'.php';
             $file2 = rtrim($base_dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$file_path2.'.php';

             if(file_exists($file1)){
                 require_once $file1;
             }elseif(file_exists($file2)){
                 require_once $file2;
             }

             return;
         }
     }
 });