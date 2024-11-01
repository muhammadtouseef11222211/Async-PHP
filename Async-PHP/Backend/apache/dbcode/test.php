<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the name (port) and dropdown value (open/close) from POST data
    $port = $_POST['name'] ?? '';
    $action = $_POST['simpleDropdown'] ?? '';

    // Output the received POST data
    echo "Port: " . htmlspecialchars($port) . "<br>";
    echo "Action: " . htmlspecialchars($action) . "<br>";
}
?>

