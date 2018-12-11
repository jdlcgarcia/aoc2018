<?php 

include_once('Node.php');

class Tree {
	/** @var Node [description] */
	private $node;

	public function __construct($arrayData) {
		$this->node = new Node($arrayData);
	} 

	public function sumMetadata() {
		return $this->node->getSum();
	}

	public function getValue() {
		return $this->node->getValue();
	}
}