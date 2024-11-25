# About 
This program is a simple code and attack demonstrating CWE 94.


# How to run
```
python cwe94.py
```

# Input to exploit
```
' or __import__("os").system("echo Bad code executed!") or True or '
```

# How does it work?
`eval()` function is used to compare the user input and the actual password. The vulnerability arises because `eval()` allows arbitrary code execution as it executes any valid Pythonn code in the string passed to it. This presents an opportunity for an attacker to inject malicious code into the password check process. 
In the attack input:
```
' or __import__("os").system("echo Bad code executed!") or True or '
```
This input is passed into:
`password_check_code = f"'{user_input}' == 'admin1234'"`

`password_check_code` will look like this: 
```
'' or __import__("os").system("echo Bad code executed!") or True or '' == 'admin1234' 
```

The code will treat or as an operator and thus after checking the empty '', it executes the bad code.
It then check the next phrase which is `True`. For optimization, program will stop at the first True making the whole input true and bypass the checking.
This program not only demonstrate how bad code is injected but also show that the hacker can access to the program by manipulating the input.

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
