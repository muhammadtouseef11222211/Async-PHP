<?php

require_once '../lib/AsyncRunner.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $path = '../async_scripts';
    $scripts = ["$path/db_script1.php", "$path/db_script2.php", "$path/db_script3.php"];
    
    $outputs = runScriptsAsync($scripts); // Call the function directly

    foreach ($outputs as $output) {
        echo "<pre>$output</pre>";
    }
}

echo "Script executed successfully.";

?>
