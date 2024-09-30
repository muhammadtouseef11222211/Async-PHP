<?php

require_once '../lib/AsyncRunner_realtime_output.php'; // Include your AsyncRunner script

// Set headers for server-sent events
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

// Scripts you want to run
$path = '../async_scripts/test_db_100_create_scritps';
$scripts = [
    "$path/script1.php",
    "$path/script2.php",
    "$path/script3.php",
    "$path/script4.php",
    "$path/script5.php",
    "$path/script6.php",
    "$path/script7.php",
    "$path/script8.php",
    "$path/script9.php",
    "$path/script10.php",
];

// Use the included function to run scripts asynchronously
runScriptsAsync($scripts);

echo "data: All scripts executed.\n\n";
echo "event: end\n\n";
ob_flush();
flush();
?>

