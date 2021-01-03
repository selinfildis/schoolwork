module pointKeeper(input logic clk, comp, output reg [7:0] pointOut);
	reg[7:0] points;
	initial begin points=8'b0;end
	always@(posedge comp)
			begin
				points=points+1;
			end
	assign pointOut=points;	
endmodule
