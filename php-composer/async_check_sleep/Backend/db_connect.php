<?php
$servername = "mysql-26efb892-muhammadtou420-27e1.c.aivencloud.com";
$username = "avnadmin";
$password = "AVNS_rIWbK0jA00JibIIZ1W1";
$dbname = "test";
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
                    ?>

