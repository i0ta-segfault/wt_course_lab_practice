<?php
session_start();
include "db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$res = $conn->query("
SELECT c.message, c.created_at, u.username
FROM complaints c
JOIN users u ON c.student_id = u.id
");
?>

<link rel="stylesheet" href="style.css">

<h2>All Complaints</h2>

<table>
<tr>
<th>Student</th>
<th>Complaint</th>
<th>Date</th>
</tr>

<?php while($row = $res->fetch_assoc()) { ?>
<tr>
<td><?php echo $row['username']; ?></td>
<td><?php echo $row['message']; ?></td>
<td><?php echo $row['created_at']; ?></td>
</tr>
<?php } ?>

</table>

<br>
<a href="logout.php">Logout</a>