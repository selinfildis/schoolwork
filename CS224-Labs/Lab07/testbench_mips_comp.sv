`timescale 1ns / 1ps
//////////////////////////////////////////////////////////////////////////////////
// Company: 
// Engineer: 
// 
// Create Date: 07.12.2016 20:33:46
// Design Name: 
// Module Name: testbench_mips_comp
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


module testbench_mips_comp( );
    logic clk, reset;
    logic memwrite;
    logic [31:0]writedata,dataadr,pc,instr,readdata;
    top uut(clk, reset, memwrite, writedata, dataadr, pc, instr, readdata);
    initial begin 
    #100;
    reset = 1;
    clk = 0;
    #10;
    clk=1;
    #10;
    reset = 0;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    #10;
    clk=0;
    #10;
    clk=1;
    end
endmodule
