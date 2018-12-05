<?php 

abstract class Pair {
	/** @var int first number */
	private $first;

	/** @var int second number */
	private $second;

	function __construct($first, $second) {
		$this->first = $first;
		$this->second = $second;
	}

	public function getFirst() {
		return $this->first;
	}

	public function getSecond() {
		return $this->second;
	}

	abstract public function getFormatted();
}