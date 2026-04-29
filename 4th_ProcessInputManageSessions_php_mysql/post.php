<?php
session_start();

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?msg=Invalid Email");
    exit();
}

if ($password !== "admin123") {
    header("Location: index.php?msg=Wrong Password");
    exit();
}

$_SESSION['registered_user'] = $name;
setcookie("username", $name, time() + 3600);

header("Location: index.php?msg=POST Success for $name");
?>