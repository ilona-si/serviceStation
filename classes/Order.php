<?php
require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/SQLConnection.php";


class Order{
	const COMPLETED = 1;
	const IN_PROGRESS = 2;
	const CANCELLED = 3;
	private $id;
	private $date;
	private $amount;
	private $status;
	private $idCar;
	private static $mysqli;

	function __construct($id=0){
		if ($id==0) {
			$query="INSERT INTO `order`( `date`, `amount`, `status`, `idCar`) VALUES ('','','','')";
			mysqli_query(self::$mysqli,$query);
			$q="SELECT MAX(id) from `order`";
			$res = mysqli_query(self::$mysqli,$q);
			$r=mysqli_fetch_assoc($res);
			$this->setId($r['MAX(id)']);
		}
		else{
			$query = "SELECT * from `order` WHERE id=$id ";
			$result = mysqli_query(self::$mysqli,$query);
			$row = mysqli_fetch_assoc($result);
			$this->setDate($row['date']);
			$this->setAmount($row['amount']);
			$this->setStatus($row['status']);
			$this->setIdCar($row['idCar']);
			$this->setId($id);	
		}
	}

	public static function SetMysqli($mysqli){
    	self::$mysqli=$mysqli;
    }
    public function setId($id){
		$this->id=$id;
	}
	public function getId(){
		return $this->id;
	}
	public function setDate($date){
		$this->date=$date;
	}
	public function getDate(){
		return $this->date;
	}
	public function setAmount($amount){
		$this->amount=$amount;
	}
	public function getAmount(){
		return $this->amount;
	}
	public function setStatus($status){
		$this->status=$status;
	}
	public function getStatus(){
		return $this->status;
	}
	public function setIdCar($idCar){
		$this->idCar=$idCar;
	}
	public function getIdCar(){
		return $this->idCar;
	}


	public function submitChages(){
		$query="UPDATE `order` SET `date`='{$this->date}',`amount`={$this->amount},`status`={$this->status},`idCar`={$this->idCar} WHERE id={$this->id} ";
		mysqli_query(self::$mysqli,$query);
	}
	public function AllSetter($date,$amount,$status,$idCar){
		$this->setDate($date);
		$this->setAmount($amount);
		$this->setStatus($status);
		$this->setIdCar($idCar);
		$this->submitChages();
	}
	
	public  function addOrder($date,$amount,$status,$idCar){
		$query = "INSERT INTO `order`( `date`, `amount`, `status`, `idCar`) VALUES ($date,$amount,$status,$idCar)";
		$result = mysqli_query(self::$mysqli,$query);
	}

	public function editOrder(){
		$query="UPDATE `order` SET `date`='{$this->date}',`amount`={$this->amount},`status`={$this->status},`idCar`={$this->idCar} WHERE id={$this->id} ";
		$result = mysqli_query(self::$mysqli,$query);
	}

	public function deleteOrder(){
		$query = "DELETE FROM `order` WHERE id={$this->id}";
		$result = mysqli_query(self::$mysqli,$query);
		
	}
	public function status($status){
		switch ($status){
			case Order::COMPLETED:
				$strStatus="Completed";
				break;
			case Order::IN_PROGRESS:
				$strStatus="In progress";
				break;
			case Order::CANCELLED:
				$strStatus="Cancelled";
				break;
			default:
				die();
		}
		return $strStatus;
	}

	public function checked($status){
		switch ($status){
			case Order::COMPLETED:
				$strStatus="Completed";
				$checked="<p><input type='radio' name='status' value='".Order::COMPLETED."' checked><label>Completed</label></p>
								<p><input type='radio' name='status' value='".Order::IN_PROGRESS."'><label>In Progress</label></p>
								<p><input type='radio' name='status' value='".Order::CANCELLED."'><label>Cancelled</label></p>";
				break;
			case Order::IN_PROGRESS:
				$checked="<p><input type='radio' name='status' value='".Order::COMPLETED."'><label>Completed</label></p>
								<p><input type='radio' name='status' value='".Order::IN_PROGRESS."' checked><label>In Progress</label></p>
								<p><input type='radio' name='status' value='".Order::CANCELLED."'><label>Cancelled</label></p>";
				break;
			case Order::CANCELLED:
				$checked="<p><input type='radio' name='status' value='".Order::COMPLETED."'><label>Completed</label></p>
								<p><input type='radio' name='status' value='".Order::IN_PROGRESS."' ><label>In Progress</label></p>
								<p><input type='radio' name='status' value='".Order::CANCELLED."' checked><label>Cancelled</label></p>";
				break;
			default:
				die();
		}
		return $checked;
	}



}
?>