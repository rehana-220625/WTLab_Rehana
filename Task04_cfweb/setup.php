<?php
/* ===================================
   DATABASE SETUP FILE
   Create database and users table
   Access: http://localhost/php_cafewebsite/setup.php
   =================================== */

// Database connection parameters (without selecting a database initially)
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

echo "<h2>🔧 Database Setup</h2>";

// Step 1: Create database
$dbname = "userdb";
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";

if ($conn->query($sql_create_db) === TRUE) {
    echo "<p>✅ Database '$dbname' created successfully or already exists</p>";
} else {
    echo "<p>❌ Error creating database: " . $conn->error . "</p>";
    die();
}

// Close connection and reconnect to the specified database
$conn->close();
$conn = new mysqli($servername, $username, $password, $dbname);

// Step 2: Create users table
$sql_create_table = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql_create_table) === TRUE) {
    echo "<p>✅ Table 'users' created successfully or already exists</p>";
} else {
    echo "<p>❌ Error creating table: " . $conn->error . "</p>";
    die();
}

echo "<p><strong>Database Setup Complete!</strong></p>";
echo "<p>You can now proceed to the <a href='register.html'>Registration Page</a></p>";

$conn->close();
?>
