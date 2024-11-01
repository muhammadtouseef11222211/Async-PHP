<form id="name-form">
    <div>

<label for="simpleDropdown">Enter your name:</label>
    <input type="text" id="simpleDropdown" name="simpleDropdown" placeholder="Enter site name">
    <input type="text" id="simpleDropdown2" name="simpleDropdown2" placeholder="Enter Port">
    <input type="text" id="simpleDropdown3" name="simpleDropdown3" placeholder="Enter Dir">


        <label for="simpleDropdown1">Choose an option:</label>
        <select id="simpleDropdown1" name="simpleDropdown1">
            <option value="" disabled selected>Select an option</option>
            <option value="enable">Enable</option>
            <option value="disable">Disable</option>
        </select>
    </div>



    <button class="btn btn-primary mb-3 runScripts" data-url="/Backend/apache/request_site.php:output2">Execute</button>
</form>

<div id="output2" class="bg-light p-3"></div>



<?php
// Define the path to the Apache sites-enabled directory
$sitesEnabledDir = '/etc/apache2/sites-enabled/';

// Function to get files from the directory using scandir
function getFiles($dir) {
    return array_diff(scandir($dir), ['..', '.']); // Exclude '.' and '..'
}

// Function to extract port and document root from a configuration file
function getSiteDetails($filePath) {
    $details = ['port' => null, 'path' => null];

    // Read the configuration file
    if ($config = file_get_contents($filePath)) {
        // Extract DocumentRoot
        preg_match('/DocumentRoot\s+(.+)/', $config, $rootMatches);
        
        // Use the command to extract ports, ensuring only the ports are output
        $command = "awk -F: '/<VirtualHost/ {print \$2}' " . escapeshellarg($filePath) . " | tr -d ' >'";
        $portOutput = shell_exec($command);
        
        // Store document root
        if (isset($rootMatches[1])) {
            $details['path'] = trim($rootMatches[1]);
        }
        
        // Store ports (comma-separated)
        if ($portOutput) {
            $details['port'] = trim($portOutput);
        }
    }

    return $details;
}

// Get the list of files
$files = getFiles($sitesEnabledDir);

// Start outputting HTML
echo '
    <div class="container mt-5">
        <h2>Apache Site Configurations in ' . htmlspecialchars($sitesEnabledDir) . '</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Document Root</th>
                    <th>Port</th>
                </tr>
            </thead>
            <tbody>';

// Loop through and display each file with its details
foreach ($files as $file) {
    $filePath = $sitesEnabledDir . $file;
    $siteDetails = getSiteDetails($filePath);

    echo '<tr>';
    echo '<td>' . htmlspecialchars($file) . '</td>'; // File name
    echo '<td>' . htmlspecialchars($siteDetails['path'] ?? 'N/A') . '</td>'; // Document root
    echo '<td>' . htmlspecialchars($siteDetails['port'] ?? 'N/A') . '</td>'; // Port
    echo '</tr>';
}

// Close the table and HTML structure
echo '        </tbody>
        </table>
    </div>
</body>
</html>';
?>

