
module pointsDisplayer(input points, output logic [6:0] seg, [3:0] AN);
        logic [9:0] points_disp;
        logic [3:0] current_digit, cur_dig_AN, digit0, digit1, digit2, digit3;
		logic [6:0] segments;
        logic  DP;
        initial begin digit0 = 0; digit1 = 0; digit2 = 0; digit3 = 0;  end
	    assign AN = ~(enables & cur_dig_AN);
	    assign C = ~segments; 
      	assign DP = 1;            	
// the 19-bit counter, runs at 100 MHz, so bit17 changes each 1.3 millisecond
        always_ff@(posedge clk)
            points_disp <= points_disp + points;
        
        always_comb
            if(points_disp < 9'b000001001)
                digit1 = points_disp[3:0];
            else if (points_disp <  9'b000010100 )begin    
                digit2 = 4'b0001;
                digit1 = points_disp[5:0]-4'b1001;
                end
            else if(points_disp < 9'b000011110)begin
                digit2 = 4'b0010;
                digit1 = points_disp[5:0]-5'b10100;
                end
            else if(points_disp < 9'b000101000)begin
                digit2 = 4'b0011;
            
                end                  
	   logic [18:0] count, nextcount;

	   always_ff @(posedge clk)
		  if(clear) count <= 0;
		  else count <= nextcount;

	   always_comb
		  nextcount = count + 1;
	
	   
// the upper 2 bits of the counter cycle through the digits and the AN patterns
			
	   always_comb
           case (count[18:17])
                // left most is AN3  
		  2'b00: begin current_digit = digit3; cur_dig_AN = 4'b1000; end  
		  2'b01: begin current_digit = digit2; cur_dig_AN = 4'b0100; end
		  2'b10: begin current_digit = digit1; cur_dig_AN = 4'b0010; end
		  2'b11: begin current_digit = digit0; cur_dig_AN = 4'b0001; end
                // right most is AN0
	   endcase	   
	   

// the hex-to-7-segment decoder


// 	Here is the place for your code: 
// 	It should model the combinational logic for the hex-to-7-segment decoder
// 	It will have a 4-bit input: current_digit, and have a 7-bit output: segments.
		
endmodule
