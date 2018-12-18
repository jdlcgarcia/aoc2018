<?php

include_once 'Position.php';
include_once 'Velocity.php';
class Star {
	/** @var Position [description] */
	private $position;

	/** @var Velocity [description] */
	private $velocity;

	function __construct(int $a, int $b, int $c, int $d) {
		$this->position = new Position($a, $b);
		$this->velocity = new Velocity($c, $d);
	}

	public function getPosition() {
		return $this->position;
	}

	public function move() {
		$this->position = new Position($this->position->getFirst()+$this->velocity->getFirst(), $this->position->getSecond()+$this->velocity->getSecond());
	}
}