<?php


require_once '../lib/AsyncRunner.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Received POST request.<br>"; // Debug statement
    $path = '../async_scripts';
    $scripts = ["$path/script1.php", "$path/script2.php", "$path/script3.php"];

    // Run the scripts asynchronously
    $outputs = runScriptsAsync($scripts); // Call the function directly
    echo "Scripts executed. Outputs:<br>"; // Debug statement

    // Initialize variables for individual outputs
    $output1 = '';
    $output2 = '';
    $output3 = '';

    // Assign outputs to individual variables
    if (isset($outputs[0])) {
        $output1 = trim($outputs[0]); // Script 1 output
    }
    if (isset($outputs[1])) {
        $output2 = trim($outputs[1]); // Script 2 output
    }
    if (isset($outputs[2])) {
        $output3 = trim($outputs[2]); // Script 3 output
    }

    // Output the individual outputs
    echo "Output 1: " . $output1 . "<br>";
    echo "Output 2: " . $output2 . "<br>";
    echo "Output 3: " . $output3 . "<br>";

    // Initialize the sum
    $sum = 0;

    // Calculate the sum only for non-empty outputs
    if ($output1 !== '') {
        $sum += floatval($output1);
    }
    if ($output2 !== '') {
        $sum += floatval($output2);
    }
    if ($output3 !== '') {
        $sum += floatval($output3);
    }

    // Output the total sum
    echo "<strong>Total Sum: " . $sum . "</strong>";
echo "ok";
}




?>
