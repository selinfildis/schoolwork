module songProgress(input logic clk, input logic rst, [6:0]counter, output logic [9:0]prog);  
  always_ff@(posedge clk)
    if(rst)
        prog <= 0;
    else if(counter<=7'd9)
        prog<=10'b0000000001;
    else if(counter<=7'd18)
      prog<=10'b0000000011;
    else if(counter<=7'd27)
      prog<=10'b0000000111;
    else if(counter<=7'd36)
      prog<=10'b0000001111;
    else if(counter<=7'd45)
      prog<=10'b0000011111;
    else if(counter<=7'd54)
      prog<=10'b0000111111;
    else if(counter<=7'd63)
      prog<=10'b0001111111;
    else if(counter<=7'd72)
      prog<=10'b0011111111;
    else if(counter<=7'd81)
      prog<=10'b0111111111;
    else 
      prog<=10'b1111111111;
      
      endmodule
