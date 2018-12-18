<?php

include_once 'Star.php';
include_once 'Sky.php';

$file_lines = file('example.txt');

$sky = new Sky();

foreach ($file_lines as $line) {
    preg_match('/^position=<(\s*-?\d*),(\s*-?\d*)>\s*velocity=<(\s*-?\d*),(\s*-?\d*)/',$line, $patternSolved);
    $sky->addStar(new Star($patternSolved[1], $patternSolved[2], $patternSolved[3], $patternSolved[4]));
}

$sky->snapshot();
for($i=0;$i<4;$i++) {
	$sky->move();
	$sky->snapshot($i);	
}
