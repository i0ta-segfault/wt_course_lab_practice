<?php
session_start();
include "db.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['username'] = $username;

        setcookie("user", $username, time() + 300); // 5 min cookie

        header("Location: dashboard.php");
        exit();

    } else {
        $msg = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
<h2>Login</h2>

<form method="POST">
<input name="username" placeholder="Username" required><br>
<input name="password" type="password" placeholder="Password" required><br>
<button type="submit">Login</button>
</form>

<p class="msg"><?php echo $msg; ?></p>
<a href="register.php">Register</a>
</div>

</body>
</html>