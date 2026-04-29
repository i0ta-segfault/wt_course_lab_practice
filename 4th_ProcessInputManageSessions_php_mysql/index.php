<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Processing Input and Managing Sessions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>User Input Form</h2>

    <form action="get.php" method="GET">
        <h3>GET Method</h3>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Submit GET</button>
    </form>

    <form action="post.php" method="POST">
        <h3>POST Method</h3>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Submit POST</button>
    </form>

    <a href="login.php">Go to Login</a>
</div>

<div class="message">
    <?php
    if (isset($_GET['msg'])) {
        echo $_GET['msg'];
    }
    ?>
</div>

</body>
</html>