<?php
require_once 'db_connect.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted form data
    $first_name = $conn->real_escape_string(trim($_POST['first_name']));
    $last_name = $conn->real_escape_string(trim($_POST['last_name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Encrypt password

    // SQL query to insert user into the database
    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid Request";
}
?>

