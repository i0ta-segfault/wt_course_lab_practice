<?php
$conn = new mysqli("localhost", "root", "", "student_db");

$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Student Records</h2>

<form action="insert.php" method="POST">
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Add</button>
</form>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td>
        <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
        <a href="update.php?id=<?php echo $row['id']; ?>">Update</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>