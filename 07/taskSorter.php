<?php
include_once('Step.php');
include_once('Order.php');

$file_lines = file('input.txt');
$stepList = [];
foreach ($file_lines as $line) {
    preg_match('/Step (\w) must be finished before step (\w) can begin/',$line, $patternSolved);
    list($originalLine, $condition, $step) = $patternSolved;
    $stepList[] = new Step($step, $condition);
}

$correctOrder = new Order();
foreach($stepList as $step) {
	$correctOrder->insertStep($step->getId(), $step->getCondition());
}

echo "order of tasks: ".$correctOrder->sort()."\n";
