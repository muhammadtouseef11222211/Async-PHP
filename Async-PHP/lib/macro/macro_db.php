<?php
function db_connect($host, $user, $password, $dbname, $port = 3306) {
    return (new mysqli($host, $user, $password, $dbname, $port))->connect_error ? die("Connection failed: " . (new mysqli($host, $user, $password, $dbname, $port))->connect_error) : (new mysqli($host, $user, $password, $dbname, $port));
}

?>
