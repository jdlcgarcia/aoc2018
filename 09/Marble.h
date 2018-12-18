#ifndef __MARBLE_H_INCLUDED__
#define __MARBLE_H_INCLUDED__ 

class Marble {
	private: 
		long value;

	public: 
		Marble(long x);
		void setValue(long x);
		long getValue();
};

#endif