<?php

include '../../lib/db_insert.php';
$file = '../../spaces/apache_ports.csv';


// Call the function

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the name (port) and dropdown value (open/close) from POST data
    $port = $_POST['name'] ?? '';
    $action = $_POST['simpleDropdown'] ?? '';

    // Validate port range
    if (!is_numeric($port) || $port < 1025 || $port > 65534) {
        echo "Please enter a valid port number (1025-65534).<br>";
        exit;
    
}

     insertIntoCsv($file, $port, $action);

    if ($action === 'open') {
        if (addPortToApache($port)) {
            echo "Attempting to restart Apache...<br>";
            echo "Network connection lost...<br>";  // Simulate network down message
            if (restartApache()) {
                echo "Network connection restored.<br>";
                echo "Port $port opened and Apache restarted successfully.<br>";
            } else {
                echo "Failed to restart Apache.<br>";
            }
        } else {
            echo "Could not add port $port to the configuration.<br>";
        }
    } elseif ($action === 'close') {
        if (removePortFromApache($port)) {
            echo "Attempting to restart Apache...<br>";
            echo "Network connection lost...<br>";  // Simulate network down message
            if (restartApache()) {
                echo "Network connection restored.<br>";
                echo "Port $port closed and Apache restarted successfully.<br>";
            } else {
                echo "Failed to restart Apache.<br>";
            }
        } else {
            echo "Could not remove port $port from the configuration.<br>";
        }
    } else {
        echo "Invalid action.<br>";
    }
}

// Function to restart Apache
function restartApache() {
    
$output = [];
    $returnVar = 0;
    exec('sudo systemctl restart apache2', $output, $returnVar);
    return $returnVar === 0;
}

// Function to add port to Apache configuration
function addPortToApache($port) {
    $apacheConfigFile = '/etc/apache2/ports.conf';
    $portLine = "Listen $port\n";

    // Check if the port is already in the configuration
    if (file_exists($apacheConfigFile)) {
        if (strpos(file_get_contents($apacheConfigFile), $portLine) === false) {
            // Append port to the configuration
            file_put_contents($apacheConfigFile, $portLine, FILE_APPEND);
            return true;
        } else {
            echo "Port $port already exists in $apacheConfigFile.<br>";
            return false;
        }
    } else {
        echo "Apache configuration file not found.<br>";
        return false;
    }
}

// Function to remove port from Apache configuration
function removePortFromApache($port) {
    $apacheConfigFile = '/etc/apache2/ports.conf';
    $contents = file_get_contents($apacheConfigFile);
    $portLine = "Listen $port\n";

    // Check if the port is in the configuration
    if (strpos($contents, $portLine) !== false) {
        // Remove port from the configuration
        $updatedContents = str_replace($portLine, '', $contents);
        file_put_contents($apacheConfigFile, $updatedContents);
        return true;
    } else {
        echo "Port $port does not exist in $apacheConfigFile.<br>";
        return false;
    }
}
?>

