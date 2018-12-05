<?php

include_once 'Guard.php';

$file_lines = file('input.txt');
$guards = [];
foreach ($file_lines as $line) {
    preg_match('/^\[(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2})\]\sGuard #(\d*) begins shift/',$line, $patternSolved);
	if (sizeof($patternSolved) > 0) {
		if (isset($guards[$patternSolved[2]])) {
			$guard = $guards[$patternSolved[2]];
		} else {
			$guard = new Guard($patternSolved[2], $patternSolved[1]);
			$guards[$guard->getId()] = $guard;
		} 
	} else {
		preg_match('/^\[(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2})\]\sfalls asleep/',$line, $patternSolved);
		if (sizeof($patternSolved) > 0) {
			$guard->goToSleep($patternSolved[1]);
		} else {
			preg_match('/^\[(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2})\]\swakes up/',$line, $patternSolved);
			if (sizeof($patternSolved) > 0) {
				$guard->wakeUp($patternSolved[1]);
			} else {
				echo "HOLY FUCK ERROR\n";
			}
		}
	}
}

$sleepTimes = [];
foreach($guards as $guard) {
	$sleepTimes[$guard->getId()] = $guard->getSleepTime();
	$frequentMinutes[$guard->getId()] = max($guard->getSleepMatrix());
} 
$biggestSleeper = $guards[array_search(max($sleepTimes), $sleepTimes)];
$goldenMinute = array_search(max($biggestSleeper->getSleepMatrix()), $biggestSleeper->getSleepMatrix());
echo "biggestSleeper: id X minute = ".$biggestSleeper->getId()*$goldenMinute."\n";

$maximumFrequency = max($frequentMinutes);
$mostFrequentAsleepGuard = array_search($maximumFrequency, $frequentMinutes);
$mostFrequentAsleepMinute = array_search($maximumFrequency, $guards[$mostFrequentAsleepGuard]->getSleepMatrix());

var_dump($mostFrequentAsleepMinute);
echo "botSleeper: id X minute = ".$mostFrequentAsleepGuard*$mostFrequentAsleepMinute;