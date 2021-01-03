
module FPGA_HERO(
    input logic clk, rst,[4:0]button,
    output logic [4:0]led, logic button_eq, logic [6:0]seg, logic [3:0]an, logic dp,logic [9:0]progress, logic songplay,
    output logic [3:0] red,    //red vga output - 3 bits
    output logic [3:0] green,//green vga output - 3 bits
    output logic [3:0] blue,    //blue vga output - 2 bits
    output logic hsync,        //horizontal sync out
    output logic vsync            //vertical sync out
    );
    reg [4:0]output_button;
    logic [6:0]go;
    logic sig;
    logic blink;
    
    reg [7:0]pointOut;
    PushButton_Debouncer deb1(clk,button[0],output_button[0]);
    PushButton_Debouncer deb2(clk,button[1],output_button[1]);
    PushButton_Debouncer deb3(clk,button[2],output_button[2]);
    PushButton_Debouncer deb4(clk,button[3],output_button[3]);
    PushButton_Debouncer deb5(clk,button[4],output_button[4]);
    sec1counter sc(clk, rst,sig, blink);
    counter c(sig,rst, go);
    songData sd(clk, go, led);
    equalityCheck equal(output_button, led,button_eq );
    pointKeeper pk(clk, button_eq, pointOut);
    songProgress sp(clk, rst, go, progress);
//    soundSystem ss(clk, led, songPlay);
    seg7 display_ctrl(clk, rst,4'b1111, 4'b0000, 4'b0000, pointOut[7:4], pointOut[3:0],an, seg, dp);
     vgaTop VGA( .clk(clk),            //master clock = 50MHz
        .clr(rst),            //right-most pushbutton for reset
        .note(led),
        .red(red),    //red vga output - 3 bits
        .green(green),//green vga output - 3 bits
        .blue(blue),    //blue vga output - 2 bits
        .hsync(hsync),        //horizontal sync out
        .vsync(vsync),            //vertical sync out
        .blink(blink),
        .button_eq(button_eq)
        );
endmodule
