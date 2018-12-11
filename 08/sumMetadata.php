<?php 
include_once 'Tree.php';

$file_lines = file('input.txt');
$arrayData = explode(" ", $file_lines[0]);
$tree = new Tree($arrayData);
echo "the sum of all metadatas is ".$tree->sumMetadata()."\n";
