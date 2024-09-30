<?php
$pageTitle = 'Logs'; // Set the page title
include 'reuseable_views/header.php'; ?>


 <h1>Run Scripts and Get Real-time Output</h1>
    <button class="runScripts btn btn-primary mb-3" data-url="../Backend/10_async_time.php">Run Scripts</button>

    <div id="output"></div>


<?php include 'reuseable_views/footer_realtime_output.php'; ?>

