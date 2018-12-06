<?php

include_once('Pair.php');

class Coordinate extends Pair {
	private $id;
	
	public function __construct($id, $a, $b) {
		parent::__construct($a, $b);
		$this->id = $id;
	}
	
	public function getId() {
		return $this->id;
	}

	public function getFormatted() {
		return $this->id." (".$this->getFirst().", ".$this->getSecond().")";
	}
	
	public function distance(Coordinate $coordinate)
	{
		return abs($this->getFirst() - $coordinate->getFirst()) + 
            abs($this->getSecond() - $coordinate->getSecond());
    }
}