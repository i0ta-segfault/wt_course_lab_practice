<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll = $_POST['roll'];
    $name = $_POST['name'];

    $conn->query("INSERT INTO students (roll_no, name) VALUES ('$roll', '$name')");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<style>
    body { 
        font-family: Arial; 
        background:#0f172a; 
        color:white; 
        text-align:center; 
    }
    .card { 
        margin-top:100px; 
        padding:20px; 
        background:#1e293b; 
        display:inline-block; 
        border-radius:10px; 
    }
    input, button { 
        padding:10px; 
        margin:10px; 
        border:none; 
        border-radius:5px; 
    }
    button { 
        background:#38bdf8; 
        cursor:pointer; 
    }
</style>
</head>
<body>

<div class="card">
<h2>Student Registration</h2>

<form method="POST">
<input name="roll" placeholder="Roll No" required><br>
<input name="name" placeholder="Name" required><br>
<button type="submit">Register</button>
</form>

</div>

</body>
</html>