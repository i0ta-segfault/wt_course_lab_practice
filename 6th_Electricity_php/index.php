<?php
$bill = "";
$units = "";
$breakdown = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $units = (int)$_POST['units'];
    $remaining = $units;
    $bill = 0;

    if ($remaining > 0) {
        $u = min($remaining, 50);
        $cost = $u * 3.5;
        $bill += $cost;
        $breakdown[] = "$u × 3.50 = Rs" . number_format($cost, 2);
        $remaining -= $u;
    }

    if ($remaining > 0) {
        $u = min($remaining, 100);
        $cost = $u * 4.0;
        $bill += $cost;
        $breakdown[] = "$u × 4.00 = Rs" . number_format($cost, 2);
        $remaining -= $u;
    }

    if ($remaining > 0) {
        $u = min($remaining, 100);
        $cost = $u * 5.2;
        $bill += $cost;
        $breakdown[] = "$u × 5.20 = Rs" . number_format($cost, 2);
        $remaining -= $u;
    }

    if ($remaining > 0) {
        $cost = $remaining * 6.5;
        $bill += $cost;
        $breakdown[] = "$remaining × 6.50 = Rs" . number_format($cost, 2);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Electricity Bill Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Electricity Bill Calculator</h2>

    <form method="POST">
        <input type="number" name="units" placeholder="Enter Units" required value="<?php echo $units; ?>">
        <button type="submit">Calculate</button>
    </form>

    <table class="slab-table">
        <tr><th>Units</th><th>Rate (Rs/unit)</th></tr>
        <tr><td>0 - 50</td><td>3.50</td></tr>
        <tr><td>51 - 150</td><td>4.00</td></tr>
        <tr><td>151 - 250</td><td>5.20</td></tr>
        <tr><td>251+</td><td>6.50</td></tr>
    </table>

    <?php if ($bill !== "") { ?>
        <div class="result">
            <h3>Total Units: <?php echo $units; ?></h3>

            <div class="breakdown">
                <?php foreach ($breakdown as $line) { ?>
                    <p><?php echo $line; ?></p>
                <?php } ?>
            </div>

            <h3>Total Bill: ₹<?php echo number_format($bill, 2); ?></h3>
        </div>
    <?php } ?>

</div>

</body>
</html>