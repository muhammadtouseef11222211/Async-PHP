<?php
// File path
$file = '../../../spaces/apache_ports.csv';

// Check if the file exists
if (!file_exists($file)) {
    die("File not found.");
}

// Open the file for reading
if (($handle = fopen($file, 'r')) !== FALSE) {
    // Start outputting the HTML
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>CSV Data</title>
    </head>
    <body>
        <div class="container mt-5">
            <h2>CSV Data</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>';

    // Loop through the CSV rows
    while (($data = fgetcsv($handle)) !== FALSE) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($data[0]) . '</td>'; // Key
        echo '<td>' . htmlspecialchars($data[1]) . '</td>'; // Value
        echo '</tr>';
    }

    // Close the table and HTML structure
    echo '        </tbody>
            </table>
        </div>
    </body>
    </html>';

    // Close the file
    fclose($handle);
} else {
    echo "Error opening the file.";
}
?>

