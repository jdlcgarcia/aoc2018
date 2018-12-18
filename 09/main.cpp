#include <iostream>
#include "Game.h"
using namespace std;

int main() {
	Game game(9, 25);
	//Game game(468, 7101000);
	game.begin();
	//game.getWinner();
	cout << "The winner's score is " << std::to_string(game.getWinnerScore());
}