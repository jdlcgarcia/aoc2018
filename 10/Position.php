<?php 

include_once 'Pair.php';

class Position extends Pair {
	public function getFormatted() {
		return "<".$this->getFirst().", ".$this->getSecond().">";
	}
}