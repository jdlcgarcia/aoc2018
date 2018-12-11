<?php 

include_once 'Header.php';

class Node {
	/** @var Header [description] */
	private $header;

	/** @var Node[] [description] */
	private $nodeList;

	/** @var int[] [description] */
	private $metadata;

	private $sumOfMetadatas = 0;

	public function __construct(&$arrayData) {
		//echo "arrayData is ".implode(",", $arrayData)."\n";
		$this->header = new Header(array_shift($arrayData), array_shift($arrayData));
		for ($i = 0; $i < $this->header->getFirst(); $i++) {
			$this->nodeList[] = new Node($arrayData);
		}
		for ($i = 0; $i < $this->header->getSecond(); $i++) {
			$value = array_shift($arrayData);
			$this->metadata[] = $value;
			$this->sumOfMetadatas+=$value;
		}
	}

	public function getSum() {
		$value = $this->sumOfMetadatas;
		if (!is_null($this->nodeList)) {
			foreach($this->nodeList as $node) {
				$value+=$node->getSum();
			}	
		}
		return $value;
	}
}