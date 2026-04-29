<?php
$conn = new mysqli("localhost", "root", "", "concurrent_session_db");

if ($conn->connect_error) {
    die("DB connection failed");
}
?>