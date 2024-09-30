<?php
require_once 'db_connect.php'; // Include your database connection file

// Define the SQL query
$sql = "SELECT msn FROM meter"; // Adjust the table name if needed

// Execute the query
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output each row
    while($row = $result->fetch_assoc()) {
        echo "MSN: " . $row['msn'] . "<br>"; // Output the msn value
    }
} else {
    echo "No results found.";
}

// Close the connection
$conn->close();
?>

