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
?>