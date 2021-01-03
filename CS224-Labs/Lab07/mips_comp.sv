`timescale 1ns / 1ps
module top( input         clk, reset,
            output        memwrite,
            output [31:0]writedata,dataadr,pc,instr,readdata
            );

   
  //instantiate processor and memories
  
  mips mips(clk, reset, pc, instr, memwrite, dataadr, writedata, readdata);//clk_pulse,reset_pulse
  imem imem(pc[7:2], instr);
  dmem dmem(clk, memwrite, dataadr, writedata, readdata);//clk_pulse

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


		8'h00: instr = 32'h8c090001;  // disassemble, by hand 
		8'h04: instr = 32'h8c0a0000; 
		8'h08: instr = 32'h8c0b0006;  // or with a program,
		8'h0c: instr = 32'h01495020;  // to find out what
		8'h10: instr = 32'h21290001;  // this program does!
		8'h14: instr = 32'h114b0001;
		8'h18: instr = 32'h0401fffc;
		8'h1c: instr = 32'h21420000;//$v0 = 6
        8'h20: instr = 32'h8c090005; 
		8'h24: instr = 32'h8c0a0006;
		8'h28: instr = 32'h8c0b0000;
		8'h2c: instr = 32'h8c0c0000;
		8'h30: instr = 32'h01695820;
		8'h34: instr = 32'h218c0001;
		8'h38: instr = 32'h118a0001;
		8'h3c: instr = 32'h0401fffc;
		8'h40: instr = 32'h21620000;
		8'h44: instr = 32'h8c09000a;
		8'h48: instr = 32'h8c0a0003;
		8'h4c: instr = 32'h8c0b0002;
		8'h50: instr = 32'h8c0c0000;
		8'h54: instr = 32'h012a4822;
		8'h58: instr = 32'h218c0001;
		8'h5c: instr = 32'h012b082a;
		8'h60: instr = 32'h1020fffc;
		8'h64: instr = 32'h21220000;
		8'h68: instr = 32'h21830000;
		
	    default: instr = {32{1'bx}};	// unknown address
	   endcase
endmodule



module mips (input         clk, reset,
             output [31:0] pc,
             input  [31:0] instr,
             output        memwrite,
             output [31:0] aluout, writedata,
             input  [31:0] readdata);

  wire        memtoreg, pcsrc,pcsrc2, zero,greater,alusrc, regdst, regwrite, jump,RegWriteData,jm;
  wire [2:0]  alucontrol;

  controller c (instr[31:26], instr[5:0], zero,greater,
               memtoreg, memwrite,RegWriteData,jm, pcsrc,alusrc,pcsrc2,
                regdst, regwrite, jump,
               alucontrol);
  datapath dp (clk, reset, memtoreg, pcsrc, pcsrc2,RegWriteData,jm,
              alusrc, regdst, regwrite, jump,
              alucontrol, zero,greater, pc, instr,
              aluout, writedata, readdata);//works good
endmodule

module controller(input  [5:0] op, funct,
                  input        zero,greater,
                  output       memtoreg, memwrite,RegWriteData,jm,
                  output       pcsrc, alusrc,pcsrc2,
                  output       regdst, regwrite,
                  output       jump,
                  output [2:0] alucontrol);

 	 wire [1:0] aluop;
	  wire       branch;

 	 maindec md (op, regwrite, regdst, alusrc, branch,BranchGreater, RegWriteData,jm,
               memwrite, memtoreg, aluop, jump);
 	 aludec  ad (funct, aluop, alucontrol);

  	assign pcsrc = branch & zero;
	assign pcsrc2=BranchGreater & greater;
	
	endmodule

module maindec(input  [5:0] op,
               output       regwrite, regdst,
               output       alusrc, branch, BranchGreater,RegWriteData,jm,
               output       memwrite, memtoreg,
               output [1:0] aluop, 
               output       jump);

 	 reg [11:0] controls;

 	 assign {regwrite, regdst, alusrc, branch,BranchGreater,RegWriteData,jm ,
          	memwrite, memtoreg, aluop, jump} = controls;

  	always @(*)
 	   case(op)
  	    6'b000000: controls <= 12'b110001x00100; // R-type
   	   6'b100011: controls <= 12'b101001x01000; // LW 
   	   6'b101011: controls <= 12'b0x100xx1x000; // SW
   	   6'b000100: controls <= 12'b0x010xx0x010; // BEQ
  	    6'b001000: controls <= 12'b101001x00000; // ADDI
  	    6'b000010: controls <= 12'b0xxxxx00xxx1; // J
	    6'b000001: controls<= 12'b101001x00010;//subi
	    6'b000011:controls<=12'b0x100x10x001;//jm
	     6'b000101:controls<=12'b0x001xx0x110;//bge
	    6'b000110: controls<=12'b10100010x001;//jalm
    	  default:   controls <= 12'bxxxxxxxxxxxx; // ???
  	  endcase
	endmodule



module aludec(input      [5:0] funct,
              input      [1:0] aluop,
              output reg [2:0] alucontrol);

  always @(*)
    case(aluop)
      2'b00: alucontrol <= 3'b010;  // add
      2'b01: alucontrol <= 3'b110;  // sub
      2'b11: alucontrol <=3'b111; // slt
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
                input         memtoreg, pcsrc,pcsrc2,RegWriteData,jm,
                input         alusrc, regdst,
                input         regwrite, jump,
                input  [2:0]  alucontrol,
                output        zero,greater,
                output [31:0] pc,
                input  [31:0] instr,
                output [31:0] aluout, writedata,
                input  [31:0] readdata);

  wire [4:0]  writereg;
  wire [31:0] pcnext, pcnextbr, pcplus4, pcbranch;
  wire [31:0] signimm, signimmsh;
  wire [31:0] srca, srcb;
  wire [31:0] result;
  wire [31:0]jumpRes,finalResult;
  // next PC logic
  flopr #(32) pcreg(clk, reset, pcnext, pc);
  adder       pcadd1(pc, 32'b100, pcplus4);
  sl2         immsh(signimm, signimmsh);
  adder       pcadd2(pcplus4, signimmsh, pcbranch);
//bge modification
  mux2 #(32)  branchmux(pcplus4, pcbranch, pcsrc || pcsrc2,
                      pcnextbr);
//Modification after jm 

mux2#(32) jumpChoose({pcplus4[31:28], 
                    instr[25:0], 2'b00},readdata,jm,jumpRes);
  mux2 #(32)  jumpmux(pcnextbr,jumpRes, 
                    jump, pcnext);

  // register file logic
  regfile     rf(clk, regwrite, instr[25:21],
                 instr[20:16], writereg,
                finalResult, srca, writedata);
  mux2 #(5)   w_addrmux(instr[20:16], instr[15:11],
                    regdst, writereg);
//jalm modification
  mux2 #(32)  w_datamux(aluout, readdata,
                   memtoreg, result);
mux2#(32) writerMux(pcplus4,result,RegWriteData,finalResult);

  signext     se(instr[15:0], signimm);

  // ALU logic
  mux2 #(32)  srcbmux(writedata, signimm, alusrc,
                      srcb);
  alu         alu(srca, srcb, alucontrol,
                  aluout, zero,greater);
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



module alu(input       [31:0]a, b, 
           input      [2:0]alucont , 
           output    reg   [31:0]result,
           output     reg      zero,greater);
           
    always@(alucont,a or b)
        case(alucont)
        3'b010: begin result = a+b; zero=0; greater=0; end
        3'b110: begin result=a-b;  zero=~|result; greater=0; end
        3'b000: begin result=a & b;   zero=0; greater=0; end
        3'b001:begin result= a|b;   zero=0; greater=0;end
        3'b111: begin if(a<b)begin result=1; greater=0; end else begin result=0; greater=1; end  zero=0;end
        default:begin result=0;  zero=0;  greater=0;  end
        endcase        
endmodule

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
