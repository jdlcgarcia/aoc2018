#!/usr/bin/perl
use warnings;

my $inputFile = 'input.txt';
open(my $inputHandler, '<:encoding(UTF-8)', $inputFile)
or die "Could not open file '$inputFile' $!";

my $frequency = 0;
while (my $row = <$inputHandler>) {
	chomp $row;
	$frequency+=$row;
}
print $frequency;