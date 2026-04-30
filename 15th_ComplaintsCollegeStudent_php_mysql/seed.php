<?php

$conn = new mysqli("localhost", "root", "");

if ($conn->connect_error) {
    die("Connection failed");
}

$conn->query("CREATE DATABASE IF NOT EXISTS complaint_db");

$conn->select_db("complaint_db");

$conn->query("
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(50),
    password VARCHAR(50),
    role VARCHAR(20)
)");

$conn->query("
CREATE TABLE IF NOT EXISTS complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// populating default admin
$conn->query("
INSERT INTO users (username, email, password, role)
VALUES ('admin', 'admin123@admin.com', 'admin123', 'admin')
");

echo "DB ready";

?>