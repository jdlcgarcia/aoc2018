# aoc2018
Advent of Code 2018

## Day 1: Chronal Calibration
For today's problem let's just sum the lines with the initial frequency (0). I've done it in PERL.
The second part of the problem handles a sum on multiple iterations of an array. It may be a cleaner way to iterate this, but it's late and I'm tired. It worked on the examples, it worked on the solution.

## Day 2: Inventory Management System
My first approach is counting how many times is repeated every character, and then add it to two hashes (words with repetitions of 2 and words with repetitions of 3). We count the elements and we multiply them.

In a first guess, I'd loop every word (O(n)) and then loop the other words in the list (O(n-1) ~ O(n)) to see which is the minimum distance between boxIDs, that's it, the maximum of repetitions in place. It'd be a O(n²) approach (assuming n as the size of the list. It'd be O(n³) assuming n as the size of the word), let's start with that.

## Day 3: No Matter How You Slice It
It took too much time for me to know what they were asking... you just need to check how many squared inches are occupied for two or more claims! 

1. First, we gotta parse the input. After a few tries in PERL I decided to go PHP on this one. 
1. Let's make it classy ;) lots of classes were created to hold the information. I'm sure they will be useful later, so I made kinda abstract.
1. Once I have the items on my class structure, now they're easier to operate with. So let's insert all the claims in the fabric. I had sooo many mistakes here, but in a nutshell you just need to draw the rectangles (starting from the paddings) and mark the overlapped cells as you draw them. Be careful not to draw an already marked as overlapped.
1. To finish, just count the overlaps! it's a good idea to count them while drawing, so you don't need to recount again.
1. For debugging (I needed A LOT of debugging) I exported the fabric to a `.png` file. The collisions are marked in red.
1. Just to improve the solution, I'd do a helper to parse the input.

The second part was too easy once I'm using the correct data structure. Just check that there's no overlapped cells in the area of the rectangle.

## Day 4: Repose Record

It looks like another parsing/looping problem, so I'll go with PHP with this one too.

1. Again we gotta parse the input. It's a bit messy as we need three RegEx or only an unreadable one.
1. First class we'll make: the guard. We will save the ID, his/her sleep track and the sleep time. We'll also need a class for the states.
1. I'm also saving a Sleep Matrix that keeps an accumulate of the minutes they've been sleeping.

The magic happens when I'm parsing the sleep/awakening of the guards. Once they wake up, I log in the Sleep Matrix the minutes they've been sleeping and adding them to an accumulator of their sleep time. So, when I finish parsing the input I have an array with the frecuencies. I just have to take the biggest sleeper with that accumulator and his top minute asleep with his Sleep Matrix.

For the second part, I just have to loop every Sleep Matrix and get the highest value. Once found, just pull the yarn to know who did it. And eventually fire him.