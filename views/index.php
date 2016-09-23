<?php
require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/UserMachine.php";
require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/User.php";

if(isset($_COOKIE['ssid'])){
	$res=UserMachine::checkCookie($_COOKIE['ssid']);
 	if(empty($res)){ header('Location:/serviceStation');	}
}else {
	 header('Location: /serviceStation');
	 die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../style/viewStyle.css">
</head>
<body>
<div id="background"></div>
<header>
<form id="search" method="GET" action="index.php">
	<input  type="search" name="search" placeholder="Ivanova Anna">
	<button type="submit" name="searchButton" value="find"><img src="../image/search.jpg" alt="find"></button>
</form>
<form id="exit" method="POST" action="index.php">
	<input class="submit" type="submit" name="exit" value="Log out">
	<?php
	if (isset($_POST['exit']) && $_POST['exit']!==""){
		userMachine::logOut();
	}
	?>
</form>
</header>
<div id="response">
<?php
if (isset($_GET) && !empty($_GET['searchButton'])){
	$response=UserMachine::search($_GET['search']);
	if (!empty($response)){
		foreach ($response as $key => $value){
			$id=$value['id'];
			echo "<li>
				  <a href='cars.php?id=".$id."'>{$value['firstName']} {$value['lastName']}</a>
				  <ul>
					  <li><p class='name'>Date of birth:</p><p>{$value['dateOfBirth']}</p></li>
					  <li><p class='name'>Address:</p><p>{$value['address']}</p></li>
					  <li><p class='name'>Phone:</p><p>{$value['phone']}</p></li>
					  <li><p class='name'>Email:</p><p>{$value['email']}</p></li>
				  </ul>
			  	  </li>";
		}
	}else {
		echo "<p class='notFound'>User isn't found!</p>";
	}
}
	$arr=UserMachine::getList();
?>
</div>
<div id="connect">
	<div id="container">
	<p class="addUser">Add a new user</p>
	<form id="addUser" method="POST" action="index.php">
		<label>First name:</label><input type="text" name="firstName" placeholder="First name" required>
		<label>Last Name:</label><input type="text" name="lastName" placeholder="Last name" required>
		<label>Date of birth:</label><input type="date" name="dateOfBirth"  required>
		<label>Address:</label><input type="text" name="address" placeholder="Address">
		<label>Phone: </label><input type="number" name="phone" placeholder="+375 29 111 11 11 " required>
		<label>Email:</label><input type="email" name="email" placeholder="example@com" >
		<input class="submit" type="submit" name="submit" value="add">
	</form>
	</div>
<?php
if (isset($_POST) && !empty($_POST['firstName'])){
	$user = new User();
	$user->AllSetter($_POST['firstName'],$_POST['lastName'],$_POST['dateOfBirth'],$_POST['address'],trim($_POST['phone']),$_POST['email']);
}
?>
<div id="list">
	<p>List of all users:</p>
	<p class="sub">Follow a user's link to review cars and orders. </p>
	<div>
		<ul>
		<?php
			if (!empty($arr)){
				foreach ($arr as $key => $value){
					$id=$value['id'];
					echo "<li><a href='cars.php?id=".$id."'>{$value['firstName']}  {$value['lastName']}</a></li>";
				}
			}	
		?>
		</ul>
	</div>
</div>
</div>
</body>
</html>