<?php
namespace App\Modules\Account\Models;

use SaQle\Orm\Entities\Model\Schema\{Model, Table};

class Contact extends Model {

     protected function table_schema(Table $table) : void {

      	 $table->primary_key('contact_id');

      	 $table->fields([
		     'contact_type' => Table::choice_field()->required()->choices([
		     	 'email' => 'Email Address', 
		     	 'phone' => 'Phone Number'
		      ])->use_keys(),
		     'contact_class' => Table::choice_field()->required()->choices([
		     	 'primary'   => 'Primary contact', 
		     	 'secondary' => 'Secondary contact'
		      ])->use_keys(),
		     'contact' => Table::char_field()->required()->max_length(200),
		     'owner_type' => Table::choice_field()->required()->choices([
		     	 'tenant' => 'Organizationn owns contact', 
		     	 'user'   => 'User owns contact'
		      ])->use_keys(),
		     'owner_id' => Table::char_field()->required()->max_length(100)
      	 ]);

      	 $table->unique_fields([
      	 	'unique_contact_per_person' => ['contact', 'owner_id']
      	 ]);

      	 $table->action_on_duplicate('RETURN_EXISTING');

      	 $table->name_property('contact');
     }
}
