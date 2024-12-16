<?php
session_start();

// Reset session once logged out
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_destroy(); 
    header("Location: index.php");  
    exit();
}

// Only accessible if logged in
if(!isset($_SESSION['username'])){
    echo $_SESSION['username'];
    echo "Please log in!";
    exit();
}

// Get vars from session storage
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$email = $_SESSION['email'];
$address = $_SESSION['address'];
$money = $_SESSION['money'];
$account = $_SESSION['account'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="infoPage.css">
    <title>SBank</title>
</head>
<body>
    <div class="navbar">
        <div class="logo">SBank</div>
        <form action="" method="post">
            <button class="logout-btn" type="submit">Logout</button>
        </form>
    </div>

    <div class="content">
        <h2>Welcome back! <?php echo $firstname, ' ', $lastname; ?></h2>
        <h3>Account number: <?php echo $account; ?></h3>
        <h3>Email: <?php echo $email; ?></h3>
        <h3>Address: <?php echo $address; ?></h3>
        <h3>You have $<?php echo $money; ?> CAD in your crypto account.</h3>
    </div>
</body>
</html>