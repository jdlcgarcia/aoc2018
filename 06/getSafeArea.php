<?php
include_once('Coordinate.php');
include_once('Diagram.php');

$file_lines = file('input.txt');
$char = "A";
foreach ($file_lines as $line) {
    preg_match('/^(\d*),\s*(\d*)$/',$line, $patternSolved);
    $coordinateList[] = new Coordinate($char, $patternSolved[1], $patternSolved[2]);
    $char++;
}

$diagram = new Diagram($coordinateList);
$diagram->calculateSums();
echo "The safe region has a total size of ".$diagram->getSaferThan(10000)."\n";
//echo "The highest area is ".$diagram->getMostFrequent()."\n";
//$diagram->draw();