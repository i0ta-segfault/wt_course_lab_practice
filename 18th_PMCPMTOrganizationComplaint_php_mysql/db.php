<?php
$conn = new mysqli("localhost", "root", "", "complaint_mgmt_db");

if ($conn->connect_error) die("DB failed");
?>