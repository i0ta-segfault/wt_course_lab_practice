<?php
session_start();
include "db.php";

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['resolve'])) {
    $id = $_GET['resolve'];
    $conn->query("UPDATE complaints SET status='resolved' WHERE id=$id");
}

$res = $conn->query("
SELECT c.*, u.username 
FROM complaints c
JOIN users u ON c.user_id = u.id
");
?>

<link rel="stylesheet" href="style.css">

<h2>All Complaints</h2>

<table>
<tr>
<th>User</th>
<th>Org</th>
<th>Category</th>
<th>Message</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($r = $res->fetch_assoc()) { ?>
<tr>
<td><?php echo $r['username']; ?></td>
<td><?php echo $r['organization']; ?></td>
<td><?php echo $r['category']; ?></td>
<td><?php echo $r['message']; ?></td>

<td class="<?php echo $r['status']; ?>">
<?php echo strtoupper($r['status']); ?>
</td>

<td>
<?php if ($r['status']=="pending") { ?>
<a href="?resolve=<?php echo $r['id']; ?>">Resolve</a>
<?php } else { echo "-"; } ?>
</td>
</tr>
<?php } ?>

</table>

<a href="logout.php">Logout</a>