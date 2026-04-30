<?php
include "db.php";

$id = $_GET['id'];

$conn->query("UPDATE seats SET status='booked' WHERE id=$id");

header("Location: seats.php");
?>