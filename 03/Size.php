<?php

include_once('Pair.php');

class Size extends Pair {
	public function getFormatted() {
		return $this->getFirst()."x".$this->getSecond();
	}
}