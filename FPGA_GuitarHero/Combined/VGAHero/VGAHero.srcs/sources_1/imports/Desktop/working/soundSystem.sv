//module soundSystem(input logic clk,[4:0]sw,output reg songplay);
//assign speaker = clkdivider;
//reg [8:0] clkdivider;
//always @(posedge clk)
//case(sw)
//  5'b00001: clkdivider = 512-1; // A 
//  5'b00010: clkdivider = 456-1; // B 
//  5'b00100: clkdivider = 431-1; // C 
//  5'b01000: clkdivider = 384-1; // D 
//  5'b10000: clkdivider = 342-1; // E 
//  default: clkdivider = 0; // should never happen
//endcase
//endmodule
module music(clk,sw, speaker);
input logic clk;
input logic [4:0]sw;
output reg speaker;

reg [16:0] counter;
always @(posedge clk) counter<=counter+1;
always @(posedge clk)
case(sw)
  5'b00001: speaker = counter[12]; // A 
  5'b00010: speaker = counter[13]; // B 
  5'b00100: speaker = counter[14]; // C 
  5'b01000: speaker = counter[15]; // D 
  5'b10000: speaker = counter[16]; // E 
  default: speaker = 0; // should never happen
endcase
//assign speaker = counter[15];
endmodule
