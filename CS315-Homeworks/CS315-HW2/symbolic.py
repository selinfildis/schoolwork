import operator


def main():
    x = Var("x")
    y = Var("y")
    z = Var("z")
    e = 3 + (x + 2 * y) * z;
    
    print evaluate(x, x=3)
    print evaluate(e, **{"x":3, "y":4, "z":2})
    print evaluate(e, x=3, y=-1, z=4)
    print
    
    print e.string() 
    print e.desc()
    print
    
    print x.string() 
    print x.desc()
    print
    
    print (x+3).string() 
    print (x+3).desc()
    print
    
    print (3+x).string() 
    print (3+x).desc()
    print
    
    print (y*(x+1)).string()
    print (y*(x+1)).desc()
    print
    
    print ((x+1)*y).string()
    print ((x+1)*y).desc()
    print
    
    print (x*y+3).string()
    print (x*y+3).desc()
    print
    
    print (x+y+3).string()
    print (x+y+3).desc()
    print
    
    print ((x+y)+3).string()
    print ((x+y)+3).desc()
    print
    
    print x+(y+3).string()
    print x+(y+3).desc()
    print

    print (x+y)*(3+x).string()
    print (x+y)*(3+x).desc()
    print

    print ((4 + 3 * x) * 3 + 5).string()
    print ((4 + 3 * x) * 3 + 5).desc()
    print

    # test for sub
    print (x-2).string()
    print (x-2).desc()
    print

    # test for rsub
    print (2 - x).string()
    print (2 - x).desc()
    print

    # test for div
    print (x / 2).string()
    print (x / 2).desc()
    print

    # test for rdiv
    print (2 / x).string()
    print (2 / x).desc()
    print

    # test for multiple variables
    print ((2 - y) / x).string()
    print ((2 - y) / x).desc()
    print

    print ((y - x) / x).string()
    print ((y - x) / x).desc()
    print

    print ((z - x) / y).string()
    print ((z - x) / y).desc()
    print

    print ((x - 2 - y) / x).string()
    print ((x - 2 - y) / x).desc()
    print

    # derivatives
    print derivative(x * y, x).string()
    print derivative(x * y, x).desc()
    print

    # Additional Derivative Tests
    print derivative((x-3) * x * y, x).string()
    print derivative((x-3) * x * y, x).desc()
    print

    print derivative((x - 3) * x / (y * (3 - x)), x).string()
    print derivative((x - 3) * x / (y * (3 - x)), x).desc()
    print



def derivative(expr, var):
    if isinstance(expr, int):
        return LiteralExpr(0)
    return expr.derivative(var)


def evaluate(expr, **namedValues):
    return expr.eval(namedValues)


class Expr:
    def eval(self, values):
        raise NotImplementedError()

    def desc(self):
        raise NotImplementedError()

    def string(self):
        raise NotImplementedError()


class VarExpr(Expr):
    def __init__(self, var):
        self.var = var

    def eval(self, values):
        return values[self.var.getName()]

    def desc(self):
        return "VarExpr("+self.var.desc()+")"

    def string(self):
        return self.var.getName()

    def derivative(self, var):
        return self.var.derivative(var)


class LiteralExpr(Expr):
    def __init__(self, val):
        self.val = val

    def eval(self, values):
        return self.val

    def desc(self):
        return "LiteralExpr("+str(self.val)+")"

    def string(self):
        return str(self.val)

    def derivative(self, var):
        return LiteralExpr(0)


def opToSign(op):
    if op == operator.__add__:
        return "+"
    if op == operator.__mul__:
        return "*"
    if op == operator.__sub__:
        return "-"
    if op == operator.__div__:
        return "/"
    raise NotImplementedError()


def opToPrecedence(op):
    if op == operator.__add__:
        return 0
    if op == operator.__mul__:
        return 1
    if op == operator.__sub__:
        return 0
    if op == operator.__div__:
        return 1
    raise NotImplementedError()


