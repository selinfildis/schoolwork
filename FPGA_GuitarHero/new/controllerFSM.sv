module controllerFSM(input logic clk, buttonIn, timer ,output logic countersig );
	logic state, nextState;
	initial begin state = 0; end
	always_ff@(posedge clk)
		state<=nextState;
	always_comb
		case(state)
			0:begin if(!buttonIn || timer)
			         nextState<=0; 
			       else nextState<=1; end
			1:nextState<=0;
		endcase
	always_comb
		if(state)
			countersig = 1;
		else
			countersig = 0;
endmodule
