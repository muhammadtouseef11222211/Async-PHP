<?php
$pageTitle = 'Logs'; // Set the page title
include 'reuseable_views/header.php'; ?>


<h1 class="mt-5">Logs</h1>
<button class="runScripts" class="btn btn-primary mb-3" data-url="../Backend/100_async_time.php">Run Scripts</button>
<h2>Script Outputs:</h2>
<div id="output" class="bg-light p-3"></div>



<?php include 'reuseable_views/footer_async.php'; ?>

