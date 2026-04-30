<?php
include "db.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $rawPassword = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalid email format";
    } 
    else {

        $password = password_hash($rawPassword, PASSWORD_DEFAULT);

        $result = $conn->query("SELECT * FROM users WHERE username='$username'");

        if ($result->num_rows > 0) {
            $msg = "Username already exists";
        } else {
            $conn->query("INSERT INTO users (username, email, password) 
                          VALUES ('$username', '$email', '$password')");
            $msg = "Registered successfully";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
<h2>Register</h2>

<form method="POST">
<input name="username" placeholder="Username" required><br>
<input name="email" type="email" placeholder="Email" required><br>
<input name="password" type="password" placeholder="Password" required><br>
<button type="submit">Register</button>
</form>

<p class="msg"><?php echo $msg; ?></p>
<a href="login.php">Go to Login</a>
</div>

</body>
</html>