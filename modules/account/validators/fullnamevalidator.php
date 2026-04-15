<?php
namespace App\Modules\Account\Validators;

use SaQle\Security\Validation\Abstracts\IValidator;
use SaQle\Security\Validation\Types\ValidationResult;

class FullNameValidator extends IValidator {
     protected function threshold_type(): string {
         return 'bool';
     }

     public function validate(mixed $value, array $context = []): ValidationResult {
         // Regex explanation:
         // ^254         -> must start with 254
         // [1-9]        -> 4th digit must be 1-9 (cannot be 0)
         // \d{8}        -> next 8 digits can be 0-9
         // $            -> end of string
         if(preg_match('/^254[1-9]\d{8}$/', $value) === 1){
             return new ValidationResult(true, null);
         }

         return new ValidationResult(false, "Provide a valid phone number: Example 254712345678");
     }
}
