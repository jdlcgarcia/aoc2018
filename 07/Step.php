<?php

class Step {
	private $id;

	private $condition = null;

	public function __construct($id, $condition) {
		$this->id = $id;
		$this->condition = $condition;
	}

	public function getId() {
		return $this->id;
	}

	public function setCondition($step) {
		$this->condition = $step;
	}

	public function getCondition() {
		return $this->condition;
	}
}