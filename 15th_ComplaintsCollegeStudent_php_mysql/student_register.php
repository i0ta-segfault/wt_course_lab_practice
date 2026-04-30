<?php
include "db.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($username == "" || $email == "" || $password == "") {
        $msg = "All fields required";
    }

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalid email format";
    }

    else {
        $res = $conn->query("SELECT * FROM users WHERE username='$username'");

        if ($res->num_rows > 0) {
            $msg = "Username already exists";
        } else {

            $conn->query("
                INSERT INTO users (username, email, password, role)
                VALUES ('$username', '$email', '$password', 'student')
            ");

            $msg = "Registered successfully. Go to login.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Register</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
<h2>Student Registration</h2>

<form method="POST">
<input name="username" placeholder="Username">
<input name="email" type="email" placeholder="Email">
<input name="password" type="password" placeholder="Password">
<button type="submit">Register</button>
</form>

<p><?php echo $msg; ?></p>

<a href="student_login.php">Go to Login</a>
</div>

</body>
</html>