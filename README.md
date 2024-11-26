# About 
This program is a simple demonstration of code and an attack exploiting CWE 94: Improper Control of Generation of Code ('Code Injection').


# How to run
```
sh attack.sh | python cwe94.py
```
where `attack.sh` is:
```
echo -n "' or __import__(\"os\").system(\"echo Bad code executed!\") or True or '"
```
which inputs a predefined string when the program askes for password.

# How does it work?
`eval()` function is used to compare the user input and the actual password. The vulnerability arises because `eval()` allows arbitrary code execution as it executes any valid Python code in the string passed to it. This gives attackers the opportunity to inject malicious code into the password check process. 
In the attack input:
```
' or __import__("os").system("echo Bad code executed!") or True or '
```
This input is passed into:
`password_check_code = f"'{user_input}' == 'admin1234'"`

The resulting `password_check_code` will look like this:
```
'' or __import__("os").system("echo Bad code executed!") or True or '' == 'admin1234' 
```

The `eval()` function treats `or` as an operator, so the code first checks the empty string `''`, then executes the malicious code.
It then check the next phrase which is `True`, causes the program to immediately returns `True`, bypassing the checking.
This example demonstrates not only how malicious code can be injected into the system, but also how an attacker can manipulate the input to bypass security checks.

# How to prevent this?
1. Avoid using `eval()` especially with untrusted input. If dynamic evaluation is necessary, consider using safer alternatives like `ast.literal_eval()` for evaluating simple literals or avoid dynamic code evaluation altogether. [source](https://stackoverflow.com/questions/15197673/using-pythons-eval-vs-ast-literal-eval)

2. Sanitize input: ensure the input is sanitized and only safe expressions are evaluated.

# Example of solution:
```
def check_password(user_input):
    print("Checking password...")
    if user_input == 'admin1234':
        return True
    return False
```
