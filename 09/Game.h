#ifndef __GAME_H_INCLUDED__
#define __GAME_H_INCLUDED__ 

#include "Marble.h"
#include "Player.h"
#include <list>

class Game {
	private: 
		std::list<Player> players;
		long endOfTheGame;
		std::list<Marble> playground;
		std::list<Marble>::iterator currentMarble;
		long nextMarbleValue = 0;
		long maxScore;
		void snapshot();
		void insertMarble(Marble newMarble);
		std::list<Marble>::iterator newPosition();
		std::list<Marble>::iterator nextPosition();
		std::list<Marble>::iterator prevPosition();

	public: 
		Game(int people, long lastMarbleValue);
		long getWinnerScore();
		void begin();
};

#endif