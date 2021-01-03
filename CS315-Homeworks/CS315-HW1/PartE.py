#!/usr/bin/env python
import random
import time


class Account:
    def __init__(self, id, name, balance):
        self.id = id
        self.name = name
        self.balance = balance

    def __str__(self):
        return "[id:%d, name: %s, balance: %s]" % (self.id, self.name, self.balance)

    def getId(self):
        return self.id

    def getName(self):
        return self.name

    def getBalance(self):
        return self.balance

    def withdraw(self, amount):
        self.balance -= amount
        return self.balance

    def deposit(self, amount):
        self.balance += amount
        return self.balance


def generateRandomAccounts(n):
    accounts = []
    nameLen = 5
    balanceMax = 1000
    alpha = 'abcdefghijklmnopqrstuvwxyz'
    for id in xrange(1, n + 1):
        name = ""
        for i in xrange(0, nameLen):
            name += random.choice(alpha)
        if id == 1:
            print "First account name is '%s'" % name
        balance = random.choice(xrange(0, balanceMax))
        account = Account(id, name, balance)
        accounts.append(account)
    return accounts

# my part
def createNameMap(accounts):
    indices = dict()
    if __name__ == '__main__':
        for key in accounts:
            indices[key.getName()] = [key.getId()-1]
            # If we use dict inside this dict as well the above line of code would look as such:
            # indices[key.getName()] = {'id': key.getId(), 'name': key.getName(), 'balance': key.getBalance()}
    return indices
# end of createNameMap

start = time.time()
accounts = generateRandomAccounts(1000000)
end = time.time()
print "Accounts created in %f seconds" % (end-start)
start = time.time()
nameMap = createNameMap(accounts)  # Build a map to speed things up
end = time.time()
print "Name map created in %f seconds" % (end-start)

while True:
    name = raw_input("Account name: ")
    if name == "":
        print "Exiting..."
        break
    start = time.time()
    indices = nameMap.get(name, [])  # Fast dictionary lookup
    end = time.time()

    if len(indices)>0:
        for index in indices:
            print "> Account found: %s" % accounts[index]
    else:
        print "> No accounts found."
    print "Search took %f seconds" % (end-start)