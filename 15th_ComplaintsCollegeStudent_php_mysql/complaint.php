<?php
session_start();
include "db.php";

if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $msg = $_POST['message'];
    $sid = $_SESSION['student_id'];

    $conn->query("INSERT INTO complaints (student_id, message)
                  VALUES ($sid, '$msg')");
}
?>

<link rel="stylesheet" href="style.css">

<div class="card">
<h2>Submit Complaint</h2>

<form method="POST">
<textarea name="message" placeholder="Enter complaint"></textarea>
<button>Submit</button>
</form>

<a href="logout.php">Logout</a>
</div>