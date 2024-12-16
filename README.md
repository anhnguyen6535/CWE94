# About 
This program is a simple demonstration of attack exploiting CWE 94: Improper Control of Generation of Code ('Code Injection'). This concept includes several attack types, such as: CWE-79 (Cross-Site Scripting), CWE-78 (OS Command Injection), CWE-89 (SQL Injection), and CWE-918 (Server-Side Request Forgery). For this project, we focus specifically on exploring SQL Injection through both the code and the attack process.

## How to run the project online (recommended)
Visit [here](http://147.182.249.239/MyWeb/)

#### note: if you can access it online, skip the next part.

## How to compile and run the project locally
1. Install local server XAMPP: https://www.apachefriends.org/
2. During installation:
- if the installer warns about UAC, avoid installing in `C:\Program Files`. Instead, choose a directory like `C:\xampp`.
3. Lauch XAMPP Control Panel: 
- It will open automatically or can be found at <saved_location>xampp-control.exe
- Start **Apache** and **MySQL**
5. Navigate to <saved_location>/htdocs, delete all contents.
6. Copy folder `MyWeb` into the `htdocs` directory.
7. Access the website at http://localhost/MyWeb/


## Login Credentials
You can use the following credentials to log in as a regular user:
| **Username**    | **Password**        |
|------------------|---------------------|
| `admin`         | `sup3rP@ssw0rd`     |
| `emmajohnson`   | `password`          |
| `w3ird_buddy`   | `password`          |

## How to attack?
To exploit and access the account of a user with `id = 2`, use the following SQL injection input:
- Username:
```
' OR id = 2 #
```
- Password: any value

Click **Login** to access their personal account. 


## How does the attack work?
When a user clicks "Login," the program checks their credentials against the database using the following SQL command:
```php
$sql = "SELECT * FROM users WHERE username = '$username' AND pwd = '$pwd'"; 
```
When using the attack input:
- The first single quote `'` got combined with the opening quote of the `username` field, creating an empty username. 
- The OR operator allows injecting a condition `id = 2` into the SQL command. 
- The `#` symbol comments out the remaining part of the query, bypassing password verification.
As a result, the query is modified to: 
```sql
SELECT * FROM users WHERE username = '' OR id = 2 # AND pwd = '';
```

## Other potential attacks
1. Determine the Structure of the Database
```
' UNION SELECT NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL  #
```
- If the number of NULL values does not match the number of columns, the page will throw an error indicating the mismatch.
- An attacker can adjust the number of NULL values iteratively to discover the correct structure.

2. Access account by guessing username

Use the following to bypass password validation by guessing usernames:
```
<username>'#
```

For example: `admin'#` 

This input sets the username to admin and comments out the password verification, allowing access to the admin account.
