<?php 

include_once 'Game.php';

$game = new Game(468, 7101000);

$game->begin();
$game->getWinner();
echo "The winner's score is ".$game->getWinnerScore()."\n";