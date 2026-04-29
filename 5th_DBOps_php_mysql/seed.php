<?php
// http://localhost/.../seed.php

$conn = new mysqli("localhost", "root", "");

if ($conn->connect_error) {
    die("Connection failed");
}

$conn->query("CREATE DATABASE IF NOT EXISTS student_db");

$conn->select_db("student_db");

$conn->query("
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
)");

echo "Database and table ready";
?>