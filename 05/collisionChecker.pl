#!/usr/bin/perl
use warnings;

my $inputFile = 'input.txt';
open(my $inputHandler, '<', $inputFile)
or die "Could not open file '$inputFile' $!";

chomp(my @linesOfFile = <$inputHandler>);
close $inputHandler;
my @charArray = split('', $linesOfFile[0]);
print "size of polymer: ".scalar(@charArray)."\n";
$index = 0;
$exit = "false";
while ($exit eq "false") {
	$thisChar = $charArray[$index];
	if ($index < scalar(@charArray)-1) {
		$nextChar = $charArray[$index+1];
		if (uc($thisChar) eq uc($nextChar) && $thisChar ne $nextChar) {
			splice(@charArray, $index, 2); 
			$index = -1;
		}
	} else {
		$exit = "true";
	}
	$index++;
}
print "size of polymer: ".scalar(@charArray)."\n";