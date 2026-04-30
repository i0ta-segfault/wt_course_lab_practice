<?php

$conn = new mysqli("localhost", "root", "");

if ($conn->connect_error) {
    die("Connection failed");
}

$conn->query("CREATE DATABASE IF NOT EXISTS waste_db");
$conn->select_db("waste_db");

$conn->query("
CREATE TABLE IF NOT EXISTS waste_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location VARCHAR(100),
    waste_type VARCHAR(50),
    description TEXT,
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

echo "DB ready";
?>