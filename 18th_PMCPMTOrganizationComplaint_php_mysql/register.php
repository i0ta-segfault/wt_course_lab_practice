<?php
include "db.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $u = $_POST['username'];
    $e = $_POST['email'];
    $p = $_POST['password'];

    if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalid email";
    } else {
        $conn->query("
        INSERT INTO users (username, email, password, role)
        VALUES ('$u','$e','$p','user')
        ");
        $msg = "Registered";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="card">
<h2>Register</h2>

<form method="POST">
<input name="username" placeholder="Username">
<input name="email" placeholder="Email">
<input name="password" type="password" placeholder="Password">
<button>Register</button>
</form>

<p><?php echo $msg; ?></p>
<a href="login.php">Login</a>
</div>