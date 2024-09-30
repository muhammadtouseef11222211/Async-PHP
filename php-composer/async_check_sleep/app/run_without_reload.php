<?php
$pageTitle = 'test page'; // Set the page title
?>

<?php include 'reuseable_views/header.php'; ?>
<h1 class="mt-5">Run Async Scripts</h1>

<form id="name-form">
    <input type="text" id="name" name="name" placeholder="Enter your name">

<button class="btn btn-primary mb-3 runScripts" data-url="../Backend/insert_name.php">Run Test 3</button>

</form>

<button class="btn btn-primary mb-3 runScripts" data-url="../Backend/test.php">Run Test 1</button>
<button class="runScripts" data-url="../Backend/test1.php">Run Test 2</button>
<button class="btn btn-primary mb-3 runScripts" data-url="../Backend/test2.php">Run Test 3</button>

<h2>Script Outputs:</h2>
<div id="output" class="bg-light p-3"></div>

<?php include 'reuseable_views/footer.php'; ?>

