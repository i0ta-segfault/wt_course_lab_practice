<?php

$conn = new mysqli("localhost", "root", "");

if ($conn->connect_error) die("Connection failed");

$conn->query("CREATE DATABASE IF NOT EXISTS airplane_db");
$conn->select_db("airplane_db");

$conn->query("
CREATE TABLE IF NOT EXISTS seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seat_no VARCHAR(5),
    status VARCHAR(20) DEFAULT 'available'
)");

// check if seats empty, insert only then
$res = $conn->query("SELECT COUNT(*) as c FROM seats");
$count = $res->fetch_assoc()['c'];

if ($count == 0) {
    $rows = 10;
    $cols = ['A','B','C','D','E','F'];

    for ($i=1; $i <= $rows; $i++) {
        foreach ($cols as $c) {
            $seat = $i.$c;
            $conn->query("INSERT INTO seats (seat_no) VALUES ('$seat')");
        }
    }
}

echo "DB ready";
?>