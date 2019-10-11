<?php

declare(strict_types=1);
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);
require '../classes/Blackjack.php';
session_start();

$loseMsg = $winMsg = "";

if (empty($_SESSION)) {
    $_SESSION['player'] = new Blackjack(0, "Player");
    $_SESSION['computer'] = new Blackjack(0, "Dealer");
}

$player = $_SESSION['player'];
$computer = $_SESSION['computer'];

if (!empty($_POST["hit"])) {
    $player->Hit();
}

if (!empty($_POST["stand"])) {
    while ($computer->Stand() < 15 || $computer->Stand() < $player->Stand()) {
        $computer->Hit();
        }
        if ($computer->Stand() > $player->Stand() && $computer->Stand() < 21) {
            $loseMsg = $computer->name . "'s " . $computer->Stand() . " beats " . $player->name . "'s" . $player->Stand()
                . ". " . $player->name . " loses!";
        } elseif ($computer->Stand() > 21) {
            $winMsg = $computer->name . " is bust. " . $player->name . " wins!";
        } elseif ($computer->Stand() === $player->Stand()) {
            $winMsg = "Tie! Play again?";
        } elseif ($computer->Stand() === 21) {
            $loseMsg = $computer->name . " has 21. " . $player->name . " loses!";
        } else {
            $winMsg = $player->name . "'s " . $player->Stand() . " beats the " . $computer->name . " 's" . $computer->Stand() . ". " . $player->name . " wins!";
        }
}

if (!empty($_POST["surrender"])) {
    while ($computer->Stand() < 10) {
        $computer->Hit();
    }
    $loseMsg = $player->Surrender();
}

if (!empty($_POST["reset"])) {
    $loseMsg = $winMsg = "";
    $player->setScore(0);
    $computer->setScore(0);
}
if (!empty($_POST)) {
    if ($player->Stand() > 21) {
        $winMsg = "";
        $loseMsg = $player->Stand() . "! Bust! " . $player->name . " loses!";
    } else if ($player->Stand() === 21) {
        $winMsg = "Blackjack. " . $player->name . " wins!";
        $loseMsg = "";
    }
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


<h2 id="playerScore"><?php echo $player->Stand(); ?></h2>
<h2 id="computerScore"><?php echo $computer->Stand(); ?></h2>
<h3 id="announcer"><?php echo $winMsg; ?><?php echo $loseMsg; ?></h3>
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
