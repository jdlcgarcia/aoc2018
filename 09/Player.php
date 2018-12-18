<?php 

class Player {
	private $id;
	private $score = 0;

	public function __construct($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function addScore($score){
	    $this->score += $score;
    }

    public function getScore()
    {
        return $this->score;
    }
}