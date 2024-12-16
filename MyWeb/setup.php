<?php
// Create connection to database
$servername = "sql200.infinityfree.com";
$username = "if0_37924777";
$password = "xpIk9zrI0ZrjQZl"; 
$dbname = "sbank";
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it does not exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database $dbname created successfully (or already exists).<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database to work with
$conn->select_db($dbname);

// Create the 'users' table if it does not exist
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL, 
    pwd VARCHAR(255) NOT NULL,
    firstname VARCHAR(30) NOT NULL, 
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(100) NOT NULL, 
    address VARCHAR(255) NOT NULL,
    money DOUBLE,
    account INT(11) NOT NULL,
    PRIMARY KEY (id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Insert sample data into the 'users' table
$sql = "INSERT INTO users (username, pwd, firstname, lastname, email, address, money, account) 
        VALUES
        ('admin', 'sup3rP@ssw0rd', 'Tony', 'Mai', 'admin@sbank.com', '316 Center Street NE, Calgary, T5O 6K9', 0, 123456),
        ('emmajohnson', 'password', 'Emma', 'Johnson', 'emmajohnson@gmail.com', '789 67 Ave SW, Calgary, T0Y 9MO', 5000000, 654321),
        ('sarahlee', 'password', 'Sarah', 'Lee', 'sarahlee@example.com', '321 Maple Avenue, Edmonton, AB, T5J 1N8', 40500.00, 444444),
        ('w3ird_buddy', 'password', 'Michelle', 'Lee', 'weirdbuddy@gmail.com', '765 9 Ave SW, Calgary, T0Y 8N2', 50000000, 456789)";

if ($conn->query($sql) === TRUE) {
    echo "Sample data inserted into 'users' table.<br>";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the connection
$conn->close();

header("Location: login.php");
exit();

?>