<?php
session_start();
include "db.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$session_id = session_id();

$conn->query("DELETE FROM user_sessions 
              WHERE last_activity < NOW() - INTERVAL 5 MINUTE");

$conn->query("UPDATE user_sessions 
              SET last_activity = NOW() 
              WHERE session_id='$session_id'");

$result = $conn->query("SELECT COUNT(*) as count 
                        FROM user_sessions 
                        WHERE username='$username'");
$row = $result->fetch_assoc();
$count = $row['count'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial; text-align:center; padding-top:50px; }
        .card { border:1px solid #ccc; padding:20px; display:inline-block; }
        .count { font-size:24px; color:green; }
    </style>
</head>
<body>

<div class="card">
    <h2>Welcome <?php echo $username; ?></h2>

    <p>Active Sessions:</p>
    <p class="count"><?php echo $count; ?> / 3</p>

    <p>Session timeout: 5 minutes inactivity</p>

    <a href="logout.php">Logout</a>
</div>

</body>
</html>