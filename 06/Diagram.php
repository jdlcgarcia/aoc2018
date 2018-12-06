<?php

include_once('Coordinate.php');

class Diagram {
	/** Coordinate[] array of coordinates to draw */
	private $coordinateList;
	
	private $diagram;
	
	private $maxDimension = 0;
	
	private $distanceToAll;
	
	function __construct($coordinateList) {
		$this->coordinateList = $coordinateList;
		//locate the coordinates
		foreach($this->coordinateList as $coordinate) {
			$this->diagram[$coordinate->getFirst()][$coordinate->getSecond()] = $coordinate->getId();
			if ($this->maxDimension < $coordinate->getFirst()) {
				$this->maxDimension = $coordinate->getFirst();
			}
			if ($this->maxDimension < $coordinate->getSecond()) {
				$this->maxDimension = $coordinate->getSecond();
			}
		}
	}
	
	function calculateNearest() {
		for ($i = 0; $i <= $this->maxDimension; $i++) {
			for ($j = 0; $j <= $this->maxDimension; $j++) {
				if (!isset($this->diagram[$i][$j])) { 
					$pointX = new Coordinate("X", $i, $j);
					$minDistance = $this->maxDimension*$this->maxDimension;
					$closest = "x";
					foreach($this->coordinateList as $coordinate) {
						if ($minDistance > $pointX->distance($coordinate)) {
							$minDistance = $pointX->distance($coordinate);
							$closest = strtolower($coordinate->getId());
						} elseif ($minDistance == $pointX->distance($coordinate)) {
							$minDistance = $pointX->distance($coordinate);
							$closest = "·";
						}
					}
					$this->diagram[$i][$j] = $closest;
				}
			}
		}
	}
	
	public function calculateSums() {
		for ($i = 0; $i <= $this->maxDimension; $i++) {
			for ($j = 0; $j <= $this->maxDimension; $j++) {
				$pointX = new Coordinate("X", $i, $j);
				$sumOfDistances = 0;
				foreach($this->coordinateList as $coordinate) {
					$sumOfDistances += $pointX->distance($coordinate);
				}
				$this->distanceToAll[$i][$j] = $sumOfDistances;
			}
		}
	}
	
	public function getSaferThan($safePoint) {
		$safeArea = 0;
		for ($i = 0; $i <= $this->maxDimension; $i++) {
			for ($j = 0; $j <= $this->maxDimension; $j++) {
				if ($this->distanceToAll[$i][$j] < $safePoint) {
					$safeArea++;
				}
			}
		}
		return $safeArea;
	}
	
	function draw() {
		for ($i = 0; $i <= $this->maxDimension; $i++) {
			for ($j = 0; $j <= $this->maxDimension; $j++) {
				if (isset($this->diagram[$j][$i])) {
					echo $this->diagram[$j][$i];
				} else {
					echo "·";
				}
			}
			echo "\n";
		}
		echo "\n";
	}
	
	function getMostFrequent() {
		$frequency = [];
		for ($i = 0; $i <= $this->maxDimension; $i++) {
			for ($j = 0; $j <= $this->maxDimension; $j++) {
				if (isset($this->diagram[$i][$j])) {
					if (isset($frequency[$this->diagram[$i][$j]])) {
						$frequency[$this->diagram[$i][$j]]++;
					}
					else {
						$frequency[$this->diagram[$i][$j]] = 1;
					}
				}
			}
		}
		//remove infinites
		for ($i = 0; $i <= $this->maxDimension; $i++) {
			if (isset($frequency[$this->diagram[$i][0]])) {
				unset($frequency[$this->diagram[$i][0]]);
			} 
			if (isset($frequency[$this->diagram[0][$i]])) {
				unset($frequency[$this->diagram[0][$i]]);
			} 
			if (isset($frequency[$this->diagram[$this->maxDimension][0]])) {
				unset($frequency[$this->diagram[$this->maxDimension][0]]);
			} 
			if (isset($frequency[$this->diagram[0][$this->maxDimension]])) {
				unset($frequency[$this->diagram[0][$this->maxDimension]]);
			} 
		}
		return max($frequency)+1;
	}
}