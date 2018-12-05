<?php

include_once('Pair.php');

class Padding extends Pair {
	public function getFormatted() {
		return $this->getFirst().",".$this->getSecond();
	}
}