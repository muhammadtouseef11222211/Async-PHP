<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the module name and action from POST data
    $mod = $_POST['simpleDropdown'] ?? ''; // Module name
    $action = $_POST['simpleDropdown1'] ?? ''; // Action (enable/disable)

    // Echo the values for debugging
    echo "Module: " . htmlspecialchars($mod) . "<br>";
    echo "Action: " . htmlspecialchars($action) . "<br>";
echo "No need to restart if configuration done for software <br>";
    // Validate the action
    if (!in_array($action, ['enable', 'disable'])) {
        echo "Invalid action.<br>";
        exit;
    }

    // Construct the appropriate command
    if ($action === 'enable') {
        $command = "sudo a2enmod " . escapeshellarg($mod) . " && sudo systemctl reload apache2";
    } elseif ($action === 'disable') {
        $command = "sudo a2dismod " . escapeshellarg($mod) . " && sudo systemctl reload apache2";
    }

    // Execute the command
    exec($command, $output, $return_var);

    // Check the command result
    $outputStr = implode("\n", $output);
    if ($return_var === 0) {
        // Check the output for confirmation messages
        if (strpos($outputStr, 'already enabled') !== false || strpos($outputStr, 'already disabled') !== false) {
            echo "Module $mod was already " . ($action === 'enable' ? 'enabled' : 'disabled') . ".<br>";
        } else {
            echo "Module $mod has been " . ($action === 'enable' ? 'enabled' : 'disabled') . " successfully.<br>";
        }
    } else {
        echo "Failed to " . ($action === 'enable' ? 'enable' : 'disable') . " module $mod. Error output: " . $outputStr . "<br>";
    }
}
?>

