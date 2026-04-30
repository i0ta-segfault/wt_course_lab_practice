<?php
session_start();
include "db.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $u = $_POST['username'];
    $p = $_POST['password'];

    $res = $conn->query("SELECT * FROM users 
                         WHERE username='$u' AND password='$p' AND role='admin'");

    if ($res->num_rows > 0) {
        $_SESSION['admin'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $msg = "Invalid admin login";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="card">
<h2>Admin Login</h2>

<form method="POST">
<input name="username" placeholder="username">
<input name="password" type="password" placeholder="password">
<button>Login</button>
</form>

<p><?php echo $msg; ?></p>
</div>