#!/usr/bin/perl
use warnings;

my $inputFile = 'input.txt';
open(my $inputHandler, '<', $inputFile)
or die "Could not open file '$inputFile' $!";

chomp(my @linesOfFile = <$inputHandler>);
close $inputHandler;
my @charArray = split('', $linesOfFile[0]);
print "size of polymer: ".scalar(@charArray)."\n";
my %unitTypes; 
foreach(@charArray) {
	$unitTypes{uc($_)} = 1;
}
foreach my $key (keys(%unitTypes)) {
	my $cleanPolymer = clean($key, $linesOfFile[0]);
	my @charArray = split('', $cleanPolymer);
	print "size of polymer: ".detectCollision(\@charArray)."\n";	
}

sub clean {
	my $unitToClean = $_[0];
	my $polymer = $_[1];
	my $regex = lc($unitToClean)."|".$unitToClean;
	$polymer =~ s/$regex//g;
	return $polymer;
}

sub detectCollision {
	my @charArray = @{$_[0]};
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
	return scalar(@charArray)
}
