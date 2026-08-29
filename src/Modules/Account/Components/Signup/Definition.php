<?php

namespace App\Modules\Account\Components\Signup;

use SaQle\Core\Components\ComponentDefinition;

final class Definition extends ComponentDefinition {

     public function dependencies() : array {
         return [
             'scripts' => [
                 '@saqle.lib.autoform'
             ],
             'styles' => [
                 '@saqle.lib.autoform'
             ],
         ];
     }

     public function routes() : array {
        
         return [
             'name'       => '',
             'prefix'     => '',
             'authorize'  => '',
             'middleware' => []
         ];
     }
}