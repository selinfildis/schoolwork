
.data 
str: .asciiz "142"

.text
la $t1, str
load:	lb $a0, ($t1)
	beq $a0, $zero, end
	subi $a0, $a0, 48
	li $v0, 1
	syscall
	addi $t1, $t1, 1
	b load
end:
	li $v0,10
	syscall
