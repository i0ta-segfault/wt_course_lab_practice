<?php
session_start();
include "db.php";

$conn->query("DELETE FROM user_sessions 
              WHERE session_id='" . session_id() . "'");

session_destroy();

header("Location: login.php");
?>