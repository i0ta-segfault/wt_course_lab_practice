<?php
session_start();
include "db.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $session_id = session_id();

    $conn->query("DELETE FROM user_sessions 
                  WHERE last_activity < NOW() - INTERVAL 5 MINUTE");

    $result = $conn->query("SELECT COUNT(*) as count 
                            FROM user_sessions 
                            WHERE username='$username'");
    $row = $result->fetch_assoc();

    if ($row['count'] >= 3) {
        $msg = "Max 3 sessions reached!";
    } else {

        $conn->query("INSERT INTO user_sessions (username, session_id) 
                      VALUES ('$username', '$session_id')");

        $_SESSION['username'] = $username;

        header("Location: dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial; text-align:center; padding-top:50px; }
        .box { border:1px solid #ccc; padding:20px; display:inline-block; }
        input, button { margin:10px; padding:8px; }
        .msg { color:red; }
    </style>
</head>
<body>

<div class="box">
    <h2>Login</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <button type="submit">Login</button>
    </form>

    <p class="msg"><?php echo $msg; ?></p>
</div>

</body>
</html>