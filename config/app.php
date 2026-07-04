<?php

/**
 * General app configurations
 * */

use SaQle\Core\Files\Storage\Drivers\LocalStorageDriver;
use SaQle\Core\Files\Generators\DefaultPrivateFileUrlGenerator;

return [

     //the name of the application.
     'name' => 'saqle-project',

     //whether to display errors
	 'display_errors' => $_ENV['DISPLAY_ERRORS'],

     //whether to display startup errors
	 'display_startup_errors' => $_ENV['DISPLAY_SETUP_ERRORS'],

     //the root domain
 	 'root_domain' => "http://".$_ENV['ROOT_DOMAIN']."/",

 	 /**
      * List of all the modules in the project. 
      * A module is generally a folder with controllers, templates and routes
      * */
     'modules' => ['account', 'admin'],

     //the url for media
     'media_url' => '/media/',

     //the media url encryption key
     'media_encrypt_key' => '3rt8vfweft9823t2gfv29y23ud-02cfi9ft39fg239',

     //the media url encryption salt
     'media_encrypt_salt' => 'media-url-salt',

     //the url prefix for cron jobs
     'cron_url' => '/cron/',

 	 //whether to keep media in document root i.e public folder
 	 'hidden_media_folder' => true,

     //media storage drivers
     'media_storage_drivers' => [
         'local' => [
             'driver' => LocalStorageDriver::class,
             'root' => media_root('media', false),
             'visibility' => 'private',
             'base_url' => '/media',
             'private_url_generator' => DefaultPrivateFileUrlGenerator::class
         ],
     ],

 	 //api url prefixes
 	 'api_url_prefixes' => ['/api/v1/'],

 	 //sse url prefixes
 	 'sse_url_prefixes' => ['/sse/v1/'],

    /**
       * By default, components will be searched in the top level project directory, or inside
       * the individual module directories as listed in modules. 
       * 
       * In cases where your components also exist in other places, list the directory
       * names here relative to the root directory.
     * */
     'extra_components_dirs' => [],

     /**
       * By default, models will be searched in the top level project directory, or inside
       * the individual module directories as listed in modules. 
       * 
       * In cases where your models also exist in other places, list the directory
       * names here relative to the root directory.
     * */
     'extra_models_dirs' => [],

     /**
       * This is the extension of component temnplate files:
       * 
       * Defaults to html
       * */
     'component_template_ext' => 'html',

     //date and time formats
 	 'date_added_format' => 'jS M Y',
 	 'date_display_format' => 'jS M Y',
 	 'datetime_display_format' => 'jS M Y h:s:m a',
     'system_date_format' => 'd-m-Y',

     //default timezone
 	 'timezone' => 'Africa/Nairobi',

 	 //system administrator settings
 	 'system_admin_email' => '',
 	 'system_admin_name'  => ''
 ]
?>