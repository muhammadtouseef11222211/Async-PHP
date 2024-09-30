<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";
$port = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }




//else{
//    echo "Connected successfully";
//}
// Make sure to stop connection in files where you will use this


?>

