<?php

include_once 'Claim.php';
include_once 'Padding.php';
include_once 'Size.php';
include_once 'Fabric.php';

$file_lines = file('input.txt');

$claims = [];

foreach ($file_lines as $line) {
    preg_match('/^#(\d*)\s@\s(\d*),(\d*):\s(\d*)x(\d*)$/',$line, $patternSolved);
    $claims[$patternSolved[1]] = new Claim($patternSolved[1], new Padding($patternSolved[2], $patternSolved[3]), new Size($patternSolved[4], $patternSolved[5]));
}

$fabric = new Fabric();
foreach($claims as $claim) {
	$fabric->insertClaim($claim);	
}
echo $fabric->getDiagramPNG();
echo $fabric->countOverlap(false);