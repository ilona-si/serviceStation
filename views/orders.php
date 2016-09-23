<?php
require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/Car.php";
require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/Order.php";

if(isset($_COOKIE['ssid'])){
	$res=UserMachine::checkCookie($_COOKIE['ssid']);
 	if(empty($res)){ header('Location:/serviceStation');	}
}else {
	 header('Location: /serviceStation');
	 die();
}

if (isset($_GET) && !empty($_GET['id'])){
	$car=new Car($_GET['id']);
	$idCar=$_GET['id'];
	$make = $car->getMake();
	$model = $car->getModel();
	$str = "$make $model";
	}else{
		die();
}
if (isset($_POST)){
	if (!empty($_POST['makeOrder'])){
		$order=new Order();
		$order->AllSetter($_POST['date'],$_POST['amount'],$_POST['status'],$idCar);
	}
	if (!empty($_POST['save'])) {
		$order=new Order($_POST['save']);
		$order->AllSetter($_POST['date'],$_POST['amount'],$_POST['status'],$idCar);
		$order->editOrder();
	}
	if (!empty($_POST['delete'])){
		$order=new Order($_POST['delete']);
		$order->deleteOrder();
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
	<link rel="stylesheet" type="text/css" href="../style/orders.css">
	<script type="text/javascript" src="../modules/script.js"></script>
</head>
<body>
<div id="background"></div>
<header>
	<p>   <span>  <?=$str?>,</span> orders:</p>
	<p id="back"><a href="index.php"> Home</a></p>
	<form method="POST" action="profile.php">
		<button id="exit" type="submit" name="exit" value="Log out">Log out</button>
	</form>
</header>

<div id="container">

<ul id="containerUL">
<?php
if (isset($_GET) && !empty($_GET['id'])){
	$car=new Car($_GET['id']);
	$orders=$car->getList($_GET['id']);
	if (!empty($orders)){
		foreach ($orders as $key => $value){
			$id=$value['id'];
			$order=new Order($id);
			$status=$order->status($value['status']);
			$checked=$order->checked($value['status']);
			echo "<li>
				  <ul  id='data".$key."' class='data' >
				  	  <li><p class='name'>Date:</p><p>{$value['date']}</p></li>
					  <li><p class='name'>Order Amount:</p><p>{$value['amount']}</p></li>
			    	  <li><p class='name'>Order Status:</p><p>$status</p></li>
				  </ul>";
			  	 
			echo "<form  id='upButton".$key."'  method='POST' class='upButton'  > 
					   <button type='button' onclick='edit(".$key.")'>edit</button>
					   <button type='submit' name='delete' value='".$id."'>delete</button>
				  </form>";
		    echo "<form id='edit".$key."' class='edit' method='POST'>  
						<p>Edit:</p>
						<section>
							<input type='data' name='date' placeholder='date' value='{$value['date']}'>
							<input type='number' min='0' max='10000' name='amount' placeholder='amount' value='{$value['amount']}'>
							<section class='subEdit'>".$checked."</section>
						</section>
						<section class='button' id='button'>
							<button type='submit' name='save' value='".$id."'>save</button>
							<button type='button' name='back' value='back' onclick='review(".$key.")'>back</button>
						</section>
			  	  </form></li>";
			}
	}else {
		echo "<p class='notFound'>There is no order!</p>";
	}
}
?>
</ul>
<form id="create" method="POST" action="">
	<label>Make an order:</label>
	<input type="date" name="date" placeholder="date" required>
	<input type="number" min="0" max="10000" name="amount" placeholder="amount $ (0-10 000)" required="">
	<section id="subCreate">
		<p><input type="radio" name="status" value="<?=Order::COMPLETED?>"><label>Completed</label></p>
		<p><input type="radio" name="status" value="<?=Order::IN_PROGRESS?>" checked><label>In Progress</label></p>
		<p><input type="radio" name="status" value="<?=Order::CANCELLED?>"><label>Cancelled</label></p>
	</section>
	<input  type="submit" name="makeOrder" value="Make an order">
</form>
</div>
</body>
</html>