<?php
/**
 * Post-create-project customization script
 *
 * Replaces placeholders in files and renames files based on project name.
 * Placeholders: __PROJECT_NAME__, SaqleProject
 *
 * Usage: Automatically called by composer post-create-project-cmd
 */

$cwd = getcwd(); // Newly created project root

// Determine project name (folder name)
$projectName = basename($cwd);

// Generate class-friendly and namespace-friendly versions
$projectClass = str_replace(' ', '', ucwords($projectName)); // ChatGPT
$projectNamespace = str_replace(' ', '', ucwords($projectName)); // App\ChatGPT or similar

/**
 * Recursively replace placeholders in all files
 */
function replacePlaceholders(string $dir, string $projectClass, string $projectNamespace) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($iterator as $file) {
        if (!$file->isFile()) continue;

        $filePath = $file->getRealPath();
        $fileName = $file->getFilename();

        // Replace placeholders inside file content
        $content = file_get_contents($filePath);
        $content = str_replace('__PROJECT_NAME__', $projectClass, $content);
        $content = str_replace('SaqleProject', $projectNamespace, $content);
        file_put_contents($filePath, $content);

        // Rename file if it contains placeholder
        if (strpos($fileName, '__PROJECT_NAME__') !== false) {
            $newFileName = str_replace('__PROJECT_NAME__', $projectClass, $fileName);
            rename($filePath, $file->getPath() . DIRECTORY_SEPARATOR . $newFileName);
        }
    }
}

/**
 * Run replacement for your app folder (or entire project if needed)
 */
replacePlaceholders($cwd, $projectClass, $projectNamespace);

echo "Project customized for '$projectClass' successfully!\n";
