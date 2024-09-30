<?php
$pageTitle = 'Product Entry'; // Set the page title
include 'reuseable_views/header.php'; 
?>

<div class="container mt-5">
    <h2>Add New Product</h2>
    <form id="productForm" action="../Backend/insert_product.php" method="POST">
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock Quantity</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>

	    <button class="runScripts btn btn-primary mb-3" data-url="../Backend/insert_product.php">Add Product</button>

    </form>

    <!-- Button to submit the form using AJAX -->

    <!-- Output div to display the success or error message -->
    <div id="output" class="bg-light p-3"></div>
</div>

<?php include 'reuseable_views/footer_form.php'; ?>
