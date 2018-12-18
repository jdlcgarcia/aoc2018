#include <iostream>
#include <algorithm>
#include "Game.h"

using namespace std;

Game::Game(int people, long lastMarbleValue) {
	for(int i = 1; i <= people; ++i) {
		players.push_back(Player(i));
	}
	endOfTheGame = lastMarbleValue;
	playground.push_back(Marble(0));
	currentMarble = playground.begin();
	auto next = [&] (auto i) {
                if (++i == playground.end())
                  return playground.begin();
                return i;
              };
  auto prev = [&] (auto i) {
                if (i == playground.begin())
                  i = playground.end();
                return --i;
              };
}

long Game::getWinnerScore() { 
	return endOfTheGame; 
}

void Game::begin() {
	cout << "Starting the game\n";
	for (long i = 0; i < endOfTheGame; ++i) {
		insertMarble(Marble(i));
		snapshot();
	}
}


void Game::snapshot() {
	//cout << "[" << playerIterator->getId() << "] ";

	list<Marble>::iterator playgroundIterator = playground.begin();
    for (playgroundIterator = playground.begin(); playgroundIterator != playground.end(); ++playgroundIterator) {
    	if (currentMarble->getValue() == playgroundIterator->getValue()) {
    		cout << "(";
    	}
    	cout << playgroundIterator->getValue();
    	if (currentMarble->getValue() == playgroundIterator->getValue()) {
    		cout << ")";
    	}
    	cout << " ";
	}
	cout << "\n";
}

void Game::insertMarble(Marble newMarble){
	if (newMarble.getValue() % 23 == 0) {
		currentMarble = prev(prev(prev(prev(prev(prev(prev(currentMarble)))))));
		//addscore
		//currentMarble = playground.erase(currentMarble);
	} else {
		currentMarble = next(next(currentMarble));
		currentMarble = playground.insert(currentMarble, newMarble);
	}
}

