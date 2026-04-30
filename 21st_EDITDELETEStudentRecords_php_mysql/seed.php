<?php
$conn = new mysqli("localhost", "root", "");
$conn->query("CREATE DATABASE IF NOT EXISTS crud_student_db");
$conn->select_db("crud_student_db");

$conn->query("
CREATE TABLE IF NOT EXISTS students(
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(50),
 email VARCHAR(50)
)");

$conn->query("INSERT INTO students(name,email)
VALUES ('M','m@mail.com'), ('F', 'f@mail.com'), ('T','t@mail.com'), ('S', 's@mail.com'), ('B','b@mail.com'), ('J', 'j@mail.com')");

echo "DB ready";
?>