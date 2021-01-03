
// Top level system including MIPS and memories
//----------------------------------------------

module top( input         clk, reset,
            output [31:0] writedata, dataadr,
            output        memwrite,
            output [31:0] pc, instr);

 
  wire [31:0] readdata;

  // instantiate processor and memories

  mips mips(clk, reset, pc, instr, memwrite, dataadr, writedata, readdata);
  imem imem(pc[7:2], instr);
  dmem dmem(clk, memwrite, dataadr, writedata, readdata);

endmodule


// External data memory used by MIPS single-cycle processor

module dmem(input         clk, we,
            input  [31:0] addr, wd,
            output [31:0] rd);

  reg  [31:0] RAM[63:0];

  assign rd = RAM[addr[31:2]]; // word-aligned read (for lw)

  always @(posedge clk)
    if (we)
      RAM[addr[31:2]] <= wd;   // word-aligned write (for sw)

endmodule


// External instruction memory used by MIPS single-cycle
// processor. It models instruction memory as a stored-program 
// ROM, with address as input, and instruction as output

module imem ( input [5:0] addr,
    		   output reg [31:0] instr);

	always@(addr)
	   case ({addr,2'b00})		   // word-aligned fetch
//		address		instruction
//		-------		-----------
		8'h00: instr = 32'h20020005;  // disassemble, by hand 
		8'h04: instr = 32'h2003000c;  // or with a program,
		8'h08: instr = 32'h2067fff7;  // to find out what
		8'h0c: instr = 32'h00e22025;  // this program does!
		8'h10: instr = 32'h00642824;
		8'h14: instr = 32'h00a42820;
		8'h18: instr = 32'h10a7000a;
		8'h1c: instr = 32'h0064202a;
		8'h20: instr = 32'h10800001;
		8'h24: instr = 32'h00e2202a;
		8'h28: instr = 32'h00853820;
		8'h2c: instr = 32'h00e23822;
		8'h30: instr = 32'hac670000;
		8'h34: instr = 32'h8c020018;
		8'h38: instr = 32'h08000011;
		8'h3c: instr = 32'h20020001;
		8'h40: instr = 32'h20620101;
		8'h44: instr = 32'h08000012;
	     default: instr = {32{1'bx}};	// unknown address
	   endcase
endmodule


// single-cycle MIPS processor, with controller and datapath

module mips (input         clk, reset,
             output [31:0] pc,
             input  [31:0] instr,
             output        memwrite,
             output [31:0] aluout, writedata,
             input  [31:0] readdata);

  wire        memtoreg, pcsrc, zero,
              alusrc, regdst, regwrite, jump;
  wire [2:0]  alucontrol;

  controller c (instr[31:26], instr[5:0], zero,
               memtoreg, memwrite, pcsrc,
               alusrc, regdst, regwrite, jump,
               alucontrol);
  datapath dp (clk, reset, memtoreg, pcsrc,
              alusrc, regdst, regwrite, jump,
              alucontrol, zero, pc, instr,
              aluout, writedata, readdata);
endmodule


module controller(input  [5:0] op, funct,
                  input        zero,
                  output       memtoreg, memwrite,
                  output       pcsrc, alusrc,
                  output       regdst, regwrite,
                  output       jump,
                  output [2:0] alucontrol);

  wire [1:0] aluop;
  wire       branch;

  maindec md (op, regwrite, regdst, alusrc, branch,
             memwrite, memtoreg, aluop, jump);
  aludec  ad (funct, aluop, alucontrol);

  assign pcsrc = branch & zero;
endmodule


module maindec(input  [5:0] op,
               output       regwrite, regdst,
               output       alusrc, branch, 
               output       memwrite, memtoreg,
               output [1:0] aluop, 
               output       jump);

  reg [8:0] controls;

  assign {regwrite, regdst, alusrc, branch, 
          memwrite, memtoreg, aluop, jump} = controls;

  always @(*)
    case(op)
      6'b000000: controls <= 9'b110000100; // R-type
      6'b100011: controls <= 9'b101001000; // LW
      6'b101011: controls <= 9'b001010000; // SW
      6'b000100: controls <= 9'b000100010; // BEQ
      6'b001000: controls <= 9'b101000000; // ADDI
      6'b000010: controls <= 9'b000000001; // J
      default:   controls <= 9'bxxxxxxxxx; // ???
    endcase
endmodule

module aludec(input      [5:0] funct,
              input      [1:0] aluop,
              output reg [2:0] alucontrol);

  always @(*)
    case(aluop)
      2'b00: alucontrol <= 3'b010;  // add
      2'b01: alucontrol <= 3'b110;  // sub
      default: case(funct)          // RTYPE
          6'b100000: alucontrol <= 3'b010; // ADD
          6'b100010: alucontrol <= 3'b110; // SUB
          6'b100100: alucontrol <= 3'b000; // AND
          6'b100101: alucontrol <= 3'b001; // OR
          6'b101010: alucontrol <= 3'b111; // SLT
          default:   alucontrol <= 3'bxxx; // ???
        endcase
    endcase
endmodule

module datapath(input         clk, reset,
                input         memtoreg, pcsrc,
                input         alusrc, regdst,
                input         regwrite, jump,
                input  [2:0]  alucontrol,
                output        zero,
                output [31:0] pc,
                input  [31:0] instr,
                output [31:0] aluout, writedata,
                input  [31:0] readdata);

  wire [4:0]  writereg;
  wire [31:0] pcnext, pcnextbr, pcplus4, pcbranch;
  wire [31:0] signimm, signimmsh;
  wire [31:0] srca, srcb;
  wire [31:0] result;

  // next PC logic
  flopr #(32) pcreg(clk, reset, pcnext, pc);
  adder       pcadd1(pc, 32'b100, pcplus4);
  sl2         immsh(signimm, signimmsh);
  adder       pcadd2(pcplus4, signimmsh, pcbranch);
  mux2 #(32)  branchmux(pcplus4, pcbranch, pcsrc,
                      pcnextbr);
  mux2 #(32)  jumpmux(pcnextbr, {pcplus4[31:28], 
                    instr[25:0], 2'b00}, 
                    jump, pcnext);

  // register file logic
  regfile     rf(clk, regwrite, instr[25:21],
                 instr[20:16], writereg,
                 result, srca, writedata);
  mux2 #(5)   w_addrmux(instr[20:16], instr[15:11],
                    regdst, writereg);
  mux2 #(32)  w_datamux(aluout, readdata,
                     memtoreg, result);
  signext     se(instr[15:0], signimm);

  // ALU logic
  mux2 #(32)  srcbmux(writedata, signimm, alusrc,
                      srcb);
  alu         alu(srca, srcb, alucontrol,
                  aluout, zero);
