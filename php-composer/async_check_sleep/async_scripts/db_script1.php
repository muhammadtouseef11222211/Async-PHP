<?php
// script1.php
require_once 'db_connect.php';

function getCurrentTimeWithMilliseconds() {
    $microtime = microtime(true);
    return date('Y-m-d H:i:s', (int)$microtime) . sprintf('.%03d', ($microtime - (int)$microtime) * 1000);
}

echo "Script 1 started at " . getCurrentTimeWithMilliseconds() . PHP_EOL;
flush(); // Ensure output is immediately sent to the console

echo "Tables in the database:\n";
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_array()) {
    echo $row[0] . "\n";
}

echo "Script 1 ended at " . getCurrentTimeWithMilliseconds() . PHP_EOL;
flush(); // Ensure output is immediately sent to the console

$conn->close();
?>

