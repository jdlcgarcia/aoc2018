<?php 

class Track {
	/** @var bool awake or asleep */
	private $state;

	/** @var DateTime date of the change of state */
	private $date;

	function __construct($state, $date) {
		$this->state = $state;
		$this->date = DateTime::createFromFormat('Y-m-d H:i', $date);
	}

	public function getState() {
		return $this->state;
	}

	public function getDate() {
		return $this->date;
	}
}