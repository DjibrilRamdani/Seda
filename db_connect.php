<?php
$servername = "mysql-prest.alwaysdata.net";
$username = "prest_seda";
$password = "Seda13200!";
$dbname = "prest_stage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
