<?php
$conn = new mysqli("localhost", "root", "", "airplane_db");

if ($conn->connect_error) die("DB failed");
?>