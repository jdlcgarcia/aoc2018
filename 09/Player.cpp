#include "Player.h"

Player::Player(int x) {
	id = x;
}

int Player::getId(){
	return id;
}

void Player::addScore(long newScore) {
	score+=newScore;
}

long Player::getScore(){
	return score;
}