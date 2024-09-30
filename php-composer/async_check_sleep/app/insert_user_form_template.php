<?php
$pageTitle = 'User insert'; // Set the page title
include 'reuseable_views/header.php'; 
?>

<div class="container mt-5">
    <h2>User Registration</h2>
    <form id="userForm" action="../Backend/insert_user.php" method="POST">
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

	    <button class="runScripts btn btn-primary mb-3" data-url="../Backend/insert_user.php">Run Scripts</button>

    </form>
    
    <!-- Button to trigger form submission -->

    <!-- Output div to show the success or error message -->
    <div id="output" class="bg-light p-3"></div>
</div>

<?php include 'reuseable_views/footer_form.php'; ?>

