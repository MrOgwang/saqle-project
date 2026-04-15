<?php
namespace App\Utils;

class FileUtils {
	 public static function rename_file(mixed $model, string $original_name, int $file_index, string $key, string $prefix = ""){
	 	 $extension = pathinfo($original_name, PATHINFO_EXTENSION);
	 	 $id = str_replace("-", "", strtolower($model->$key));
	 	 return "{$prefix}-{$id}-{$file_index}.{$extension}";
	 }
}
?>