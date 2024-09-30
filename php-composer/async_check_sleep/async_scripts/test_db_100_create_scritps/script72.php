<?php
// insert_time.php
$servername = "mysql-26efb892-muhammadtou420-27e1.c.aivencloud.com";
$username = "avnadmin";
$password = "AVNS_rIWbK0jA00JibIIZ1W1";
$dbname = "your_database_name";
$port = 14786;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

//    echo "Connected successfully";

    // Perform a query (optional)
    $sql = "SELECT VERSION()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output the result
            $row = $result->fetch_assoc();
//              echo "MySQL version: " . $row["VERSION()"];
                } else {
                    echo "0 results";
                    }

                    // Close connection



function getCurrentTimeWithMilliseconds() {
    $microtime = microtime(true);
    return [
        'datetime' => date('Y-m-d H:i:s', (int)$microtime),
        'milliseconds' => sprintf('%03d', ($microtime - (int)$microtime) * 1000)
    ];
}

// Check if the table exists
$tableCheckResult = $conn->query("SHOW TABLES LIKE 'check_time'");
if ($tableCheckResult->num_rows == 0) {
    echo "Table 'check_time' does not exist. Please create the table first.\n";
    exit; // Exit the script
}

$currentTime = getCurrentTimeWithMilliseconds();
$createdAt = $currentTime['datetime'];
$timeInMilliseconds = (int)($currentTime['milliseconds'] + (microtime(true) * 1000)); // total milliseconds

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO check_time (created_at, time_in_milliseconds) VALUES (?, ?)");
$stmt->bind_param("si", $createdAt, $timeInMilliseconds);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully: created_at = $createdAt, time_in_milliseconds = $timeInMilliseconds\n";
} else {
    echo "Error: " . $stmt->error . "\n";
}

// Close connections
$stmt->close();
$conn->close();
?>
