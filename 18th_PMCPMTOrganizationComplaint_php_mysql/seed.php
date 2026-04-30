<?php

$conn = new mysqli("localhost", "root", "");

if ($conn->connect_error) die("Connection failed");

$conn->query("CREATE DATABASE IF NOT EXISTS complaint_mgmt_db");
$conn->select_db("complaint_mgmt_db");

$conn->query("
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(50),
    password VARCHAR(50),
    role VARCHAR(20)
)");

$conn->query("
CREATE TABLE complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    organization VARCHAR(50),
    category VARCHAR(50),
    message TEXT,
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$conn->query("
INSERT INTO users (username, email, password, role)
VALUES ('admin', 'admin@mail.com', 'admin123', 'admin')
");

echo "DB ready";
?>