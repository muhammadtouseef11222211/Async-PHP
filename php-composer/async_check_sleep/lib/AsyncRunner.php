<?php
function runScriptsAsync(array $scripts) {
    $descriptorspec = [
        0 => ["pipe", "r"],  // stdin
        1 => ["pipe", "w"],  // stdout
        2 => ["pipe", "w"],  // stderr
    ];

    $processes = [];
    $pipes = [];
    $outputs = [];

    // Start processes for each script
    foreach ($scripts as $index => $script) {
        $process = proc_open("php $script", $descriptorspec, $pipes[$index]);
        if (is_resource($process)) {
            $processes[$index] = $process;
        } else {
            echo "Failed to start $script\n";
        }
    }

    // Optionally, you can read output
    foreach ($pipes as $index => $pipe) {
        $outputs[$index] = stream_get_contents($pipe[1]);
        fclose($pipe[1]); // Close stdout
    }

    // Close the processes when done
    foreach ($processes as $index => $process) {
        proc_close($process);
    }

    // Return the outputs if needed
    return $outputs;
}
?>

