import numpy as np

into = input("Enter the file name")
f = open(into, 'r')
numberofnodes = f.readline()
if numberofnodes == "[num_nodes]":
    numberofnodes = f.readline()
    edgebeg = False
    A = np.zeros(shape=(int(numberofnodes), int(numberofnodes)))
    m = np.asmatrix(A)
    for line in f:
        if line == "[edges]":
            edgebeg = True
            break
    if edgebeg:
        for line in f:
            first = int(line[:1])
            last = int(line[-1:])
            m[first][last] = 1
            m[last][first] = 1
fo = open('output', 'w')
fo.write("Adajency Matrix:\n")
fo.write(m.dumps())


len = input("Enter the length of the path")
len = int(len)

lenMatrix = m**len
print 'paths: \n'
print lenMatrix.dumps()

fo.write("Paths Algorithm according to given number of paths: " + len + "\n")
fo.write(m.dumps())

f.close()
fo.close()



