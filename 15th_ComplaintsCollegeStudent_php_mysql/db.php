<?php
$conn = new mysqli("localhost", "root", "", "complaint_db");

if ($conn->connect_error) {
    die("DB failed");
}
?>