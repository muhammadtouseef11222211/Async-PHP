<?php
function include_file($filename) {
    // Define an array of directories to look for the file
    $directories = [
        __DIR__ . '/', // Adjust the path as needed
        // You can add more directories if necessary
    ];

    // Loop through the directories to find the file
    foreach ($directories as $dir) {
        $filePath = $dir . $filename;
        if (file_exists($filePath)) {
            include $filePath; // Include the file if found
            return; // Exit the function once the file is included
        }
    }

    die("File not found: $filename");
}
?>


