<?php

require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/UserMachine.php";
require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/User.php";
require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/Car.php";
require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/Order.php";

$dbhost = "localhost"; 			// Имя хоста БД
$dbusername = "root"; 			// Пользователь БД
$dbpass = ""; 					// Пароль к базе
$dbname = "db"; 				// Имя базы

$mysqli = @new mysqli($dbhost, $dbusername, $dbpass,$dbname);
if ($mysqli->connect_error) {
    die('Connect Error: ' . $mysqli->connect_error);
}

UserMachine::SetMysqli($mysqli);
User::SetMysqli($mysqli);
Car::SetMysqli($mysqli);
Order::SetMysqli($mysqli);

?>