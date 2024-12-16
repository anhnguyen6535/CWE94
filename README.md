# About 
This program is a simple demonstration of code and an attack exploiting CWE 94: Improper Control of Generation of Code ('Code Injection'). Since this is a concept that involved various types of attacks such as CWE-79 (Cross-Site Scripting), CWE-78 (OS Command Injection), CWE-89 (SQL Injection), and CWE-918 (Server-Side Request Forgery). We decided to focus on exploring SQL Injection in our code and attack part.


# How to run our project
```
1. Install local server XAMPP: https://www.apachefriends.org/
2. If the installer warns about UAC, do not install it in C:\Program Files choose something like C:\xampp instead.
3. Run XAMPP Control Panel: automatically open once installed or can be found at <saved_location>xampp-control.exe
4. Start Apache and MySQL
5. Go to <saved_location>/htdocs, delete everything
6. Copy this project folder there
7. Access the website at http://localhost/MyWeb/
```

## To log in, use any normal user credentials below
```
username: admin
password: sup3rP@ssw0rd
```
```
username: emmajohnson
password: password
```
```
username: w3ird_buddy
password: password
```

## How to attack?
To access user with id 2, put the following phase in username:
```
' OR id = 2 #
```
and anything in password.
Click Login to access their personal account. 


# How does it work?
Once the user click log in, the program check for their username and password in the database using a SQL command.
```
$sql = "SELECT * FROM users WHERE username = '$username' AND pwd = '$pwd'"; 
```
When using the attack input, the first single quote `'` got combined with the opening quote creating an empty username. OR is now treated as an operator and injected `id = 2` to the sql command. This code make the program search for user with id = 2. Then `#` symbol make the rest of the command which checks password become comment line to bypass checking. Thus, the sql commnad return the user with id 2 and grant the attacker access to this person's account. From here they can view important information about the user.

# Other potential attacks
1. Get some information about the database for example: number of column in the table:
```
' UNION SELECT NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL  #
```
If number of NULL doesnt match the number of columns, the page will print out error with the exact reason. Attacker can try and error to find out the correct number.

2. Access account by guessing username `admin'#`