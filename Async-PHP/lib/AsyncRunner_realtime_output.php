<?php
function runScriptsAsync(array $scripts) {
    $descriptorspec = [
        0 => ["pipe", "r"],  // stdin
        1 => ["pipe", "w"],  // stdout
        2 => ["pipe", "w"],  // stderr
    ];

    $processes = [];
    $pipes = [];

    // Start processes for each script
    foreach ($scripts as $index => $script) {
        $process = proc_open("php $script", $descriptorspec, $pipes[$index]);
        if (is_resource($process)) {
            $processes[$index] = $process;
        } else {
            echo "data: Failed to start $script\n\n";
            ob_flush();
            flush();
        }
    }

    // Continuously check and output real-time results
    foreach ($processes as $index => $process) {
        if (is_resource($process)) {
            // Read output of each script in real-time
            while (!feof($pipes[$index][1])) {
                $output = fgets($pipes[$index][1]);
                echo "data: Script $index output: " . trim($output) . "\n\n";
                ob_flush();
                flush();
            }
            fclose($pipes[$index][1]);
            fclose($pipes[$index][2]);
            proc_close($process);
        }
    }
}
?>
