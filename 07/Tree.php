<?php 

include_once('Step.php');

class Tree {
	/** @var Tree List of nodes */
	private $children = [];

	/** @var Step root of the tree */
	private $root = null;

	/** @var string order of tree */
	private $order = "";

	public function __construct($father, $nodeList) {
		$this->root = $father;
		foreach($this->findChildren($father, $nodeList) as $child) {
			$this->children[] = new Tree($child, $nodeList);
		}
	}

	public function getNodeList() {
		return $this->nodeList;
	}

	public function getRoot() {
		return $this->root;
	}

	public function getChildren() {
		return $this->children;
	}

	/*public function startProccess() {
		$this->processNode($this->getRoot());
		return $this->order;
	}*/

	/*private function processNode($node) {
		if ($node->isDoable()) {
			$this->order .= $node->getId();
			$node->finish();
			$children = $this->findChildren($node);
			foreach($children as $child) {
				$this->processNode($child);
			}
		} else {
			echo $node->getId()." can't do shit!\n";
		}
	}*/

	private function findChildren($father, $nodeList){
		$children = [];
		foreach($nodeList as $node) {
			if ($node->getFather() == $father) {
				$children[$node->getId()] = $node;
			}
		}
		return $children;
	}

	public function print() {
		$this->printNode($this);
	}

	public function printNode() {
		echo $this->root->getId();

		foreach ($this->children as $child) {
			$child->printNode();
		}
	}
}