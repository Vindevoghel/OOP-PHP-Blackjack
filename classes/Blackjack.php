<?php

class Blackjack
{

    CONST MIN = 1;
    CONST MAX = 11;
    private $score;


    public function __construct($score, $name) {
        $this->score = $score;
        $this->name = $name;
    }

    public function Hit()
    {
        $randomCard = rand(self::MIN, self::MAX);
        echo "Card is " . $randomCard . ". ";
        $this->score += $randomCard;
    }

    public function Stand()
    {
        return $this->score;
    }

    public function Surrender()
    {
        $this->score = 0;
        return "You surrender. " . $this->name . " loses!";
    }

    /**
     * @param mixed $score
     */
    public function setScore($score): void
    {
        $this->score = $score;
    }


}