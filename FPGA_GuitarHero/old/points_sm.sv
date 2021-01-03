module points_sm( input logic [3:0] buttons, [3:0] song_data, clk, output logic [7:0] points);
    logic nextState, state;
    logic clk_new;
    logic [7:0] point_holder;
    always_comb
    begin
        if(buttons == song_data)
            nextState = 1;
        else
            nextState = 0;
        clk_divider divider(clk, clk_new);
    end
    always_ff@(posedge clk_new)
        state<=nextState;
    always_comb 
    begin
        if(state == 1)
            point_holder = point_holder+1;
        else
            point_holder = point_holder;
        points = point_holder;
    end   
endmodule
