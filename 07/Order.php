<?php

include_once 'Worker.php';

class Order {
	
	private $steps;

	private $order = "";

	private $availables = [];

	private $done = [];

	const WORKER_SIZE = 5;

	private $workers = [];

	public function __construct(){
		$this->steps = [];
	}

	public function insertStep($step, $condition) {
		$this->steps[$condition][] = $step;
	}

	public function getSteps(){
		return $this->steps;
	}

	public function sortUnit(){
		$this->print();
		$firstAvailable = $this->findFirstAvailable();
		$this->order .= $firstAvailable;
		unset($this->steps[$firstAvailable]);
	}

	public function prepareEmptyConditions(){
		foreach($this->steps as $condition => $nextSteps) {
			foreach ($nextSteps as $step) {
				if (!isset($this->steps[$step])){
					$this->insertStep("", $step);
				}
			}
		}
	}

	public function sort(){
		$this->prepareEmptyConditions();
		ksort($this->steps);

		while(sizeof($this->steps) > 0) {
			$this->sortUnit();
		}
		return $this->order;
	}

	public function sortWithTime(){
		$this->prepareEmptyConditions();
		ksort($this->steps);
		for ($n = 0; $n < self::WORKER_SIZE; $n++) {
			$this->workers[] = new Worker();
		}
		$inProgress = [];
		$i=0;
		while (sizeof($this->steps) > 0) {
			foreach($this->workers as $worker) {
				$finished = $worker->checkWip();
				if ($finished) {
					$this->done[] = $finished;
					unset($this->steps[$finished]);
				}
			}
			$availables = $this->findAvailables();
			$availables = array_diff($availables, $inProgress);
			foreach($availables as $step) {
				$assignedStep = false;
				foreach($this->workers as $worker) {
					if ($worker->isFree() && $assignedStep == false) {
						$worker->assign($step);
						$assignedStep = true;
						$inProgress[] = $step;
					}
				}
			}
			echo $i."\t".$this->printDone()."\n";
			foreach($this->workers as $worker) {
				if (!$worker->isFree()) {
					$worker->work();
				}
			}
			$i++;
		}


	}

	public function print(){
		foreach($this->steps as $step => $nextSteps) {
			echo $step.": ";
			foreach($nextSteps as $nextStep) {
				echo $nextStep.",";
			}
			echo "\n";
		}
		echo "\n";
	}

	public function printDone(){
		$doneString = "";
		foreach($this->done as $done) {
			$doneString.=$done;
		}
		return $doneString;
	}

	public function findFirstAvailable() {
		foreach(array_keys($this->steps) as $availableCandidate) {
			$available = true;
			foreach($this->steps as $conditionStep => $stepList) {
				if (in_array($availableCandidate, $stepList)) {
					$available = false;
				}
			}
			if ($available) {
				return $availableCandidate;
			}
		}
		
	}

	public function findAvailables() {
		$availables = [];
		foreach(array_keys($this->steps) as $availableCandidate) {
			$available = true;
			foreach($this->steps as $conditionStep => $stepList) {
				if (in_array($availableCandidate, $stepList)) {
					$available = false;
				}
			}
			if ($available) {
				$availables[] = $availableCandidate;
			}
		}
		return $availables;
	}
}