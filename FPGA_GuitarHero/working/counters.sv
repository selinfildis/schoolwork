`timescale 1ns / 1ps
//////////////////////////////////////////////////////////////////////////////////
// Company: 
// Engineer: 
// 
// Create Date: 03.05.2016 12:42:01
// Design Name: 
// Module Name: counter
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
module counter(input logic sig, output logic[6:0] pos);
	
	always_ff@(posedge sig)
		pos<=pos+1;
endmodule

module sec1counter(input logic clk, rst, output logic clkout);
logic [49:0] counter;
    initial begin 
        counter = 0; 
        clkout = 0;
    end
    always @(posedge clk, posedge rst) begin
       if(rst)
            counter = 0;
       else
           begin
            if (counter == 0) begin
                counter <= 49999999;
                clkout <= ~clkout;
            end else begin
                counter <= counter -1;
            end
        end
    end
    
endmodule
