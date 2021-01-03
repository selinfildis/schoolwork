.text
.globl start
start:
func2:
    	li $v0, 5
    	syscall
    	la $a0, 0($v0)
    	#li $v0, 35 #to check if convention is correct
    	#syscall
    	la $a1, array
    	la $t4, array
    	addi $t4, $t4, 124
    	li $t1, 32
    	li $t6, 32
   
     
loop:   
	beq $t1, $zero, print
   	div  $a0, $a0, 2
   	mfhi $t3
   	sw $t3, 0($t4)
    	subi $t1, $t1, 1
    	subi $t4, $t4, 4
    	b loop
     
print:  ble $t6, $zero, end
    	lw $a0, 0($a1)
   	li $v0, 1
   	syscall
    	addi $a1,$a1,4
   	subi $t6, $t6, 1
    	b print
     
end:    li $v0, 10
    	syscall
     
     
.data
array: .space 128
