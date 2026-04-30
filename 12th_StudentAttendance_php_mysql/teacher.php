<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = date("Y-m-d");
    foreach ($_POST['present'] ?? [] as $id) {
        $conn->query("INSERT INTO attendance (student_id, date, status) 
                      VALUES ($id, '$date', 'present')");
    }
    $students = $conn->query("SELECT id FROM students");
    while ($s = $students->fetch_assoc()) {
        if (!in_array($s['id'], $_POST['present'] ?? [])) {
            $conn->query("INSERT INTO attendance (student_id, date, status) 
                          VALUES (" . $s['id'] . ", '$date', 'absent')");
        }
    }
    header("Location: dashboard.php");
    exit();
}

$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
<title>Attendance</title>
<style>
    body { 
        font-family: Arial; 
        background:#f1f5f9; 
        text-align:center; 
    }
    .container { 
        margin:40px auto; 
        width:600px; 
    }
    table {
        width:100%;
        border-collapse:collapse;
        background:white; 
    }
    th, td { 
        padding:10px; 
        border:1px solid #ddd; 
    }
    th { 
        background:#0ea5e9; 
        color:white; 
    }
    button { 
        margin-top:15px; 
        padding:10px; 
        background:#22c55e; 
        border:none; 
        color:white; 
        cursor:pointer; 
    }
</style>
</head>
<body>

<div class="container">
<h2>Mark Attendance</h2>

<form method="POST">
<table>
<tr>
<th>Roll No</th>
<th>Name</th>
<th>Present</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><?php echo $row['roll_no']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><input type="checkbox" name="present[]" value="<?php echo $row['id']; ?>"></td>
</tr>
<?php } ?>

</table>

<button type="submit">Submit Attendance</button>
</form>

</div>

</body>
</html>