%glr-parser
%{
#include <stdio.h>
#include <stdlib.h>
int yylex(void);
void yyerror(char* s);
extern int yylineno;
%}
%define parse.error verbose
%token COLON
%token FUNCTION IFSTATEMENT ELSESTATEMENT END FOR WHILE RETURN
%token COMMENT
%token INT FLOAT STRING
%token SEMICOLON COMMA DOT
%token SLBRACKET SRBRACKET
%token NOT
%token ASSIGNMENT
%token CONNECT
%token LENGHT
%token INCLUDEPROPERTY
%token MAIN
%token PROPERTY
%token VARIABLE
%token VERTEX
%token BOOLEAN
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
%token REPETITION
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
    graph_definition 
    ;
    
graph_definition: 
    DIRECTED VARIABLE LBRACKET component_list RBRACKET
|UNDIRECTED VARIABLE LBRACKET component_list RBRACKET 
    ;

component_list:
    component component_list
    |component  
    ;

component:
    vertex_declaration end
    |edge_declaration end
    |graph_object_declaration end
    |methodcall end
    |assignment end
    |conditional
    |loop
    |COMMENT
    ;


vertex_declaration:
    VERTEX VARIABLE
    ;

edge_declaration:
    EDGE VARIABLE

graph_object_declaration:
    property
    ;

property:
    PROPERTY VARIABLE ASSIGNMENT LPARAN property_stmt RPARAN
    ;

methodcall:
    VARIABLE DOT INCLUDEPROPERTY LPARAN property_stmt RPARAN
    |CONNECT LPARAN VARIABLE COMMA VARIABLE COMMA VARIABLE RPARAN
    ;

assignment:
    |VARIABLE ASSIGNMENT element
    ;

conditional:
    if_cond | ifelse_cond
    ;

if_cond:
    IFSTATEMENT LPARAN cond RPARAN LBRACKET component_list RBRACKET
    ;

ifelse_cond:
    IFSTATEMENT LPARAN cond RPARAN LBRACKET component_list RBRACKET ELSESTATEMENT LBRACKET component_list RBRACKET
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
    FOR LPARAN assignment SEMICOLON cond SEMICOLON assignment RPARAN LBRACKET component_list RBRACKET
    ;

while:
    WHILE LPARAN cond RPARAN LBRACKET component_list RBRACKET
    ;
    
property_stmt:
    element COMMA element
    | VARIABLE
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
    map_tail COMMA mapbody
    |map_tail
    ;

map_tail:
    STRING COLON element
    ;

setbody:
    element tail2
    |
    ;
listbody:
    element tail2
    |
    ;
tail2:
    COMMA setbody;
    |
    ;

element:
    INTEGER|FLOAT|STRING|map|set|list
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
