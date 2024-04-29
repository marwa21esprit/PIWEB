def point_fixe(f, x0, epsilon=1e-7, max_iter=1000):
    x = x0
    for i in range(max_iter):
        x_next = f(x)
        if abs(x_next - x) < epsilon:
            return x_next, i + 1
        x = x_next
    return None, max_iter

def g(x):
    return x**2 - 3

def f(x):
    return x - 9 * x
def point_fixe_relaxation(f, x0, w, epsilon=1e-7, max_iter=1000):
    x = x0
    for i in range(max_iter):
        x_next = w * f(x) + (1 - w) * x
        if abs(x_next - x) < epsilon:
            return x_next, i + 1
        x = x_next
    return None, max_iter

# Test de la méthode du point fixe avec relaxation pour différentes valeurs de w et x0
for i in range(1, 11):
    w = i / 10
    result, iterations = point_fixe_relaxation(f, 1, w)
    if result is not None:
        print("La méthode converge avec w =", w, "après", iterations, "itérations. Résultat :", result)
    else:
        print("La méthode n'a pas convergé avec w =", w, "après", iterations, "itérations.")


def newton(g, dg, x0, epsilon=1e-7, max_iter=1000):
    x = x0
    for i in range(max_iter):
        dx = - g(x) / dg(x)
        x += dx
        if abs(dx) < epsilon:
            return x, i + 1
    return None, max_iter

def dg(x):
    return 2 * x


result, iterations = newton(g, dg, 1)
if result is not None:
    print("La méthode converge avec x0 = 1 après", iterations, "itérations. Résultat :", result)
else:
    print("La méthode n'a pas convergé avec x0 = 1 après", iterations, "itérations.")