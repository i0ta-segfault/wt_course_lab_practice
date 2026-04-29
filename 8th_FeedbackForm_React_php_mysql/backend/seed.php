<?php
$conn = new mysqli("localhost", "root", "");

$conn->query("CREATE DATABASE IF NOT EXISTS feedback_db");
$conn->select_db("feedback_db");

$conn->query("
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    course VARCHAR(50),
    message TEXT
)");

echo "DB Ready";
?>