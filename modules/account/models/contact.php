<?php
namespace App\Modules\Account\Models;

use SaQle\Orm\Entities\Model\Schema\{Model, Table};

class Contact extends Model {

     protected function table_schema(Table $table) : void {

      	 $table->primary_key('contact_id');

      	 $table->fields([
		     'contact_type' => choice_field()->required()->choices([
		     	 'email' => 'Email Address', 
		     	 'phone' => 'Phone Number'
		      ])->use_keys(),
		     'contact_class' => choice_field()->required()->choices([
		     	 'primary'   => 'Primary contact', 
		     	 'secondary' => 'Secondary contact'
		      ])->use_keys(),
		     'contact' => char_field()->required()->max_length(200),
		     'owner_type' => char_field()->required()->max_length(20)->choices([
		     	 'tenant' => 'Organizationn owns contact', 
		     	 'user'   => 'User owns contact'
		      ])->use_keys(),
		     'owner_id' => char_field()->required()->max_length(100)
      	 ]);

      	 $table->name_property('contact');
     }
}
