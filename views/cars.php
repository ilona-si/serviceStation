<?php
require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/Car.php";
require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/Order.php";
require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/User.php";

if(isset($_COOKIE['ssid'])){
	$res=UserMachine::checkCookie($_COOKIE['ssid']);
 	if(empty($res)){ header('Location:/serviceStation');	}
}else {
	 header('Location: /serviceStation');
	 die();
}
if (isset($_GET) && !empty($_GET['id'])){
	$user=new User($_GET['id']);
	$idUser=$_GET['id'];
	$firstName = $user->getFirstName();
	$LastName = $user->getLastName();
	$str = "$firstName $LastName";
	}else{
		die();
}
if (isset($_POST)){
	if (!empty($_POST['make1'])) {
		$car=new Car();
		$car->AllSetter($_POST['model1'],$_POST['make1'],$_POST['year1'],$_POST['VIN1'],$idUser);
	}
	if (!empty($_POST['save'])) {
		$car=new Car($_POST['save']);
		$car->AllSetter($_POST['model'],$_POST['make'],$_POST['year'],$_POST['VIN'],$idUser);
		$car->editCar();
	}
	if (!empty($_POST['delete'])){
		$car=new Car($_POST['delete']);
		$t=$car->checkStatus();
		if($t===true){
			$car->deleteCar();
		}else{
			echo "<p style='color: red'>$t</p>";
		}
		
	}
	if (!empty($_POST['exit'])) {
		userMachine::logOut();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../style/cars.css">
	<script type="text/javascript" src="../modules/script.js"></script>
</head>
<body>
<div id="background"></div>
<header>
<p><span><?=$str?>,</span>  cars:</p>
<p id="back"><a href="index.php"> Home</a></p>
<form method="POST" action="cars.php">
	<button id="exit" type="submit" name="exit" value="Log out">Log out</button>
</form>
	</header>
<div id="container">

<ul id="containerUL">
<?php
if (isset($_GET) && !empty($_GET['id'])){
	$user=new User($_GET['id']);
	$cars=$user->getList($_GET['id']);
	if (!empty($cars)){
		foreach ($cars as $key => $value){
			$id=$value['id'];
			$car=new Car($id);
			$orders=$car->getList($id);
			if (!empty($orders)){
				$countOrders = count($orders);
			}else{$countOrders = 0;}

			echo "<li>
				  <ul  id='data".$key."' class='data' >
				 	  <li><p class='name'>Make:</p><p>{$value['make']}</p></li>
				  	  <li><p class='name'>Model:</p><p>{$value['model']}</p></li>
				 	  <li><p class='name'>Year:</p><p>{$value['year']}</p></li>
					  <li><p class='name'>VIN:</p><p>{$value['VIN']}</p></li>
					  <li><p class='name' ><a href='orders.php?id=".$id."' class='color'>Orders:</a></p><p>{$countOrders}</p></li>
				  </ul>";
			  	 
			echo "<form  id='upButton".$key."'  method='POST' class='upButton'  > 
					   <button type='button' onclick='edit(".$key.")'>edit</button>
					   <button type='submit' name='delete' value='".$id."'>delete</button>
				  </form>";
		    echo "<form id='edit".$key."' class='edit' method='POST'>  
						<p>Edit:</p>
						<section>
							<input type='text' name='make' placeholder='make' value='{$value['make']}'>
							<input type='text' name='model' placeholder='model' value='{$value['model']}'>
							<input type='text' name='year' placeholder='year' value='{$value['year']}'>
							<input type='text' name='VIN' placeholder='VIN' value='{$value['VIN']}'>
						</section>
						<section class='button' id='button'>
							<button type='submit' name='save' value='".$id."'>save</button>
							<button type='button' name='back' value='back' onclick='review(".$key.")'>back</button>
						</section>
			  	  </form></li>";
			}
	}else {
		echo "<p class='notFound'>There is no car!</p>";
	}
}
?>
</ul>
<form id="create" method="POST" action="">
	<label>Add a new car:</label>
	<input type="text" name="make1" placeholder="Make" required>
	<input type="text" name="model1" placeholder="Model" required>
	<input type="number" name="year1" placeholder="Year" required>
	<input type="text" name="VIN1" placeholder="VIN" required>
	<input  type="submit" name="addCar" value="Add car">
</form>
</div>
</body>
</html>