module soundSystem(input logic clk,[4:0]songD,output logic songplay);
	logic[4:0] song;
	A as(clk, song[1]);
	B bs(clk, song[2]);
	C cs(clk, song[3]);
	D ds(clk, song[4]);
	E es(clk, song[0]);
	sec2counter counter2(clk, 0, div_clk);
	always_ff@(posedge div_clk)
		case (songD)
			default: begin songplay <= 0; end
			5'b00001:begin songplay <= song[1]; end
			5'b00010:begin songplay <= song[2]; end
			5'b00100:begin songplay <= song[3]; end
			5'b01000:begin songplay <= song[4]; end
			5'b10000:begin songplay <= song[0]; end
		endcase
endmodule

module A(input logic clk, output logic speaker);//440HZ
logic [14:0] counter;
always @(posedge clk) if(counter==28408) counter<=0; else counter <= counter+1;

always @(posedge clk) if(counter==28408) speaker <= ~speaker;
endmodule


module B(input logic clk, output logic  speaker);//400Hz
logic [20:0] counter;
always @(posedge clk) if(counter==10999999) counter <= 0; else counter <= counter+1;

assign speaker = counter[20];
endmodule

module C(input logic clk, output logic speaker);//350Hz
logic [30:0] counter;
always @(posedge clk) if(counter==29999999) counter <= 0; else counter <= counter+1;
assign speaker = counter[30];
endmodule


module D(input logic clk, output logic  speaker);//300Hz
logic [40:0] counter;
always @(posedge clk) if(counter==49999999) counter <= 0; else counter <= counter+1;

assign speaker = counter[40];
endmodule

module E(input logic clk, output logic  speaker);//250Hz
logic [50:0] counter;
always @(posedge clk) if(counter==49999999) counter <= 0; else counter <= counter+1;

assign speaker = counter[50];
endmodule
