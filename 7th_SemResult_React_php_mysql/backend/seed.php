<?php
$conn = new mysqli("localhost", "root", "");

$conn->query("CREATE DATABASE IF NOT EXISTS vit_result");
$conn->select_db("vit_result");

$conn->query("
CREATE TABLE IF NOT EXISTS subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    mse INT DEFAULT 0,
    ese INT DEFAULT 0
)");

$conn->query("DELETE FROM subjects");

$conn->query("
INSERT INTO subjects (name, mse, ese) VALUES
('SDAM', 0, 0),
('WT', 0, 0),
('CD', 0, 0),
('DAA', 0, 0)
");

echo "Seeded";
?>