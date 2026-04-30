<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $org = $_POST['org'];
    $cat = $_POST['cat'];
    $msg = $_POST['message'];
    $uid = $_SESSION['user_id'];

    $conn->query("
    INSERT INTO complaints (user_id, organization, category, message)
    VALUES ($uid, '$org', '$cat', '$msg')
    ");
}
?>

<link rel="stylesheet" href="style.css">

<div class="card">
<h2>Submit Complaint</h2>

<form method="POST">
<select name="org">
<option>PMC</option>
<option>PMT</option>
<option>College</option>
</select>

<select name="cat">
<option>Service Delay</option>
<option>Cleanliness</option>
<option>Transport Issue</option>
<option>Other</option>
</select>

<textarea name="message"></textarea>
<button>Submit</button>
</form>

<a href="dashboard.php">My Complaints</a><br>
<a href="logout.php">Logout</a>
</div>