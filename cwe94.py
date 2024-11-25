# Input to exploit cwe94: ' or __import__("os").system("echo Bad code executed!") or True or '
def check_password(user_input):
    print("Checking password...")

    password_check_code = f"'{user_input}' == 'admin1234'"  
    print(password_check_code)
    
    if eval(password_check_code): 
        return True
    return False

if __name__ == "__main__":
    user_input = input("Enter password: ")
    if check_password(user_input):
        print("Access granted!")
    else:
        print("Access denied!")
