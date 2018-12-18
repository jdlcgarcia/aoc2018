#include "Marble.h"

Marble::Marble(long x = 0) {
	value = x;
}

void Marble::setValue(long x) {
	value = x;
}

long Marble::getValue() {
	return value;
}