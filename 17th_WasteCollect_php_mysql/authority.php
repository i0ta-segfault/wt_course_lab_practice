<?php
include "db.php";

if (isset($_GET['done'])) {
    $id = $_GET['done'];
    $conn->query("UPDATE waste_reports SET status='done' WHERE id=$id");
}

$result = $conn->query("SELECT * FROM waste_reports");
?>

<link rel="stylesheet" href="style.css">

<h2>Waste Reports</h2>

<table>
<tr>
<th>ID</th>
<th>Location</th>
<th>Type</th>
<th>Description</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['location']; ?></td>
<td><?php echo $row['waste_type']; ?></td>
<td><?php echo $row['description']; ?></td>

<td class="<?php echo $row['status']; ?>">
<?php echo strtoupper($row['status']); ?>
</td>

<td>
<?php if ($row['status'] == 'pending') { ?>
<a href="?done=<?php echo $row['id']; ?>">Mark Done</a>
<?php } else { echo "-"; } ?>
</td>
</tr>
<?php } ?>

</table>