<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$cookieUser = $_COOKIE['user'] ?? "No cookie";
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
<h2>Welcome <?php echo $username; ?></h2>

<p>Session Active ✔</p>
<p>Cookie User: <?php echo $cookieUser; ?></p>

<a href="logout.php">Logout</a>
</div>

</body>
</html>