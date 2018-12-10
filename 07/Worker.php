<?php

class Worker {
	/** @var bool busy or free */
	private $free;

	private $workInProgress = "";

	private $timeLeft = 0;

	public function __construct(){
		$this->free = true;
	}

	public function isFree() {
		return $this->free;
	}

	public function assign($step) {
		$this->workInProgress = $step;
		$this->timeLeft = $this->getTimeFromStep($step);
		$this->free = false;
	}

	private function getTimeFromStep($step) {
		return 60+(ord($step)-ord("A")+1);
	}

	public function getWip() {
		return $this->workInProgress;
	}

	public function work() {
		$this->timeLeft--;
	}

	public function checkWip() {
		if ($this->timeLeft == 0) {
			$finished = $this->workInProgress;
			$this->workInProgress = "";
			$this->free = true;
			return $finished;
		}
		return false;
	}
}