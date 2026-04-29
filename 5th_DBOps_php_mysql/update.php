<?php
$conn = new mysqli("localhost", "root", "", "student_db");

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $conn->query("UPDATE students SET name='$name', email='$email' WHERE id=$id");
    header("Location: index.php");
}

$result = $conn->query("SELECT * FROM students WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update</title>
</head>
<body>

<form method="POST">
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
    <button type="submit">Update</button>
</form>

</body>
</html>