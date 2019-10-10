<?php
declare(strict_types=1);

class Blackjack
{
    public $score;
    CONST MIN = 1;
    CONST MAX = 11;


    public function __construct($score) {
        $this->score = $score;
    }

    public function Hit()
    {
        $this->score = rand(self::MIN, self::MAX);
    }

    public function Stand()
    {
        $this->score = $_SESSION['player'];
    }

    public function Surrender()
    {
        //return "You surrender. Dealer wins!";
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }
}