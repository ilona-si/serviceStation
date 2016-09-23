<?php
require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/SQLConnection.php";

class Car
{
	private $id;
	private $model;
	private $make;
	private $VIN;
	private $year;
	private $idUser;
	private static $mysqli;

	function __construct($id=0){
		if ($id==0) {
			$query="INSERT INTO `car`( `make`, `model`, `year`, `VIN`, `idUser`) VALUES ('','','','','')";
			mysqli_query(self::$mysqli,$query);
			$q="SELECT MAX(id) from `car`";
			$res = mysqli_query(self::$mysqli,$q);
			$r=mysqli_fetch_assoc($res);
			$this->setId($r['MAX(id)']);
		}
		else{
			$query = "SELECT * from `car` WHERE id=$id ";
			$result = mysqli_query(self::$mysqli,$query);
			$row = mysqli_fetch_assoc($result);
			$this->setMake($row['make']);
			$this->setModel($row['model']);
			$this->setYear($row['year']);
			$this->setVIN($row['VIN']);
			$this->setIdUser($row['idUser']);
			$this->setId($id);	
		}
	}

	public static function SetMysqli($mysqli){
    	self::$mysqli=$mysqli;
    }
	public function setMake($make){
		$this->make=$make;
	}
	public function getMake(){
		return $this->make;
	}
	public function setModel($model){
		$this->model=$model;
	}
	public function getModel(){
		return $this->model;
	}
	public function setYear($year){
		$this->year=$year;
	}
	public function getYear(){
		return $this->year;
	}
	public function setVIN($VIN){
		$this->VIN=$VIN;
	}
	public function getVIN(){
		return $this->VIN;
	}
	public function getIdUser(){
		return $this->idUser;
	}
	public function setIdUser($idUser){
		$this->idUser=$idUser;
	}
	
	public function setId($id){
		$this->id=$id;
	}
	public function getId(){
		return $this->id;
	}
	public function submitChages(){
		$query="UPDATE `car` SET `make`='{$this->make}', `model`='{$this->model}', `year`='{$this->year}',`VIN`='{$this->VIN}',`idUser`={$this->idUser} WHERE id={$this->id} ";
		mysqli_query(self::$mysqli,$query);
	}
	public function AllSetter($model,$make,$year,$VIN,$idUser){
		$this->setModel($model);
		$this->setMake($make);
		$this->setYear($year);
		$this->setVIN($VIN);
		$this->setIdUser($idUser);
		$this->submitChages();
	}
	
	
	public function getList(){
		$query = "SELECT * FROM `order` WHERE idCar={$this->id}";
		$result = mysqli_query(self::$mysqli,$query);
		$res=array();
		while ($row = mysqli_fetch_assoc($result)){
			$res[] = $row;
		}
		return $res;
	}


	public  function addCar($make,$model,$year, $VIN, $idUser){
		$query = "INSERT INTO `car`(`make`, `model`, `year`, `VIN`, `idUser`) VALUES ($make,$model,$year, $VIN, $idUser)";
		$result = mysqli_query(self::$mysqli,$query);
	}

	public function editCar(){
		$query="UPDATE `car` SET `make`='{$this->make}',`model`='{$this->model}',`year`='{$this->year}', `VIN`='{$this->VIN}' WHERE id={$this->id}";
		$result = mysqli_query(self::$mysqli,$query);
	}

	public function deleteCar(){
		$query = "DELETE FROM `car` WHERE id={$this->id}";
		$q = "DELETE FROM `order` WHERE idCar={$this->id}";
		$result = mysqli_query(self::$mysqli,$query);
		$q = "DELETE FROM `order` WHERE idCar={$this->id}";
	}
	public function checkStatus(){
		$query="SELECT `status` FROM `order` WHERE `idCar` = {$this->id}";
		$intermediate=mysqli_query(self::$mysqli,$query);
		$row=array();
		while ($res=mysqli_fetch_assoc($intermediate)) {
			$row[]=$res;
		}
		$message=true;
		if (!empty($row)){
			foreach ($row as $key => $value) {
				if ($value['status']==Order::IN_PROGRESS){
					$message=false;
					break;
				}
			}
			if (!$message) {
				$message="You have an order in progress!";
			}
		}
		return $message;

	}
}

?>