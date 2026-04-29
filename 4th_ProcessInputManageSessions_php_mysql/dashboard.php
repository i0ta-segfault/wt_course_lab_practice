<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php?msg=Please Login First");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome <?php echo $_SESSION['user']; ?></h2>

<?php
if (isset($_COOKIE['username'])) {
    echo "<p>Cookie User: " . $_COOKIE['username'] . "</p>";
}
?>

<br>
<a href="logout.php">Logout</a>

</body>
</html>