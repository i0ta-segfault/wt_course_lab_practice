<?php
include "db.php";
$id=$_GET['id'];

if($_SERVER["REQUEST_METHOD"]=="POST"){
 $name=$_POST['name'];
 $email=$_POST['email'];
 $conn->query("UPDATE students SET name='$name',email='$email' WHERE id=$id");
 header("Location:index.php");
}

$r=$conn->query("SELECT * FROM students WHERE id=$id")->fetch_assoc();
?>

<form method="POST">
<input name="name" value="<?= $r['name'] ?>">
<input name="email" value="<?= $r['email'] ?>">
<button>Update</button>
</form>