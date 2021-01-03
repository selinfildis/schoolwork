
module datapath(
    input logic clk, rst,[4:0]button,
    output logic [4:0]led, logic button_eq, logic [6:0]seg, logic [3:0]an, logic dp,logic [9:0]progress, logic songplay
    );
    reg [4:0]output_button;
    logic [6:0]go;
    logic sig;
    
    reg [7:0]pointOut;
    PushButton_Debouncer deb1(clk,button[0],output_button[0]);
    PushButton_Debouncer deb2(clk,button[1],output_button[1]);
    PushButton_Debouncer deb3(clk,button[2],output_button[2]);
    PushButton_Debouncer deb4(clk,button[3],output_button[3]);
    PushButton_Debouncer deb5(clk,button[4],output_button[4]);
    sec1counter sc(clk, rst,sig);
    counter c(sig, go);
    songData sd(clk, go, led);
    equalityCheck equal(output_button, led,button_eq );
    pointKeeper pk(clk, button_eq, pointOut);
    songProgress(clk, pointOut, progress);
    soundSystem ss(clk, led, songPlay);
    seg7 display_ctrl(clk, rst,4'b1111, 4'b0000, 4'b0000, pointOut[7:4], pointOut[3:0],an, seg, dp);
endmodule
