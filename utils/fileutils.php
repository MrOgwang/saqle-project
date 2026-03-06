<?php
namespace App\Utils;

class FileUtils {
	 public static function rename_file(array $context, string $original_name, int $file_index, string $key, string $prefix = ""){
	 	 $extension = pathinfo($original_name, PATHINFO_EXTENSION);
	 	 $id = str_replace("-", "", strtolower($context[$key]));
	 	 return "{$prefix}-{$id}-{$file_index}.{$extension}";
	 }
}
?>