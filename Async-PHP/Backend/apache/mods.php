<form id="name-form">
    <div>

<label for="simpleDropdown">Enter your name:</label>
    <input type="text" id="simpleDropdown" name="simpleDropdown" placeholder="Enter Mode">


        <label for="simpleDropdown1">Choose an option:</label>
        <select id="simpleDropdown1" name="simpleDropdown1">
            <option value="" disabled selected>Select an option</option>
            <option value="enable">Enable</option>
            <option value="disable">Disable</option>
        </select>
    </div>



    <button class="btn btn-primary mb-3 runScripts" data-url="/Backend/apache/request_mods.php:output2">Execute</button>
</form>

<div id="output2" class="bg-light p-3"></div>
<?php
// Define paths for available and enabled modules
$modsAvailableDir = '/etc/apache2/mods-available/';
$modsEnabledDir = '/etc/apache2/mods-enabled/';

// Function to get the list of all available modules
function getAvailableModules($availableDir) {
    return array_diff(scandir($availableDir), ['..', '.']);
}

// Function to get the list of enabled modules
function getEnabledModules($enabledDir) {
    return array_diff(scandir($enabledDir), ['..', '.']);
}

// Function to get module descriptions from available modules
function getModuleDescriptions($availableDir, $enabledModules) {
    $descriptions = [];

    foreach ($enabledModules as $module) {
        // Check if the module has a corresponding .conf file
        $moduleConfFile = $availableDir . $module;
        if (file_exists($moduleConfFile)) {
            // Read the content of the module config
            $content = file_get_contents($moduleConfFile);
            // Extract a brief description (first line or defined comment)
            if (preg_match('/^#(.*)/m', $content, $matches)) {
                $descriptions[$module] = trim($matches[1]);
            } else {
                // Fallback description if no comment found
                $descriptions[$module] = 'No description available.';
            }
        }
    }

    return $descriptions;
}

// Get all available and enabled modules
$availableModules = getAvailableModules($modsAvailableDir);
$enabledModules = getEnabledModules($modsEnabledDir);

// Get module descriptions
$moduleDescriptions = getModuleDescriptions($modsAvailableDir, $availableModules);

// Start outputting HTML
?>
<div class="container mt-5">
    <h2>Apache Modules</h2>
    <div class="row">
        <?php
        // Loop through available modules and display their status
        foreach ($availableModules as $module) {
            // Check if the module is enabled
            $isEnabled = in_array($module, $enabledModules) ? 'Enabled' : 'Disabled';
            $description = $moduleDescriptions[$module] ?? 'No description available.';
            ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-header">
                        <?php echo htmlspecialchars($module); ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo htmlspecialchars($description); ?></p>
                        <p class="card-text"><strong>Status: <?php echo htmlspecialchars($isEnabled); ?></strong></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>



