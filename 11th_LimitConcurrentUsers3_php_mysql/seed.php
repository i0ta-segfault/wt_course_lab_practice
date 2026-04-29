<?php

$conn = new mysqli("localhost", "root", "");

if ($conn->connect_error) {
    die("Connection failed");
}

$conn->query("CREATE DATABASE IF NOT EXISTS concurrent_session_db");
$conn->select_db("concurrent_session_db");

$conn->query("
CREATE TABLE IF NOT EXISTS user_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    session_id VARCHAR(100),
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
    ON UPDATE CURRENT_TIMESTAMP
)");

echo "Database and table ready";

?>