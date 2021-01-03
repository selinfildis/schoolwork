`timescale 1ns / 1ps

module alu( input logic[2:0] aluop,
            input logic [31:0] operand1,
            input logic [31:0] operand2,
            output logic [31:0] result   

    );
always@(*)
    case(aluop)
        3'b000: result <= operand1 & operand2;
        3'b001: result <= operand1 | operand2;
        3'b110: result <= operand1 + operand2;
        3'b011: result <= operand1 - operand2;
        3'b111: result <= operand1 < operand2 ? 1:0;
        default: result <= 32'b0;     
    endcase
endmodule
