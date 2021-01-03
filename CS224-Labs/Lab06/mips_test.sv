`timescale 1ns / 1ps
//////////////////////////////////////////////////////////////////////////////////
// Company: 
// Engineer: 
// 
// Create Date: 30.11.2016 20:39:07
// Design Name: 
// Module Name: mips_test
// Project Name: 
// Target Devices: 
// Tool Versions: 
// Description: 
// 
// Dependencies: 
// 
// Revision:
// Revision 0.01 - File Created
// Additional Comments:
// 
//////////////////////////////////////////////////////////////////////////////////


module mips_test();
logic clk, reset;
logic [31:0] writedata, dataadr;
logic memwrite;
logic [31:0] pc, instr;
top top_uut(clk, reset, writedata,dataadr, memwrite,pc, instr);
initial begin 
#100;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 1;
#10;
clk = 1;
reset = 1;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;
#10;
clk = 0;
reset = 0;
#10;
clk=1;
reset = 0;

end
endmodule
