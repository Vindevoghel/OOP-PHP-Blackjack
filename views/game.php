<?php

declare(strict_types=1);
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
require '../classes/Blackjack.php';
session_start();


if (empty($_SESSION)) {
    $_SESSION['player'] = new Blackjack(0, "Player");
    $_SESSION['computer'] = new Blackjack(0, "Dealer");
}

$player = $_SESSION['player'];
$computer = $_SESSION['computer'];
$announcer = "";

if (!empty($_POST["hit"])) {
    $announcer = $player->Hit();
}

if (!empty($_POST["stand"])) {
    $announcer = $player->Stand($player, $computer);
}

if (!empty($_POST["surrender"])) {
    $announcer = $player->Surrender($computer);
}

if (!empty($_POST["reset"])) {
    $announcer = $player ->Reset($player, $computer);
}


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
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
    <input type="submit" name="hit" value="hit">
    <input type="submit" name="stand" value="stand">
    <input type="submit" name="surrender" value="surrender">
    <input type="submit" name="reset" value="reset">
</form>


<h2 id="playerScore"><?php echo $player->getScore(); ?></h2>
<h2 id="computerScore"><?php echo $computer->getScore(); ?></h2>
<h3 id="announcer"><?php echo $announcer; ?></h3>
</body>
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
}

whatIsHappening();
?>
