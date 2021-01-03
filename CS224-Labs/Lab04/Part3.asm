.data
EntDim: .asciiz "Enter Dimension\n"
EntElem: .asciiz "Enter Elements\n"
MenuEntr: .asciiz "\n\nSellect Action:\n"
Menu1: .asciiz "1.Create a martix\n"
Menu2: .asciiz "2. Display Matrix\n"
Menu3: .asciiz "3. Add another Matrix\n"
Menu4: .asciiz "4. Get Transpose\n"
Menu5: .asciiz "5. Get Symmetric\n"
Menu6: .asciiz "6. Exit\n"
Error: .asciiz  "Wrong entry. Try again\n"
NewLine: .asciiz "\n"
tab: .asciiz "\t"
EntDimofSecondArray: .asciiz "Enter Dimension of second array\n"
EntElemofSecondArray: .asciiz "Enter Elements of the second array\n"
ErrorSecondArrayNotEqual: .asciiz "The dimentions are different going back to the Menu"
.text
# get dimension
Menu:
	la $a0, MenuEntr
	li $v0, 4
	syscall
	la $a0, Menu1
	li $v0, 4
	syscall
	la $a0, Menu2
	li $v0, 4
	syscall
	la $a0, Menu3
	li $v0, 4
	syscall
	la $a0, Menu4
	li $v0, 4
	syscall
	la $a0, Menu5
	li $v0, 4
	syscall
	la $a0, Menu6
	li $v0, 4
	syscall
	li $v0, 5
	syscall
	beq $v0, 1, CreateArray
	beq $v0, 2, Display
	beq $v0, 3, Addition
	beq $v0, 4, Transpose
	beq $v0, 5, Symetric
	beq $v0, 6, Exit
	la $a0, Error
	li $v0, 4
	syscall
	b Menu
	
CreateArray:
	la $a0, EntDim
	li $v0, 4
	syscall
	li $v0, 5
	syscall
	move $s0, $v0 #s0 is the dimension
	mul $a0, $s0, $s0
	mul $a0, $a0, 4
	li $v0, 9
	syscall
	move $s1, $v0 #s1, is the  array loc.
	li $t0, 0
	mul $t1, $s0, $s0
	la $t2, ($s1)
	ArrayFill: 
		beq $t0, $t1, Menu
		la $a0, EntElem
		li $v0, 4
		syscall
		li $v0, 6
		syscall
		s.s $f0, 0($t2)
		addi $t2, $t2,4
		addi $t0, $t0, 1
		b ArrayFill

Display:
	li $t9, 1 #counter 
	la $t7, ($s1)
	mul $t6, $s0, $s0
	addi $t6, $t6, 1
	DispLoop:
		beq $t9, $t6, Menu
		divu $t8, $t9, $s0
		mfhi $t8
		l.s $f12, 0($t7)
		li $v0, 2
		syscall
		la $a0, tab
		li $v0, 4
		syscall
		addi $t7, $t7, 4
		addi $t9, $t9, 1
		beqz $t8, NextLine
		b DispLoop
		NextLine:
			la $a0, NewLine
			li $v0, 4
			syscall
			b DispLoop

Addition:
	la $a0, EntDimofSecondArray
	li $v0, 4
	syscall
	li $v0, 5
	syscall
	bne $v0, $s0, ErrorAddition
	la $t9, ($s1)
	li $t8, 0
	mul $t7, $s0, $s0
	LoopAddition:
		beq $t8, $t7, Menu
		l.s $f12, 0($t9)	
		la $a0, EntElemofSecondArray
		li $v0, 4
		syscall
		li $v0, 6
		syscall 
		add.s $f12, $f0, $f12
		s.s $f12, 0($t9)
		addi $t9, $t9, 4
		addi $t8, $t8, 1
		b LoopAddition
	ErrorAddition: 
		la $a0, ErrorSecondArrayNotEqual
		li $v0, 4
		syscall
		b Menu
Transpose:
Symetric:
Exit: 
	li $v0, 10
	syscall
	

# 
#
#
#
#
