<?php

require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/UserMachine.php";
require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/SQLConnection.php";

if(isset($_COOKIE['ssid'])){
	$res=UserMachine::checkCookie($_COOKIE['ssid']);
 	if(!empty($res)){
 		header('Location: views/index.php');
 		die();
 	}
}
if (!empty($_POST)){
	$return=UserMachine::check(trim($_POST['login']),md5(trim($_POST['password'])));
	if ($return===true){
		UserMachine::setCookie();
		header('Location: views/index.php');
		die();
	}else{
		echo $return;
	} 
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<div id="background"></div>
<div id="container">
	<p>Hello, admin!</p>
	<form method="POST" action="">
		<label>Login:</label>
		<input name="login" type="text" placeholder="Login" required>
		<label>Password:</label>
		<input name="password" type="password" placeholder="Password"  required><br>
		<input  class="submit" type="submit" value="Sign in">
	</form>
	<div id="message"></div>
</div>
</body>
</html>