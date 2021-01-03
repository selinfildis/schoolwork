CC = gcc
LEX = lex
YACC = yacc
PROG_GRAPH = geez_graph_def
PROG_QUERY = geez_query

all: $(PROG_GRAPH) $(PROG_QUERY)

compile_lex_graph: $(PROG_GRAPH).l
	$(LEX) -l $(PROG_GRAPH).l

compile_yacc_graph: $(PROG_GRAPH).y
	$(YACC) -d $(PROG_GRAPH).y

$(PROG_GRAPH): compile_lex_graph compile_yacc_graph lex.yy.c y.tab.h y.tab.c
	$(CC) -o $(PROG_GRAPH) lex.yy.c y.tab.c



compile_lex_query: $(PROG_QUERY).l
	$(LEX) -l $(PROG_QUERY).l

compile_yacc_query: $(PROG_QUERY).y
	$(YACC) -d $(PROG_QUERY).y

$(PROG_QUERY): compile_lex_query compile_yacc_query lex.yy.c y.tab.h y.tab.c
	$(CC) -o $(PROG_QUERY) lex.yy.c y.tab.c


test_graph: input
	cat input | ./$(PROG_GRAPH)

test_query: input
	cat input | ./$(PROG_QUERY)

clean:
	-rm -f lex.yy.c
	-rm -f $(PROG_GRAPH)
	-rm -f $(PROG_QUERY)
	-rm -f y.tab.h
	-rm -f y.tab.c
