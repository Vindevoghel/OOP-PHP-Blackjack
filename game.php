<?php

declare(strict_types=1);
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
session_start();

require 'classes/Blackjack.php';

$player = new Blackjack(0);
$loseMsg = $winMsg = "";

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Blackjack</title>
</head>
<body>
<form method="POST">
    <input type="submit" name="hit" value="hit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $player->Hit();
    echo $player->getScore();
    $_SESSION['player'] += $player->getScore();

    if ($_SESSION['player'] > 21) {
        $loseMsg = $_SESSION['player'] . " is more than 21. You lose!";
        $_SESSION['player'] = 0;
    } else if ($_SESSION['player'] === 21) {
        $winMsg = "Blackjack. You win!";
    }
}
?>


<div id="playerScore"><?php echo $_SESSION['player']; ?></div>
<div id="computerScore"></div>

<?php

function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
// echo '<h2>$player</h2>';
// print_r($player);
}

whatIsHappening(); ?>
</body>
