module equalityCheck(input logic [4:0] buttons, song, output logic out);

	logic [4:0]temp;
	xor(temp[4],buttons[4],song[4]);
	xor(temp[3],buttons[3],song[3]);
	xor(temp[2],buttons[2],song[2]);
	xor(temp[1],buttons[1],song[1]);
	xor(temp[0],buttons[0],song[0]);
	and(out, temp[4],temp[3],temp[2],temp[1],temp[0]);
	
endmodule