class BinaryExpr(Expr):
    def __init__(self, op, lhs, rhs):
        self.op = op;
        self.lhs = lhs
        self.rhs = rhs

    def __add__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__add__, self, LiteralExpr(val))
        elif isinstance(val, Var):
            return BinaryExpr(operator.__add__, self, VarExpr(val))
        else:
            return BinaryExpr(operator.__add__, self, val)

    def __radd__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__add__, LiteralExpr(val), self)
        elif isinstance(val, Var):
            return BinaryExpr(operator.__add__, VarExpr(val), self)
        else:
            return BinaryExpr(operator.__add__, val, self)

    def __mul__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__mul__, self, LiteralExpr(val))
        elif isinstance(val, Var):
            return BinaryExpr(operator.__mul__, self, VarExpr(val))
        else:
            return BinaryExpr(operator.__mul__, self, val)

    def __rmul__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__mul__, LiteralExpr(val), self)
        elif isinstance(val, Var):
            return BinaryExpr(operator.__mul__, VarExpr(val), self)
        else:
            return BinaryExpr(operator.__mul__, val, self);
    
    def __sub__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__sub__, self, LiteralExpr(val))
        elif isinstance(val, Var):
            return BinaryExpr(operator.__sub__, self, VarExpr(val))
        else:
            return BinaryExpr(operator.__sub__, self, val)

    def __rsub__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__sub__, LiteralExpr(val), self)
        elif isinstance(val, Var):
            return BinaryExpr(operator.__sub__, VarExpr(val), self)
        else:
            return BinaryExpr(operator.__sub__, val, self)

    def __div__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__div__, self, LiteralExpr(val))
        elif isinstance(val, Var):
            return BinaryExpr(operator.__div__, self, VarExpr(val))
        else:
            return BinaryExpr(operator.__div__, self, val)

    def __rdiv__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__div__, LiteralExpr(val), self)
        elif isinstance(val, Var):
            return BinaryExpr(operator.__div__, VarExpr(val), self)
        else:
            return BinaryExpr(operator.__div__, val, self);

    def derivative(self, val):
        # simple derivation
        if self.op is operator.__add__ or self.op is operator.__sub__:
            return BinaryExpr(self.op, self.lhs.derivative(val), self.rhs.derivative(val))

        # f(x)*g'(x)+f'(x)*g(x)
        if self.op is operator.__mul__:
            return BinaryExpr(operator.__add__, BinaryExpr(operator.__mul__, self.lhs, self.rhs.derivative(val)),
                              BinaryExpr(operator.__mul__, self.lhs.derivative(val), self.rhs))

        # (f'(x)*g(x) - f(x)g'(x)) / (g(x) * g(x))
        if self.op is operator.__div__:
            return BinaryExpr(operator.__div__, BinaryExpr(operator.__sub__,
                                                           BinaryExpr(operator.__mul__, self.lhs.derivative(val),
                                                                      self.rhs),
                                                           BinaryExpr(operator.__mul__, self.lhs,
                                                                      self.rhs.derivative(val))),
                              BinaryExpr(operator.__mul__, self.rhs, self.rhs))

    def eval(self, values):
        return self.op(self.lhs.eval(values), self.rhs.eval(values));

    def desc(self):
        return "BinaryExpr("+self.op.__name__+","+self.lhs.desc()+","+self.rhs.desc()+")"

    def string(self):
        res = "";
        if (isinstance(self.lhs, BinaryExpr) and 
            (opToPrecedence(self.lhs.op) < opToPrecedence(self.op))):
            res += "(" + self.lhs.string() + ")"
        else:
            res += self.lhs.string()
        res += opToSign(self.op)
        if (isinstance(self.rhs, BinaryExpr) and 
            (opToPrecedence(self.rhs.op) <= opToPrecedence(self.op))):
            res += "(" + self.rhs.string() + ")"
        else:
            res += self.rhs.string()
        return res


class Var:
    def __init__(self, name):
        self.name = name

    def getName(self):
        return self.name

    def __add__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__add__, VarExpr(self), LiteralExpr(val))
        elif isinstance(val, Var):
            return BinaryExpr(operator.__add__, VarExpr(self), VarExpr(val))
        else:
            return BinaryExpr(operator.__add__, VarExpr(self), val)

    def __radd__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__add__, LiteralExpr(val), VarExpr(self))
        elif isinstance(val, Var):
            return BinaryExpr(operator.__add__, VarExpr(val), VarExpr(self))
        else:
            return BinaryExpr(operator.__add__, val, VarExpr(self))

    def __mul__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__mul__, VarExpr(self), LiteralExpr(val))
        elif isinstance(val, Var):
            return BinaryExpr(operator.__mul__, VarExpr(self), VarExpr(val))
        else:
            return BinaryExpr(operator.__mul__, VarExpr(self), val)

    def __rmul__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__mul__, LiteralExpr(val), VarExpr(self))
        elif isinstance(val, Var):
            return BinaryExpr(operator.__mul__, VarExpr(val), VarExpr(self))
        else:
            return BinaryExpr(operator.__mul__, val, VarExpr(self))

    def __sub__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__sub__, VarExpr(self), LiteralExpr(val))
        elif isinstance(val, Var):
            return BinaryExpr(operator.__sub__, VarExpr(self), VarExpr(val))
        else:
            return BinaryExpr(operator.__sub__, VarExpr(self), val)

    def __rsub__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__sub__, LiteralExpr(val), VarExpr(self))
        elif isinstance(val, Var):
            return BinaryExpr(operator.__sub__, VarExpr(val), VarExpr(self))
        else:
            return BinaryExpr(operator.__sub__, val, VarExpr(self))

    def __div__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__div__, VarExpr(self), LiteralExpr(val))
        elif isinstance(val, Var):
            return BinaryExpr(operator.__div__, VarExpr(self), VarExpr(val))
        else:
            return BinaryExpr(operator.__div__, VarExpr(self), val)

    def __rdiv__(self, val):
        if isinstance(val, int):
            return BinaryExpr(operator.__div__, LiteralExpr(val), VarExpr(self))
        elif isinstance(val, Var):
            return BinaryExpr(operator.__div__, VarExpr(val), VarExpr(self))
        else:
            return BinaryExpr(operator.__div__, val, VarExpr(self))

    def derivative(self, val):
        if self.getName() is val.getName():
            return LiteralExpr(1)
        else:
            return LiteralExpr(0)

    def eval(self, values):
        return values[self.name]

    def desc(self):
        return "Var("+self.name+")"   

    def string(self):
        return self.name
    
if __name__ == '__main__':
    main()
