<?php
namespace App\Modules\Account\Validators;

use SaQle\Security\Validation\Abstracts\IValidator;
use SaQle\Security\Validation\Types\ValidationResult;

class FullNameValidator extends IValidator {
     protected function threshold_type(): string {
         return 'bool';
     }

     public function validate(mixed $name, array $context = []): ValidationResult {

         $name = trim($name); 

         //collapse multiple spaces into one
         $name = preg_replace('/\s+/', ' ', $name);

         //require at least two words, each starting and ending with a letter.
         if(preg_match('/^[\p{L}][\p{L}\'\-]*(?:\s+[\p{L}][\p{L}\'\-]*)+$/u', $name)){
             return new ValidationResult(true, null);
         }

         return new ValidationResult(false, "Provide a full name: Example, JOHN DOE");
     }
}
