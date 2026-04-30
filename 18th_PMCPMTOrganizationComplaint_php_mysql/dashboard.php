<?php
session_start();
include "db.php";

$uid = $_SESSION['user_id'];

$res = $conn->query("
SELECT * FROM complaints WHERE user_id=$uid
");
?>

<link rel="stylesheet" href="style.css">

<h2>My Complaints</h2>

<table>
<tr>
<th>Org</th>
<th>Category</th>
<th>Message</th>
<th>Status</th>
</tr>

<?php while($r = $res->fetch_assoc()) { ?>
<tr>
<td><?php echo $r['organization']; ?></td>
<td><?php echo $r['category']; ?></td>
<td><?php echo $r['message']; ?></td>
<td class="<?php echo $r['status']; ?>">
<?php echo strtoupper($r['status']); ?>
</td>
</tr>
<?php } ?>

</table>