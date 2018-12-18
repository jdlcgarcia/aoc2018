CFLAGS = -O
CC = g++
SRC = main.cpp Game.cpp Player.cpp Marble.cpp
OBJ = $(SRC:.cpp = .o)

Play: $(OBJ)
	$(CC) $(CFLAGS) -o Play $(OBJ)

clean: 
	rm -r *.o