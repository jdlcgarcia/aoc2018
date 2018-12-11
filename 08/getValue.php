<?php 
include_once 'Tree.php';

$file_lines = file('input.txt');
$arrayData = explode(" ", $file_lines[0]);
$tree = new Tree($arrayData);
echo "the value of the tree is ".$tree->getValue()."\n";
