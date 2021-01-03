

module alu_test();

logic[2:0] aluop;
logic[31:0] op1;
logic[31:0] op2;
logic[31:0] res;
alu aluUnderTest(aluop, op1,op2,res);
initial begin 
#100;
op1 = 32'b00000000000000000000000000000011;
op2 = 32'b00000000000000000000000000000100;
#10;
aluop = 000;
#10;
aluop = 001;
#10;
aluop = 110;
#10;
aluop = 011;
#10;
aluop = 111;
end
endmodule
