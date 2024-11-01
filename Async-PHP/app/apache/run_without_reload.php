<?php
$pageTitle = 'test page'; // Set the page title
?>

<?php include 'reuseable_views/header.php'; ?>


<button class="btn btn-dark mb-3 runScripts" data-url="/Backend/apache/apache_status.php:output1">Apache Stats</button>
<button class="btn btn-dark mb-3 runScripts" data-url="/Backend/apache/ports.php:output1">Ports</button>
<button class="btn btn-dark mb-3 runScripts" data-url="../Backend/apache/enable.php:output1">Enable/Disable</button>
<button class="btn btn-dark mb-3 runScripts" data-url="../Backend/apache/mods.php:output1">Mods</button>


<div id="output1" class="bg-light p-3"></div>


