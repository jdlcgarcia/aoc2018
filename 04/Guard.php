<?php 

include_once 'Track.php';

class Guard {
	/** @var int id of the Guard */
	private $id;

	/** @var Track[] list of tracking moments of the guard */
	private $trackList = [];

	/** @var int time asleep */
	private $sleepTime = 0;

	private $sleepMatrix = [];

	function __construct($id, $time) {
		$this->id = $id;
		$this->wakeUp($time);
		for($i = 0; $i <= 59; $i++) {
			$this->sleepMatrix[$i] = 0;
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getSleepTime() {
		return $this->sleepTime;
	}

	public function getTrack() {
		return $this->trackList;
	}

	public function goToSleep($time) {
		$this->trackList[] = new Track(false, $time);
	}

	public function wakeUp($time) {
		if (sizeof($this->trackList) > 0) {
			$startedSleeping = end($this->trackList)->getDate();
		}
		$this->trackList[] = new Track(true, $time);
		if (isset($startedSleeping)) {
			$finishedSleeping = end($this->trackList)->getDate();
			$this->sleepTime+=$finishedSleeping->diff($startedSleeping)->format('%i');
			for($i = $startedSleeping->format('i'); $i < $finishedSleeping->format('i'); $i++) {
				$this->sleepMatrix[$i*1]++;
			}
		}
	}

	public function drawSleepMatrix() {
		echo "################ ".$this->getId()." ################\n";
		echo " 0 0 0 0 0 0 0 0 0 0 1 1 1 1 1 1 1 1 1 1 2 2 2 2 2 2 2 2 2 2 3 3 3 3 3 3 3 3 3 3 4 4 4 4 4 4 4 4 4 4 5 5 5 5 5 5 5 5 5 5 \n";
		echo " 0 1 2 3 4 5 6 7 8 9 0 1 2 3 4 5 6 7 8 9 0 1 2 3 4 5 6 7 8 9 0 1 2 3 4 5 6 7 8 9 0 1 2 3 4 5 6 7 8 9 0 1 2 3 4 5 6 7 8 9 \n";
		for($i = 0; $i <= 59; $i++) {
			echo (($this->sleepMatrix[$i]<10)?" ":"").$this->sleepMatrix[$i];
		}
		echo "\n";
	}

	public function getSleepMatrix() {
		return $this->sleepMatrix;
	}
}