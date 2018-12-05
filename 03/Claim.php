<?php 

include_once('Padding.php');
include_once('Size.php');

class Claim {
	/** @var int identifier */
	private $id;

	/** @var Padding place where the rectangle starts */
	private $padding;

	/** @var Size size of the rectangle */
	private $size;

	function __construct($id, $padding, $size) {
		$this->id = $id;
		$this->padding = $padding;
		$this->size = $size;
	}

	public function getId() {
		return $this->id;
	}

	public function lineFormat() {
		return "#".$this->id." @ ".$this->padding->getFormatted().": ".$this->size->getFormatted();
	}

	public function getWidth() {
		return $this->size->getFirst();
	}

	public function getLength() {
		return $this->size->getSecond();
	}

	public function getLeftPadding() {
		return $this->padding->getFirst();
	}

	public function getRightPadding() {
		return $this->padding->getFirst();
	}

	public function getTopPadding() {
		return $this->padding->getSecond();
	}

	public function getBottomPadding() {
		return $this->padding->getSecond();
	}
}