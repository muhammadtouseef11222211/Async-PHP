<?php
function insertIntoCsv($file, $key, $value) {
    // Read the existing CSV data
    $data = [];
    if (file_exists($file)) {
        $fileHandle = fopen($file, 'r');
        while (($line = fgetcsv($fileHandle)) !== false) {
            $data[$line[0]] = $line[1]; // Use the first column as key
        }
        fclose($fileHandle);
    }

    // Insert or update the key-value pair
    $data[$key] = $value;

    // Write the updated data back to the CSV file
    $fileHandle = fopen($file, 'w');
    foreach ($data as $k => $v) {
        fputcsv($fileHandle, [$k, $v]);
    }
    fclose($fileHandle);
}
?>

