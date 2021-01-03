`timescale 1ns / 1ps

module TopModule(input logic clk,[4:0] button_input,
      output logic songplay, [4:0] songD, [6:0] seg, [3:0] an           
    );
    logic button_in;
   // logic [4:0] songD;
    logic [6:0] pos;
   
    controlUnit cu(clk, button_in, pos );
    datapathUnit du(clk, button_input, pos,
                 songplay, 
                 button_in,
                 songD,seg, an );
       
endmodule
