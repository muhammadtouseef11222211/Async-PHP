<?php
// script2.php
require_once 'db_connect.php';

function getCurrentTimeWithMilliseconds() {
    $microtime = microtime(true);
    return date('Y-m-d H:i:s', (int)$microtime) . sprintf('.%03d', ($microtime - (int)$microtime) * 1000);
}

echo "Script 2 started at " . getCurrentTimeWithMilliseconds() . PHP_EOL;
flush(); // Ensure output is immediately sent to the console

echo "First 10 records from the meter table:\n";
$result = $conn->query("SELECT * FROM meter LIMIT 10");
while ($row = $result->fetch_assoc()) {
    echo implode(", ", $row) . "\n"; // Display each row
}

echo "Script 2 ended at " . getCurrentTimeWithMilliseconds() . PHP_EOL;
flush(); // Ensure output is immediately sent to the console

$conn->close();
?>

