# Clock signal 
set_property PACKAGE_PIN W5 [get_ports clk]  	 	 	 	  
 	set_property IOSTANDARD LVCMOS33 [get_ports clk] 
# create_clock -add -name sys_clk_pin -period 10.00 -waveform {0 5} [get_ports clk] 

set_property PACKAGE_PIN U16 [get_ports {led[0]}]  	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {led[0]}] 
set_property PACKAGE_PIN E19 [get_ports {led[1]}]  	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {led[1]}] 
set_property PACKAGE_PIN U19 [get_ports {led[2]}]  	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {led[2]}] 
set_property PACKAGE_PIN V19 [get_ports {led[3]}]  	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {led[3]}] 
set_property PACKAGE_PIN W18 [get_ports {led[4]}]  	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {led[4]}] 

set_property PACKAGE_PIN L1 [get_ports {button_eq}]  	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {button_eq}]
 	
set_property PACKAGE_PIN U18 [get_ports {rst}] 	 	 	 	 	 
      set_property IOSTANDARD LVCMOS33 [get_ports {rst}] 

#Pmod Header JC 
#Sch name = JC1 
set_property PACKAGE_PIN K17 [get_ports {button[0]}]  	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {button[0]}] 
#Sch name = JC2 
set_property PACKAGE_PIN M18 [get_ports {button[1]}]  	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {button[1]}] 
#Sch name = JC3 
set_property PACKAGE_PIN N17 [get_ports {button[2]}]  	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {button[2]}] 
#Sch name = JC4 
set_property PACKAGE_PIN P18 [get_ports {button[3]}]  	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {button[3]}] 
#Sch name = JC7 
set_property PACKAGE_PIN L17 [get_ports {button[4]}] 
set_property IOSTANDARD LVCMOS33 [get_ports {button[4]}]  	

#7 segment display 
set_property PACKAGE_PIN W7 [get_ports {seg[0]}] 	 	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {seg[0]}] 
set_property PACKAGE_PIN W6 [get_ports {seg[1]}] 	 	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {seg[1]}] 
set_property PACKAGE_PIN U8 [get_ports {seg[2]}] 	 	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {seg[2]}] 
set_property PACKAGE_PIN V8 [get_ports {seg[3]}] 	 	 	 	 	 
          set_property IOSTANDARD LVCMOS33 [get_ports {seg[3]}] 
     set_property PACKAGE_PIN U5 [get_ports {seg[4]}]                          
          set_property IOSTANDARD LVCMOS33 [get_ports {seg[4]}] 
     set_property PACKAGE_PIN V5 [get_ports {seg[5]}]                          
          set_property IOSTANDARD LVCMOS33 [get_ports {seg[5]}] 
     set_property PACKAGE_PIN U7 [get_ports {seg[6]}]                          
          set_property IOSTANDARD LVCMOS33 [get_ports {seg[6]}] 
     set_property PACKAGE_PIN V7 [get_ports dp]                       
          set_property IOSTANDARD LVCMOS33 [get_ports dp] 
     set_property PACKAGE_PIN U2 [get_ports {an[0]}]                          
          set_property IOSTANDARD LVCMOS33 [get_ports {an[0]}] 
     set_property PACKAGE_PIN U4 [get_ports {an[1]}]                          
          set_property IOSTANDARD LVCMOS33 [get_ports {an[1]}] 
     set_property PACKAGE_PIN V4 [get_ports {an[2]}]                          
          set_property IOSTANDARD LVCMOS33 [get_ports {an[2]}] 
     set_property PACKAGE_PIN W4 [get_ports {an[3]}]                          
 	set_property IOSTANDARD LVCMOS33 [get_ports {an[3]}] 
 
set_property PACKAGE_PIN J1 [get_ports {progress[8]}] 	 	 	 	 	 
          set_property IOSTANDARD LVCMOS33 [get_ports {progress[8]}] 
     #Sch name = JA2 
     set_property PACKAGE_PIN L2 [get_ports {progress[9]}]                          
          set_property IOSTANDARD LVCMOS33 [get_ports {progress[9]}] 


#Pmod Header JXADC 
#Sch name = XA1_P 
set_property PACKAGE_PIN J3 [get_ports {progress[0]}]  	 	 	 
set_property IOSTANDARD LVCMOS33 [get_ports {progress[0]}] 
#Sch name = XA2_P 
set_property PACKAGE_PIN L3 [get_ports {progress[1]}]  	 	 	 
set_property IOSTANDARD LVCMOS33 [get_ports {progress[1]}] 
#Sch name = XA3_P 
set_property PACKAGE_PIN M2 [get_ports {progress[2]}]  	 	 	 
set_property IOSTANDARD LVCMOS33 [get_ports {progress[2]}] 
#Sch name = XA4_P 
set_property PACKAGE_PIN N2 [get_ports {progress[3]}]  	 	 	 
set_property IOSTANDARD LVCMOS33 [get_ports {progress[3]}] 
#Sch name = XA1_N 
set_property PACKAGE_PIN K3 [get_ports {progress[4]}]  	 	 	 
set_property IOSTANDARD LVCMOS33 [get_ports {progress[4]}] 
#Sch name = XA2_N 
set_property PACKAGE_PIN M3 [get_ports {progress[5]}]  	 	 	 
set_property IOSTANDARD LVCMOS33 [get_ports {progress[5]}] 
#Sch name = XA3_N 
set_property PACKAGE_PIN M1 [get_ports {progress[6]}]  	 	 	 
set_property IOSTANDARD LVCMOS33 [get_ports {progress[6]}] 
#Sch name = XA4_N 
set_property PACKAGE_PIN N1 [get_ports {progress[7]}]  	 	 	 
set_property IOSTANDARD LVCMOS33 [get_ports {progress[7]}] 


#Sch name = JB2 
set_property PACKAGE_PIN A16 [get_ports {songplay}]  	 	 	 	 
 	set_property IOSTANDARD LVCMOS33 [get_ports {songplay}] 
