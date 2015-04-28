<?php
// filename: Login.php, Jory Lord, cis355, 2015-02-26
// Paints the login and checks to see if user is valid user

// ----- Connect to database -----
require 'database.php';
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{

// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// SQL query to fetch information of registerd users and finds user match.
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM login WHERE password='$password' AND username='$username'";
$q = $pdo->prepare($sql);
$q->execute(array($password, $username));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();
echo $data['username'];
if ((!empty($data['password'])) && (!empty($data['username']))) {
$_SESSION['login_user'] = $data['username']; // Initializing Session
header("location: index.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
}
}
?>
<!DOCTYPE html>
<!--Paints the login screen -->
<html>
<head>
<title>Login to see Clash of Clans Users</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
<h1>Login to see Clash of Clans Users</h1>
<div id="login">
<h2>Login Form</h2>
<form action="" method="post">
<label>UserName :</label>
<input id="username" name="username" placeholder="username" type="text">
<label>Password :</label>
<input id="password" name="password" placeholder="password" type="password">
<input name="submit" type="submit" value=" Login ">
<span><?php echo $error; ?></span>
</form>
</div>
</div>
</body>
</html>
	
