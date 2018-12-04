#!/usr/bin/perl
use warnings;

my $inputFile = 'input.txt';
open(my $inputHandler, '<', $inputFile)
or die "Could not open file '$inputFile' $!";

my $repeatedChars = ''; #when no repetitions are found
chomp(my @linesOfFile = <$inputHandler>);
close $inputHandler;

foreach my $i (0 .. $#linesOfFile) {
    my @referenceID = split("", $linesOfFile[$i]);
    foreach my $j ($i+1 .. $#linesOfFile) {
    	my @comparedID = split("", $linesOfFile[$j]);
    	my $repeatedCharsOnTwoWords = '';
    	foreach my $k (0 .. $#referenceID) {
		  if ($referenceID[$k] eq $comparedID[$k]) {
		  	$repeatedCharsOnTwoWords.=$referenceID[$k];
		  }
		}
		if (length($repeatedCharsOnTwoWords) > length($repeatedChars)) {
			$repeatedChars = $repeatedCharsOnTwoWords;
		}
	}
}
print "$repeatedChars\n";