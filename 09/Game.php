<?php

include_once 'Player.php';
include_once 'Marble.php';

class Game {
	/** @var Player[] [description] */
	private $players;

	/** @var int */
	private $endOfTheGame;

	/** @var Marble[] [description] */
	private $playground = [];

	/** @var Marble */
	private $currentMarble;

	/** @var int */
	private $nextMarbleValue = 0;

	private $maxScore;

	public function __construct($numberOfPlayers, $endOfTheGame){
		for($i = 0; $i < $numberOfPlayers; $i++) {
			$this->players[] = new Player($i+1);
		}
		$this->endOfTheGame = $endOfTheGame;
		$this->playground[] = new Marble($this->nextMarbleValue);
		$this->currentMarble = reset($this->playground);
	}

	public function begin() {
	    $i=0;
		while ($this->nextMarbleValue != $this->endOfTheGame) {
			$player = $this->players[$i%sizeof($this->players)];
			$i++;
		    $this->nextMarbleValue++;
		    if ($this->nextMarbleValue % 23 == 0) {
                $player->addScore($this->nextMarbleValue);
                $index = array_search($this->currentMarble, $this->playground);
                $newIndex = $index - 7;
                if ($newIndex < 0) {
                    $newIndex += sizeof($this->playground);
                }
                $extraMarble = $this->playground[$newIndex];
                $player->addScore($extraMarble->getValue());
                if ($this->maxScore < $player->getScore()) {
                    $this->maxScore = $player->getScore();
                }
                unset($this->playground[$newIndex]);
                $this->playground = array_values($this->playground);
                $this->currentMarble = $this->playground[$newIndex];
            } else {
                $marble = new Marble($this->nextMarbleValue);
                $index = $this->getIndexForNewMarble();
                array_splice($this->playground, $index, 0, [$marble]);
                $this->currentMarble = $marble;
            }
		}
	}

	public function getIndexForNewMarble(){
		$index = array_search($this->currentMarble, $this->playground);
		$index++;
		if ($index > sizeof($this->playground)-1) {
			$index = 0;
		}
		$index++;
		return $index;
	}

	public function snapshot($player = null){
		$row = "[";
		if (is_null($player)) {
			$row .= "-";
		} else {
			$row .= $player->getId();
		}
		$row .= "] ";
        for ($i = 0; $i < sizeof($this->playground); $i++) {
            if (isset($this->playground[$i])) {
                if ($this->playground[$i] == $this->currentMarble) {
                    $row .= "(".$this->playground[$i]->getValue().") ";
                } else {
                    $row .= $this->playground[$i]->getValue()." ";
                }
            }
		}
		echo $row."\n";
	}

    public function getWinnerScore()
    {
        return $this->maxScore;
    }
}