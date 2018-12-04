#!/usr/bin/perl
use warnings;

my $inputFile = 'input.txt';
open(my $inputHandler, '<', $inputFile)
or die "Could not open file '$inputFile' $!";
my %repeat2 = ();
my %repeat3 = ();
my $counter2 = 0;
my $counter3 = 0;
while (my $row = <$inputHandler>) {
	chomp $row;
	my %repeatedchars = ();
	foreach $char (split('', $row)) {
	  $repeatedchars{$char}+=1;
	}
	while(my($k, $v) = each %repeatedchars) {
		if ($v == 2) {
			if (!$repeat2{$row}) {
				$repeat2{$row} = 1;
				$counter2++;
			}
		}
		if ($v == 3) {
			if (!$repeat3{$row}) {
				$repeat3{$row} = 1;
				$counter3++;
			}
		}
	}
}
print scalar(keys(%repeat2))." x ".scalar(keys(%repeat3))." = ".(scalar(keys(%repeat2))*scalar(keys(%repeat3)))."\n";