#here I assumed that we only need to print out the number of converted lowercase letters
.data 
str: .asciiz "hello World"
.text
la $t1, str
load:   lb $t0, ($t1)
    beq $t0, $zero, end
    ble $t0, 97, cont
    subi $t0,$t0, 32
    addi $a0, $a0, 1
    b cont
     
cont:   addi $t1, $t1, 1
    b load
     
end:    li $v0,1
    syscall
    li $v0,10
    syscall
