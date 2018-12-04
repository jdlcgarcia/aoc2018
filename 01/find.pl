#!/usr/bin/perl
use warnings;

my $inputFile = 'input.txt';
open(my $inputHandler, '<:encoding(UTF-8)', $inputFile)
or die "Could not open file '$inputFile' $!";

chomp(my @linesOfFile = <$inputHandler>);
close $inputHandler;

my @linesOfIteration = @linesOfFile;
my $frequency = 0;
my %repeats = (0,0);

while (my $row = shift @linesOfIteration) {
	$frequency+=$row;
	if (length $repeats{$frequency}) {
 		print "$repeats{$frequency}\n";
 		last;
 	} else {
 		$repeats{$frequency} = $frequency;
 	}
	if (!@linesOfIteration) {
		@linesOfIteration = @linesOfFile
	}
}