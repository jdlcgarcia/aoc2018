<?php 

include_once('Pair.php');

class Header extends Pair {
	public function getFormatted() {
		return [$this->getFirst(), $this->getSecond()];
	}
}