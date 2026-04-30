<?php
session_start();

// init board
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = array_fill(0, 9, "");
    $_SESSION['player'] = "X";
}

if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// play move
if (isset($_POST['cell'])) {
    $i = $_POST['cell'];

    if ($_SESSION['board'][$i] == "") {
        $_SESSION['board'][$i] = $_SESSION['player'];
        $_SESSION['player'] = ($_SESSION['player'] == "X") ? "O" : "X";
    }
}

function checkWinner($b) {
    $wins = [
        [0,1,2],[3,4,5],[6,7,8],
        [0,3,6],[1,4,7],[2,5,8],
        [0,4,8],[2,4,6]
    ];

    foreach ($wins as $w) {
        if ($b[$w[0]] != "" &&
            $b[$w[0]] == $b[$w[1]] &&
            $b[$w[1]] == $b[$w[2]]) {
            return $b[$w[0]];
        }
    }

    return "";
}

$winner = checkWinner($_SESSION['board']);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Tic Tac Toe</title>
</head>
<body>

<h2>Tic Tac Toe</h2>

<form method="POST">
<div class="grid">

<?php
for ($i = 0; $i < 9; $i++) {
    $val = $_SESSION['board'][$i];
    echo "<button name='cell' value='$i' class='cell'>$val</button>";
}
?>

</div>
</form>

<?php if ($winner != "") { ?>
<h3>Winner: <?php echo $winner; ?></h3>
<?php } ?>

<form method="POST">
<button name="reset">Reset</button>
</form>

</body>
</html>