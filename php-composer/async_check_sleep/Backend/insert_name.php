<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    $sql = "INSERT INTO test (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Name inserted successfully!";
    } else {
        echo "Error inserting name: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
