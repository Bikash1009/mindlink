<?php
// Create connection to MySQL
$host = "localhost";
$username = "root";
$password = "";
$database_name = "mindlink"; // Ensure this database exists!

$database = new mysqli($host, $username, $password, $database_name);

// Check connection
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
} else 
// {
//     echo "Connected successfully to database: " . $database_name;
// }
?>
