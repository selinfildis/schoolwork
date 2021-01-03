module equalityCheck(input logic [4:0] buttons, input logic [4:0] song, output logic out);

//	logic [4:0]temp;
//	xnor(temp[4],buttons[4],song[4]);
//	xnor(temp[3],buttons[3],song[3]);
//	xnor(temp[2],buttons[2],song[2]);
//	xnor(temp[1],buttons[1],song[1]);
//	xnor(temp[0],buttons[0],song[0]);
//	and(out, temp[4],temp[3],temp[2],temp[1],temp[0]);
always_comb
    if(buttons==song)
        out=1;
    else 
        out=0;
//assign out= buttons==song;
	
endmodule
