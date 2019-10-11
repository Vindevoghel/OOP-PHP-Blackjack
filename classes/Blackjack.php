<?php

class Blackjack
{

    CONST MIN = 1;
    CONST MAX = 11;
    CONST BLACKJACK = 21;
    private $score;
    public $name;


    public function __construct($score, $name)
    {
        $this->score = $score;
        $this->name = $name;
    }

    public function Hit()
    {
        $randomCard = rand(self::MIN, self::MAX);
        echo "Card is " . $randomCard . ". ";
        $this->score += $randomCard;

        if ($this->getScore() > self::BLACKJACK) {
            return $this->getScore() . "! Bust! " . $this->name . " loses!";
        } elseif ($this->getScore() === self::BLACKJACK) {
            return "Blackjack. " . $this->name . " wins!";
        } else {
            return "";
        }
    }

    public function Stand($player, $computer)
    {
        while ($computer->getScore() < 15 || $computer->getScore() < $player->getScore()) {
            $computer->Hit();
        }


        if ($computer->getScore() > $player->getScore() && $computer->getScore() < self::BLACKJACK) {
            return $computer->name . "'s " . $computer->getScore() . " beats " . $player->name . "'s " .
                $player->getScore() . ". " . $player->name . " loses!";
        } elseif ($computer->getScore() > self::BLACKJACK) {
            return $computer->name . " is bust. " . $player->name . " wins!";
        } elseif ($computer->getScore() === $player->getScore()) {
            return "Tie! Play again?";
        } elseif ($computer->getScore() === self::BLACKJACK) {
            return $computer->name . " has Blackjack.  " . $player->name . " loses!";
        } else {
            return $player->name . "'s " . $player->getScore() . " beats the " . $computer->name . " 's " .
                $computer->getScore() . ". " . $player->name . " wins!";
        }
    }


    public function Surrender($computer)
    {
        while ($computer->getScore() < 10) {
            $computer->Hit();
        }
        return "You surrender. " . $this->name . " loses!";
    }

    public function Reset($player, $computer)
    {
        $player->setScore(0);
        $computer->setScore(0);
        return "";
    }

    /**
     * @param mixed $score
     */
    public function setScore($score): void
    {
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }


}