endmodule


// 3-ported register file, w/ register 0 hardwired to 0
// 2 read ports (combinational), 1 write port (clocked)

module regfile(input         clk, 
               input         we3, 
               input  [4:0]  ra1, ra2, wa3, 
               input  [31:0] wd3, 
               output [31:0] rd1, rd2);

  reg [31:0] rf[31:0];

  always @(posedge clk)
    if (we3) rf[wa3] <= wd3;	

  assign rd1 = (ra1 != 0) ? rf[ra1] : 0;
  assign rd2 = (ra2 != 0) ? rf[ra2] : 0;
endmodule
/////////////////////////////////////////////////////////////
module alu( input logic[2:0] aluop,
            input logic [31:0] operand1,
            input logic [31:0] operand2,
            output logic [31:0] result,  
            output logic zero
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
    always@(*)
    begin
        if(result == 32'b0)
            zero <= 1;
        else 
            zero <= 0;
    end
endmodule
//////////////////////////////////////////////////////////
module adder(input [31:0] a, b,
             output [31:0] y);

  assign y = a + b;
endmodule

module sl2(input  [31:0] a,
           output [31:0] y);

  assign y = {a[29:0], 2'b00};	// shifts left by 2
endmodule

module signext(input  [15:0] a,
               output [31:0] y);
              
  assign y = {{16{a[15]}}, a};	// sign-extends 16-bit a
endmodule


// parameterized register 
module flopr #(parameter WIDTH = 8)
              (input                  clk, reset,
               input      [WIDTH-1:0] d, 
               output reg [WIDTH-1:0] q);

  always @(posedge clk, posedge reset)
    if (reset) q <= 0;
    else       q <= d;
endmodule

// parameterized register with enable
module flopenr #(parameter WIDTH = 8)
                (input                  clk, reset,
                 input                  en,
                 input      [WIDTH-1:0] d, 
                 output reg [WIDTH-1:0] q);
 
  always @(posedge clk, posedge reset)
    if      (reset) q <= 0;
    else if (en)    q <= d;
endmodule

// paramaterized 2-to-1 MUX
module mux2 #(parameter WIDTH = 8)
             (input  [WIDTH-1:0] d0, d1, 
              input              s, 
              output [WIDTH-1:0] y);

  assign y = s ? d1 : d0; 
endmodule
