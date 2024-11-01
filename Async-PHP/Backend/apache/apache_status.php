<?php
header('Content-Type: text/html');

// Function to get Apache status
function getApacheStatus() {
    $status = shell_exec("systemctl is-active apache2");
    return trim($status);
}

// Function to get total RAM usage by Apache
function getApacheRamUsage() {
    $ramUsage = shell_exec("ps aux | grep apache2 | awk '{sum+=$4} END {print sum}'");
    return trim($ramUsage);
}

// Function to get total CPU usage by Apache
function getApacheCpuUsage() {
    $cpuUsage = shell_exec("ps aux | grep apache2 | awk '{sum+=$3} END {print sum}'");
    return trim($cpuUsage);
}

// Function to get enabled sites
function getEnabledSites() {
    $sites = shell_exec("ls /etc/apache2/sites-enabled/");
    return explode("\n", trim($sites));
}

// Function to get Apache ports
function getApachePorts() {
    $ports = shell_exec("grep -i 'Listen' /etc/apache2/ports.conf");
    return explode("\n", trim($ports));
}

// Function to get enabled and disabled modules
function getApacheModules() {
    $enabledModules = shell_exec("apache2ctl -M");
    $disabledModules = shell_exec("apache2ctl -t -D DUMP_MODULES");

    $enabled = explode("\n", trim($enabledModules));
    $disabled = explode("\n", trim($disabledModules));

    return [
        'enabled' => array_filter($enabled, fn($module) => !empty($module)),
        'disabled' => array_filter($disabled, fn($module) => !empty($module)),
    ];
}

// Start HTML Output
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apache Server Real-Time Status</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .module {
            flex: 0 0 12.5%; /* 8 modules per row */
            box-sizing: border-box;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 10px;
            background-color: #f8f9fa;
        }
        @media (max-width: 768px) {
            .module {
                flex: 0 0 25%; /* 4 modules per row on smaller screens */
            }
        }
        @media (max-width: 576px) {
            .module {
                flex: 0 0 50%; /* 2 modules per row on extra small screens */
            }
        }
    </style>
</head>
<body class="container mt-5">
    <h1 class="mb-4">Apache Server Real-Time Status</h1>
';

// Fetch and display Apache status
$apache_status = getApacheStatus();
echo '<div class="alert alert-' . ($apache_status === 'active' ? 'success' : 'danger') . '"><strong>Apache Status:</strong> ' . ($apache_status === 'active' ? 'Active' : 'Inactive') . '</div>';

// Fetch and display Apache RAM usage
$apache_ram_usage = getApacheRamUsage();
$ram_usage_percentage = floatval($apache_ram_usage);
echo '
<div class="alert alert-info">
    <strong>Apache RAM Usage:</strong> ' . $apache_ram_usage . '%
    <div class="progress mt-2">
        <div class="progress-bar" role="progressbar" style="width: ' . $ram_usage_percentage . '%;" aria-valuenow="' . $ram_usage_percentage . '" aria-valuemin="0" aria-valuemax="100">' . $apache_ram_usage . '%</div>
    </div>
</div>
';

// Fetch and display Apache CPU usage
$apache_cpu_usage = getApacheCpuUsage();
$cpu_usage_percentage = floatval($apache_cpu_usage);
echo '
<div class="alert alert-info">
    <strong>Apache CPU Usage:</strong> ' . $apache_cpu_usage . '%
    <div class="progress mt-2">
        <div class="progress-bar" role="progressbar" style="width: ' . $cpu_usage_percentage . '%;" aria-valuenow="' . $cpu_usage_percentage . '" aria-valuemin="0" aria-valuemax="100">' . $apache_cpu_usage . '%</div>
    </div>
</div>
';

// Fetch and display enabled sites
$enabled_sites = getEnabledSites();
echo '<div class="alert alert-light"><strong>Enabled Sites:</strong><ul class="list-unstyled">';
foreach ($enabled_sites as $site) {
    echo '<li>' . htmlspecialchars($site) . '</li>';
}
echo '</ul></div>';

// Fetch and display Apache ports
$apache_ports = getApachePorts();
echo '<div class="alert alert-light"><strong>Apache Ports:</strong><ul class="list-unstyled">';
foreach ($apache_ports as $port) {
    echo '<li>' . htmlspecialchars($port) . '</li>';
}
echo '</ul></div>';

// Fetch and display enabled modules
$modules = getApacheModules();
echo '
<div class="alert alert-light">
    <div class="d-flex flex-wrap">
';
foreach ($modules['enabled'] as $module) {
    echo '<div class="module">' . htmlspecialchars(trim($module)) . '</div>';
}
echo '
    </div>
</div>
';


echo '
</body>
</html>
';
?>

