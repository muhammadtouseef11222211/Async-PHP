<?php
include '../lib/macro/macro_insert.php'; // Include the include function


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $data = [
        'product_name' => $_POST['product_name'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'stock' => $_POST['stock']
    ];

    // Call the insert function
    $result = insertIntoTable('products', $data);
    echo $result; // Output the result
}
?>

