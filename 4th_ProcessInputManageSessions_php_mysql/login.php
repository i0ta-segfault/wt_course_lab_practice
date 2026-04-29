<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <?php
    if (isset($_GET['msg'])) {
        echo "<p class='message'>" . $_GET['msg'] . "</p>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (!isset($_SESSION['registered_user'])) {
            header("Location: login.php?msg=No Registered User");
            exit();
        }

        if ($_POST['username'] !== $_SESSION['registered_user'] || $_POST['password'] !== "admin123") {
            header("Location: login.php?msg=Invalid Credentials");
            exit();
        }

        $_SESSION['user'] = $_POST['username'];
        header("Location: dashboard.php");
        exit();
    }
    ?>
</div>

</body>
</html>