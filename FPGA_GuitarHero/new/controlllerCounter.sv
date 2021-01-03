module controllerCounter(input logic sig, output logic[6:0] pos);
	logic [6:0] posCount;
	always@(posedge sig)
		posCount<=posCount+1;
	assign pos=posCount;
endmodule