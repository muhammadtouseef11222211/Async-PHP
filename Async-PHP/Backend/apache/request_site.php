<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site = escapeshellarg($_POST['simpleDropdown'] ?? '');
    $status = $_POST['simpleDropdown1'] ?? ''; // Use this to enable/disable
    $port = escapeshellarg($_POST['simpleDropdown2'] ?? '');
    $dir = escapeshellarg($_POST['simpleDropdown3'] ?? '');

    // Echo the value of $dir for confirmation
    echo "Directory: " . htmlspecialchars($dir) . "<br>";

    // Construct the Apache config content with symlink support
    $configContent = "
<VirtualHost *:$port>
    ServerName $site
    DocumentRoot $dir

    <Directory $dir>
        Options FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/$site-error.log
    CustomLog \${APACHE_LOG_DIR}/$site-access.log combined
</VirtualHost>
";

    // Path to the new configuration file
    $configFilePath = "/etc/apache2/sites-available/$site.conf";

    // Check if the configuration file already exists
    if (!file_exists($configFilePath)) {
        // Create the configuration file using shell_exec
        $command = "echo " . escapeshellarg($configContent) . " | sudo tee $configFilePath > /dev/null";
        $result = shell_exec($command);
        echo "Configuration file created: $configFilePath<br>";
    } else {
        echo "Configuration file already exists: $configFilePath<br>";
    }

    // Enable or disable the site based on the status
    if ($status === 'enable') {
        shell_exec("sudo a2ensite $site");
        echo "Site enabled: $site<br>";
    } elseif ($status === 'disable') {
        shell_exec("sudo a2dissite $site");
        echo "Site disabled: $site<br>";
    }

    // Reload Apache to apply changes
    shell_exec("sudo systemctl reload apache2");
    echo "Apache reloaded.<br>";
}
?>

