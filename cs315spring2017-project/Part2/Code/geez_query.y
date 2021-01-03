%glr-parser
%{
#include <stdio.h>
#include <stdlib.h>
#define YYDEBUG 1
int yylex(void);
void yyerror(char* s);
extern int yylineno;
%}
%define parse.error verbose
%token COLON
%token EXEC
%token FILTER
%token LENGTHM
%token PREDICATE
%token QUERY
%token RANDEDGE
%token RANDVERTEX
%token LESSTHANM 
%token MORETHANM
%token FUNCTION IFSTATEMENT ELSESTATEMENT END FOR WHILE RETURN
%token COMMENT
%token INT FLOAT STRING
%token SEMICOLON COMMA DOT
%token SLBRACKET SRBRACKET
%token NOT
%token ASSIGNMENT
%token CONNECT
%token DOLAR
%token HASH
%token LENGHT
%token INCLUDEPROPERTY
%token MAIN
%token PROPERTY
%token VARIABLE
%token VERTEX
%token BOOLEAN
%token CHARATM
%token EQUALSM
%token DIRECTED
%token UNDIRECTED
%token EDGE
%token LPARAN
%token RPARAN
%token LBRACKET
%token RBRACKET
%token INTEGER
%token CONCATENATION
%token ALTERNATION
%left REPETITION
%token SPACE
%token NEWLINE
%left AND OR LESS GREATER LESSEQUAL GREATEREQUAL
%nonassoc ISEQUAL NOTEQUAL
%right EQUAL 
%left PLUS MINUS
%left MULTIPLICATION DIVISION

%%


entry:
    MAIN LPARAN RPARAN LBRACKET functionbody RBRACKET     
;

functionbody:    
    stmt functionbody
    |stmt
    ;

stmt:
    predicate_declaration end
    |filter_declaration end
    |query_declaration end
    |assignment end
    |exec_function end
    |conditional
    |loop
    |COMMENT
    ;

exec_function:
    EXEC LPARAN VARIABLE COMMA VARIABLE RPARAN
    ;


query_declaration:
    QUERY VARIABLE ASSIGNMENT tail
    ;       

filter_declaration:
    FILTER VARIABLE ASSIGNMENT tail
    ;

predicate_declaration:
    PREDICATE VARIABLE ASSIGNMENT DOLAR method
    |PREDICATE VARIABLE ASSIGNMENT HASH method
    ;
        
tail:
    tail ALTERNATION tail_stmt 
    |tail_stmt
    ;

tail_stmt:
    tail_stmt CONCATENATION tail_factor
    |tail_factor
    ;


tail_factor:
    tail_factor REPETITION
    |tail_expr
    ;


tail_expr:
    LPARAN tail RPARAN
    |VARIABLE
    |RANDVERTEX
    |RANDEDGE
    ;



method:
    EQUALSM LPARAN STRING COMMA element RPARAN
    |LESSTHANM LPARAN STRING COMMA INTEGER RPARAN
    |LESSTHANM LPARAN STRING COMMA FLOAT RPARAN
    |MORETHANM LPARAN STRING COMMA INTEGER RPARAN    
    |MORETHANM LPARAN STRING COMMA FLOAT RPARAN
    |CHARATM LPARAN STRING COMMA INTEGER COMMA STRING RPARAN 
    |LENGTHM LPARAN STRING COMMA INTEGER RPARAN
    |EQUALSM LPARAN STRING COMMA VARIABLE RPARAN
    |LESSTHANM LPARAN STRING COMMA VARIABLE RPARAN
    |MORETHANM LPARAN STRING COMMA VARIABLE RPARAN    
    ;

assignment:
    |VARIABLE ASSIGNMENT element    
    ;

conditional:
    if_cond | ifelse_cond
    ;

if_cond:
    IFSTATEMENT LPARAN cond RPARAN LBRACKET functionbody RBRACKET
    ;


ifelse_cond:
    IFSTATEMENT LPARAN cond RPARAN LBRACKET functionbody RBRACKET ELSESTATEMENT LBRACKET functionbody RBRACKET
    ;

cond:
    |BOOLEAN
    |VARIABLE booleanopr element
    |element booleanopr VARIABLE
    |VARIABLE booleanopr VARIABLE
    ;    



booleanopr:
    ISEQUAL
    |GREATER
    |LESS
    |GREATEREQUAL
    |LESSEQUAL
    |NOTEQUAL
    ;

loop:
    for
    |while
    ;

for:    
    FOR LPARAN assignment SEMICOLON cond SEMICOLON assignment RPARAN LBRACKET functionbody RBRACKET
    ;


while:
    WHILE LPARAN cond RPARAN LBRACKET functionbody RBRACKET
    ;

element:
    INTEGER|FLOAT|STRING|map|set|list
    ;


map:
    LBRACKET mapbody RBRACKET
    ;

set:
    SLBRACKET setbody SRBRACKET
    ;
list:
    LBRACKET listbody RBRACKET
    ;

mapbody:
    mapbody COMMA map_tail
    |map_tail
    |
    ;
listbody:
    element COMMA listbody
    |element
    ;
map_tail:
    STRING COLON element
    ;

setbody:
    element COMMA setbody
    |element
    ;

end:
    SEMICOLON                     
    ;    








%%
void yyerror(char *s) {
	fprintf(stdout, "%d-%s\n", yylineno,s);
}

int main(void){
 yyparse();
if(yynerrs < 1){
		printf("Parsing is successful\n");
	}
 return 0;
}
