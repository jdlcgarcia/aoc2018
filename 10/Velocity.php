<?php 

include_once 'Pair.php';

class Velocity extends Pair {
	public function getFormatted() {
		return "<".$this->getFirst().", ".$this->getSecond().">";
	}
}