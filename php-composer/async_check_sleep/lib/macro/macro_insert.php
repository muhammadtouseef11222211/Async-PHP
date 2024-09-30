<?php
include 'db_conn.php'; // Include the database connection file

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

function insertIntoTable($table, $data) {
    global $conn; // Use the global connection variable

    // Create placeholders for prepared statement
    $columns = implode(", ", array_keys($data));
    $placeholders = implode(", ", array_fill(0, count($data), '?'));

    // Prepare the SQL statement
    $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

    // Initialize and prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the variables to the prepared statement as parameters
        $stmt->bind_param(str_repeat('s', count($data)), ...array_values($data));

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            return "Record added successfully!";
        } else {
            return "Execution Error: " . $stmt->error . " | SQL: " . $sql . " | Data: " . json_encode($data);
        }

        // Close the statement
        $stmt->close();
    } else {
        return "Preparation Error: " . $conn->error . " | SQL: " . $sql;
    }
}
?>

