lw $t1, 1
lw $t2, 0
lw $t3, 6
part1: add $t2, $t2, $t1
       addi $t1, $t1, 1
       beq $t2, $t3, end1
       b part1
end1: addi $v0, $t2, 0

lw $t1, 5
lw $t2, 6
lw $t3, 0
lw $t4, 0
part2: add $t3, $t3, $t1
       addi $t4, $t4, 1
       beq $t4, $t2, end2
       b part2
end2: addi $v0, $t3, 0

lw $t1, 10
lw $t2, 3
lw $t3, 2
lw $t4, 0
part3: sub $t1, $t1, $t2
       addi $t4, $t4, 1
       bge $t1, $t3, part3
       addi $v0, $t1, 0
       addi $v1, $t4, 0
