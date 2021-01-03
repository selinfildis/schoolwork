CC     = g++
CXX    = g++
LEX    = flex
PROG   = lexer

all: $(PROG)

lex.yy.c: $(PROG).l
	$(LEX) -Ca -8 $(PROG).l  

$(PROG): lex.yy.c
	$(CXX) -o $(PROG) lex.yy.c -lfl 

test: input
	cat input | ./$(PROG)

clean:
	-rm -f lex.yy.c
	-rm -f $(PROG)

