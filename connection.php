<?php
$servername = "localhost";  // Usually 'localhost' if the database is on the same server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "book";   // The name of the database you want to connect to

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br>";
?>
