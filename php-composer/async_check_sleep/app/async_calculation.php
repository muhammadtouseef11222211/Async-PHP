<?php
$pageTitle = 'Logs'; // Set the page title
include 'reuseable_views/header.php'; ?>


<h1 class="mt-5">Logs</h1>
<button style="margin-left: 100px;" class="runScripts" class="btn btn-primary mb-3" data-url="../Backend/fetch_numbers_async.php">Run Scripts</button>
<h2>Script Outputs:</h2>
<div id="output" class="bg-light p-3"></div>



<?php include 'reuseable_views/footer_json.php'; ?>
