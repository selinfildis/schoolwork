module controlUnit(input logic clk, buttonIn, output logic [6:0] pos);
	logic countersig;
	logic timer;
	sec2counter count(clk, 0, timer);
	//timer icin clk divider lazım o eklencek
	controllerFSM fsm(clk,buttonIn,timer, countersig);
	controllerCounter cc(countersig,pos);
endmodule
module sec2counter(input logic clk, rst, output logic clkout);
logic [99:0] counter;
    initial begin 
        counter= 0; 
        clkout = 0;
    end
    always @(posedge clk)        
        if (counter == 0) begin
            counter <= 99999999;
            clkout <= ~clkout;
        end 
        else
         begin
            counter <= counter -1;
        end

    
endmodule