#ifndef __PLAYER_H_INCLUDED__
#define __PLAYER_H_INCLUDED__ 

class Player {
	private: 
		int id;
		long score;

	public: 
		Player(int x);
		int getId();
		void addScore(long newScore);
		long getScore();
};

#endif