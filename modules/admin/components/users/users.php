<?php

namespace App\Modules\Admin\Components\Users;

use SaQle\Http\Response\Message;
use SaQle\Core\Components\CrudComponent;
use App\Modules\Account\Models\User;
use SaQle\Core\Support\Route;

class Users extends CrudComponent {

     protected function model_class() : string {
         return User::class;
     } 

     #[Route(
         name: 'users.index',
         method: 'get', 
         url: '/users', 
         guards: 'authenticated && admin',
         layout: ['app']
     )]
     public function index(){
         return Message::ok();
     }

     #[Route( 
         name: 'users.create.form',
         method: 'get', 
         url: '/users/create', 
         guards: 'authenticated && admin',
         layout: ['app']
     )] 
     public function create(){
         return Message::ok();
     }
}
