<?php

include_once 'Claim.php';

class Fabric {
	const SIZE = 1000;
	const CHAR_EMPTY = "0";
	const CHAR_FULL = "#";
	const CHAR_PADDING = ".";
	const CHAR_OVERLAP = "X";

	private $matrix;
	private $overlap = 0; 

	function __construct() {
		$this->matrix = [];
		$this->fillMatrix(self::CHAR_EMPTY);
	}

	private function fillMatrix($char) {
		for ($i = 0; $i < self::SIZE; $i++) {
			for ($j = 0; $j < self::SIZE; $j++) {
				$this->matrix[$i][$j] = $char;
			}
		}
	}

	public function getDiagramPNG($empty = false) {
		$img = imagecreatetruecolor(self::SIZE, self::SIZE);
		foreach($this->matrix as $i => $value) {
			foreach ($value as $j => $char) {	
				switch ($char) {
					case self::CHAR_FULL: 
						$color = imagecolorallocate($img,0,0,0);
						break;
					case self::CHAR_OVERLAP: 
						$color = imagecolorallocate($img,255,0,0);
						break;
					default: 
						$color = imagecolorallocate($img,125,125,125);				
				}
				imagesetpixel($img,$i,$j,$color);
			}
		}
		imagepng($img, "file.png");
		imagedestroy($img);
	}

	public function insertClaim(Claim $claim) {
		for ($i = $claim->getTopPadding(); $i < $claim->getTopPadding()+$claim->getLength(); $i++) {
			for ($j = $claim->getLeftPadding(); $j < $claim->getLeftPadding()+$claim->getWidth(); $j++) {
				if ($this->matrix[$i][$j] == self::CHAR_FULL) {
					$this->matrix[$i][$j] = self::CHAR_OVERLAP;
					$this->overlap++;
				} elseif ($this->matrix[$i][$j] == self::CHAR_OVERLAP) {
					$this->matrix[$i][$j] = self::CHAR_OVERLAP;
				} else {
					$this->matrix[$i][$j] = self::CHAR_FULL;
				}
			}
		}	
	}

	public function countOverlap($recount = true) {
		if ($recount) {
			foreach($this->matrix as $i => $value) {
				foreach ($value as $j => $char) {
					if($char == self::CHAR_OVERLAP) {
						$this->overlap++;
					}	
				}
			}
		}
		return $this->overlap;
	}
}