<?php include "db.php"; $res=$conn->query("SELECT * FROM students"); ?>

<link rel="stylesheet" href="style.css">

<h2>Students</h2>

<table>
<tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>

<?php while($r=$res->fetch_assoc()){ ?>
<tr>
<td><?= $r['id'] ?></td>
<td><?= $r['name'] ?></td>
<td><?= $r['email'] ?></td>
<td>
<a href="edit.php?id=<?= $r['id'] ?>">Edit</a>
<a href="delete.php?id=<?= $r['id'] ?>">Delete</a>
</td>
</tr>
<?php } ?>
</table>