<?php
include "db.php";

$result = $conn->query("SELECT * FROM seats");
?>

<link rel="stylesheet" href="style.css">

<h2>Airplane Seating</h2>

<div class="grid">

<?php while($row = $result->fetch_assoc()) {

    $class = $row['status'] == 'available' ? 'available' : 'booked';

?>

<div class="seat <?php echo $class; ?>"
     onclick="bookSeat(<?php echo $row['id']; ?>, '<?php echo $row['status']; ?>')">

    <?php echo $row['seat_no']; ?>

</div>

<?php } ?>

</div>

<script>
function bookSeat(id, status) {
    if (status === "booked") return;

    if (!confirm("Book this seat?")) return;

    window.location.href = "book.php?id=" + id;
}
</script>