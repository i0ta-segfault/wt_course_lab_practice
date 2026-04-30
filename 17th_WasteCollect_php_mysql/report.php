<?php
include "db.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $location = $_POST['location'];
    $type = $_POST['type'];
    $desc = $_POST['description'];

    $conn->query("
        INSERT INTO waste_reports (location, waste_type, description)
        VALUES ('$location', '$type', '$desc')
    ");

    $msg = "Report submitted";
}
?>

<link rel="stylesheet" href="style.css">

<div class="card">
<h2>Report Waste</h2>

<form method="POST">
<input name="location" placeholder="Enter location">
<select name="type">
<option>Plastic</option>
<option>Paper</option>
<option>Metal</option>
<option>Other</option>
</select>
<textarea name="description" placeholder="Details"></textarea>
<button>Submit</button>
</form>

<p><?php echo $msg; ?></p>
</div>