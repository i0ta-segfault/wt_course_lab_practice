<?php
session_start();

$name = $_GET['name'];
$email = $_GET['email'];
$password = $_GET['password'];

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

header("Location: index.php?msg=GET Success for $name");
?>