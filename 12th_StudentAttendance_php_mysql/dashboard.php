<?php
include "db.php";

$date = date("Y-m-d");

$result = $conn->query("
    SELECT s.roll_no, s.name, a.status
    FROM students s
    LEFT JOIN attendance a 
    ON s.id = a.student_id AND a.date = '$date'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Attendance Dashboard</title>
<style>
    body { 
        font-family: Arial; 
        background:#f1f5f9; 
        text-align:center; 
    }
    .container { 
        margin:40px auto; 
        width:700px; 
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
    .present { background:#d1fae5; color:#065f46; }
    .absent { background:#fee2e2; color:#7f1d1d; }
    h2 { margin-bottom:20px; }
</style>
</head>
<body>

<div class="container">
<h2>Today's Attendance</h2>

<table>
<tr>
<th>Roll No</th>
<th>Name</th>
<th>Status</th>
</tr>

<?php while($row = $result->fetch_assoc()) { 

    $status = $row['status'] ?? 'absent';
    $class = ($status == 'present') ? 'present' : 'absent';

?>
<tr class="<?php echo $class; ?>">
<td><?php echo $row['roll_no']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo strtoupper($status); ?></td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>