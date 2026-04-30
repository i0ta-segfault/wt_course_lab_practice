<?php
session_start();
include "db.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $u = $_POST['username'];
    $p = $_POST['password'];

    $res = $conn->query("
    SELECT * FROM users WHERE username='$u' AND password='$p'
    ");

    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: complaint.php");
        }
        exit();
    } else {
        $msg = "Invalid login";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="card">
<h2>Login</h2>

<form method="POST">
<input name="username" placeholder="Username">
<input name="password" type="password" placeholder="Password">
<button>Login</button>
</form>

<p><?php echo $msg; ?></p>
<a href="register.php">Register</a>
</div>