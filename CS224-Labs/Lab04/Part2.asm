# get # of elements
# create array with dinamic mem allocation
# get the numbers
# find max ->>> while(i < n) if(max<i) max = i
# find min ->>> while(i < n) if(min>i) min = i
# find sum ->>> while(i < n) sum = sum+arr[i]
# find diff ->> max()-min()

.data
prompt1: .asciiz "\n \nEnter # of elements\n"
prompt2: .asciiz "Enter element\n"
menuin: .asciiz "\n Select command\n"
menu1: .asciiz "1.Find max\n"
menu2: .asciiz "2.Find min\n"
menu3: .asciiz "3.Find sum\n"
menu4: .asciiz "4.Find difference of min and max\n"
menu5: .asciiz "5.Exit\n\n\n"
MAX: .float -10000.0
MIN: .float 10000.0
ZERO: .float 0.0

.text
la $a0, prompt1 #Enter #of elements
li $v0, 4
syscall
li $v0, 5
syscall
move $s0, $v0
mul $a0,$s0,4 #create mem location
li $v0, 9
syscall
move $s1, $v0
la $t0, ($s1)
li $t1, 0
Enterloop:
	beq $t1, $s0, Endloop
	la $a0, prompt2 #Enter elements
	li $v0, 4
	syscall
	li $v0, 6
	syscall
	s.s $f0, 0($t0)
	addi $t0, $t0, 4
	addi $t1, $t1,1
	b Enterloop
Endloop:	
#menu here
	la $a0, menuin
	li $v0, 4
	syscall
	la $a0, menu1
	li $v0, 4
	syscall
	la $a0, menu2
	li $v0, 4
	syscall
	la $a0, menu3
	li $v0, 4
	syscall
	la $a0, menu4
	li $v0, 4
	syscall
	la $a0, menu5
	li $v0, 4
	syscall
	li $v0, 5
	syscall
	beq $v0, 1, Max
	beq $v0, 2, Min
	beq $v0, 3, Sum
	beq $v0, 4, Diff
	beq $v0, 5, Exit
	#incorrenct command
	b Endloop
	
Max:
	l.s $f12, MAX
	li $t8, 0
	la $t2,($s1)
	MaxLoop:
		beq $t8, $s0, DisplayMax
		addi $t8, $t8, 1
		l.s $f4, 0($t2) #cannot store float from given adress ---> it changes the values to 0.
		c.lt.s $f12, $f4
		addi $t2, $t2, 4
		bc1t MaxChange
	MaxChange:
		mov.s $f12, $f4
		b MaxLoop
	DisplayMax:
		li $v0, 2
		syscall
		b Endloop
Min:
	l.s $f3, MIN
	li $t8, 0
	la $t2,($s1)
	MinLoop:
		beq $t8, $s0, DisplayMin
		addi $t8, $t8, 1
		l.s $f4, ($t2)#cannot store float from given adress ---> it changes the values to 0.
		c.lt.s $f3, $f4
		addi $t2, $t2, 4
		bc1t MinLoop
	MinChange:
		mov.s $f3, $f4 
		b MinLoop
	DisplayMin:
		mov.s $f12, $f3
		li $v0, 2
		syscall
		b Endloop
Sum:
	l.s $f12, ZERO
	la $t0, ($s1)
	li $t9, 0
	SumLoop:
		beq $t9,$s0, PrintSum
		l.s $f1, ($t0)
		add.s $f12, $f1,$f12
		addi $t0, $t0, 4
		addi $t9, $t9, 1
		b SumLoop
	PrintSum:
		li $v0,2
		syscall
		b Endloop
		
	
Diff:
	l.s $f5, MAX
	li $t8, 0
	la $t2,($s1)
	MaxLoop2:
		beq $t8, $s0, MinLoop2
		addi $t8, $t8, 1
		l.s $f4, 0($t2) #cannot store float from given adress ---> it changes the values to 0.
		c.lt.s $f5, $f4
		addi $t2, $t2, 4
		bc1t MaxChange2
	MaxChange2:
		mov.s $f5, $f4
		b MaxLoop2
	l.s $f3, MIN
	li $t8, 0
	la $t2,($s1)
	MinLoop2:
		beq $t8, $s0, Difference
		addi $t8, $t8, 1
		l.s $f4, ($t2)#cannot store float from given adress ---> it changes the values to 0.
		c.lt.s $f3, $f4
		addi $t2, $t2, 4
		bc1t MinLoop2
	MinChange2:
		mov.s $f3, $f4 
		b MinLoop2
	Difference:
		sub.s $f12, $f5, $f3
		li $v0, 2
		syscall
		b Endloop
		
	
Exit:
 li $v0, 10
 syscall
