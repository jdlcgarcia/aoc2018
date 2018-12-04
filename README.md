# aoc2018
Advent of Code 2018

## Day 1: Chronal Calibration
For today's problem let's just sum the lines with the initial frequency (0). I've done it in PERL.
The second part of the problem handles a sum on multiple iterations of an array. It may be a cleaner way to iterate this, but it's late and I'm tired. It worked on the examples, it worked on the solution.

## Day 2: Inventory Management System
My first approach is counting how many times is repeated every character, and then add it to two hashes (words with repetitions of 2 and words with repetitions of 3). We count the elements and we multiply them.

In a first guess, I'd loop every word (O(n)) and then loop the other words in the list (O(n-1) ~ O(n)) to see which is the minimum distance between boxIDs, that's it, the maximum of repetitions in place. It'd be a O(n²) approach (assuming n as the size of the list. It'd be O(n³) assuming n as the size of the word), let's start with that.