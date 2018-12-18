<?php

include_once 'Star.php';

class Sky {
	/** @var Star[] stars in the sky */
	private $stars;
	private $min;
	private $max;

	public function __construct() {
		$this->stars = [];
	}

	public function addStar(Star $star) {
		$this->stars[] = $star;
		if ($star->getPosition()->getFirst() < $this->min) {
			$this->min = $star->getPosition()->getFirst();
		}
		if ($star->getPosition()->getSecond() < $this->min) {
			$this->min = $star->getPosition()->getSecond();
		}
		if ($star->getPosition()->getFirst() > $this->max) {
			$this->max = $star->getPosition()->getFirst();
		}
		if ($star->getPosition()->getSecond() > $this->max) {
			$this->max = $star->getPosition()->getSecond();
		}
	}

	public function snapshot(int $i=0) {
		$img = imagecreatetruecolor(100,100);
		
		foreach($this->stars as $star) {
			$color = imagecolorallocate($img,125,125,125);
			imagesetpixel($img,$star->getPosition()->getFirst()+50,$star->getPosition()->getSecond()+50, $color);
		}
		imagepng($img, "file".str_pad((string)$i, 4, "0", STR_PAD_LEFT).".png");
		imagedestroy($img);
	}

	public function move() {
		foreach($this->stars as $star) {
			$star->move();
		}
	}
}