<?php
session_start();

// Create connection to database
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "sbank";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    // Find user input of username and password in the database
    $sql = "SELECT * FROM users WHERE username = '$username' AND pwd = '$pwd'"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Login successful!";

        // Store data to this session
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['address'] = $user['address'];
        $_SESSION['money'] = $user['money'];
        $_SESSION['account'] = $user['account'];

        // Go to next page
        header("Location: infoPage.php");
        exit();
    } else {
        echo "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>SBank - Crypto Wallet</title>
</head>
<body>
    <main>
        <h1>SBank - Crypto Wallet</h1>
        <form action="" method="post">
            <input required id="username" type="text" name="username" placeholder="Username...">
            <input required id="pwd" type="password" name="pwd" placeholder="Password...">

            <button type="submit">Login</button>
        </form>
    </main>
</body>
</html>

