<?php
// Database connection settings
$servername = "localhost";   // Server name or IP address, usually "localhost" for local development
$username = "root";          // Database username, usually "root" for local development environments
$password = "";              // Database password, usually empty for local development
$dbname = "law_firm";        // The name of your database (make sure it matches the database you created in phpMyAdmin)

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Connection is now available as $conn for any script that includes db.php
?>
