<?php
// script3.php
require_once 'db_connect.php';

function getCurrentTimeWithMilliseconds() {
    $microtime = microtime(true);
    return date('Y-m-d H:i:s', (int)$microtime) . sprintf('.%03d', ($microtime - (int)$microtime) * 1000);
}

echo "Script 3 started at " . getCurrentTimeWithMilliseconds() . PHP_EOL;
flush(); // Ensure output is immediately sent to the console

echo "MSN values from the meter table:\n";
$result = $conn->query("SELECT msn FROM meter");
while ($row = $result->fetch_assoc()) {
    echo $row['msn'] . "\n"; // Display each MSN value
}

echo "Script 3 ended at " . getCurrentTimeWithMilliseconds() . PHP_EOL;
flush(); // Ensure output is immediately sent to the console

$conn->close();
?>

