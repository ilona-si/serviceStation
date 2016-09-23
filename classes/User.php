<?php


require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/SQLConnection.php";

class User{
	private $firstName;
	private $lastName;
	private $dateOfBirth;
	private $address;
	private $phone;
	private $email;
	private $id;
	private static $mysqli;
	
	function __construct($id=0){
		if ($id==0) {
			$query="INSERT INTO `user`(`firstName`, `lastName`, `dateOfBirth`, `address`, `phone`, `email`) VALUES ('','','','','','')";
			
			mysqli_query(self::$mysqli,$query);
			$q="SELECT MAX(id) from `user`";
			$res = mysqli_query(self::$mysqli,$q);
			$r=mysqli_fetch_assoc($res);
			$this->setId($r['MAX(id)']);
		}
		else{
			$query = "SELECT * from `user` WHERE id=$id ";
			$result = mysqli_query(self::$mysqli,$query);
			$row = mysqli_fetch_assoc($result);
			$this->setFirstName($row['firstName']);
			$this->setlastName($row['lastName']);
			$this->setdateOfBirth($row['dateOfBirth']);
			$this->setAddress($row['address']);
			$this->setPhone($row['phone']);
			$this->setEmail($row['email']);
			$this->setId($id);
			
		}
	}

	public static function SetMysqli($mysqli){
    	self::$mysqli=$mysqli;
    }

	public function setFirstName($firstName){
		$this->firstName = $firstName;
	}
	public function getFirstName(){
		return $this->firstName;
	}
	public function setLastName($lastName){
		$this->lastName = $lastName;
	}
	public function getLastName(){
		return $this->lastName;
	}
	public function setDateOfBirth($dateOfBirth){
		$this->dateOfBirth = $dateOfBirth;
	}
	public function getDateOfBirth(){
		return $this->dateOfBirth;
	}
	public function setAddress($address){
		$this->address = $address;
	}
	public function getAddress(){
		return $this->address;
	}
	public function setPhone($phone){
		$this->phone=$phone;
	}
	public function getPhone(){
		return $this->phone;
	}
	public function setEmail($email){
		$this->email=$email;
	}
	public function getEmail(){
		return $this->email;
	}
	public function setId($id){
		$this->id=$id;
	}
	public function getId(){
		return $this->id;
	}
	public function submitChages(){
		$query="UPDATE `user` SET `firstName`='{$this->firstName}',`lastName`='{$this->lastName}',`dateOfBirth`='{$this->dateOfBirth}',`address`='{$this->address}',`phone`='{$this->phone}',`email`='{$this->email}' WHERE id={$this->id}";
		mysqli_query(self::$mysqli,$query);
	}
	public function AllSetter($firstName='',$lastName='',$dateOfBirth='',$address='',$phone='',$email=''){
		$this->setFirstName($firstName);
		$this->setLastName($lastName);
		$this->setDateOfBirth($dateOfBirth);
		$this->setAddress($address);
		$this->setPhone($phone);
		$this->setEmail($email);
		$this->submitChages();
	}
	public function getList(){
		$query = "SELECT * FROM `car` WHERE idUser={$this->id}";
		$result = mysqli_query(self::$mysqli,$query);
		$res=array();
		while ($row = mysqli_fetch_assoc($result)){
			$res[] = $row;
		}
		return $res;
	}

}
?>