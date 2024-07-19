<?php 
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'login_db');
  define('DB_PORT', 3307);
  
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
  if ($conn->connect_error) {
    die('Failed to connect DB') . $conn->connect_error;
  }

  // Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($conn->query($sql) === TRUE) {
    // echo "Database created or already exists.\n";
} else {
    die('Error creating database: ' . $conn->error);
}

// Select the database
$conn->select_db(DB_NAME);

// Create the users table if it doesn't exist
$sql = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(25) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;
";

if ($conn->query($sql) === TRUE) {
    // echo "Table 'users' created or already exists.\n";
} else {
    die('Error creating table users: ' . $conn->error);
}

// Create the news table if it doesn't exist
$sql = "
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(30) NOT NULL,
    description VARCHAR(600) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;
";

if ($conn->query($sql) === TRUE) {
    // echo "Table 'news' created or already exists.\n";
} else {
    die('Error creating table news: ' . $conn->error);
}

// Check if the user 'admin' exists
$username = 'admin';
$password = 'test'; 

$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // User does not exist, insert user
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {
        // echo "User 'admin' created successfully.\n";
    } else {
        die('Error creating user: ' . $stmt->error);
    }
} else {
    // echo "User 'admin' already exists.\n";
}

?>