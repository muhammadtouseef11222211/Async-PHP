<?php

// Command to run all scripts in parallel
$command = 'for i in {1..100}; do php script$i.php >> output.log 2>&1 & done';

// Execute the command
$output = [];
$returnVar = 0;
exec($command, $output, $returnVar);

// Output the result
if ($returnVar === 0) {
    echo "All scripts executed successfully.\n";
} else {
    echo "An error occurred while executing the scripts. Return code: $returnVar\n";
    echo "Check output.log for details of the errors.\n";
}

?>

