module clk_divider(input logic clk, output logic clk_new);
    logic[9:0] counter;
    always_ff@(posedge clk)
        if(counter == 10'd1000)
            counter <= 10'b0;
        else
            counter<=counter+1;
        
endmodule
