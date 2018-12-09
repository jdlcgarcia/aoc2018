<?php

class Order {
	
	private $steps;

	private $order = "";

	private $availables = [];

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
}