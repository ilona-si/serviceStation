<?php

require_once $_SERVER['DOCUMENT_ROOT']."/serviceStation/classes/SQLConnection.php";

class UserMachine{

	private static $mysqli;

	public static function SetMysqli($mysqli){
    	self::$mysqli=$mysqli;
    }

	public static function check($login,$password){
		$query="SELECT password FROM `admin` WHERE login='{$login}' ";
		$result = mysqli_query(self::$mysqli,$query);
		$res=array();
		while ($row = mysqli_fetch_assoc($result)){
			$res[] = $row;
		}
		if (!empty($res)){
			foreach ($res as $key => $value){
				if($password==$value['password']){
					return true;
				}else{
					return "Invalid password, please, try again!";
		    	}
			}
		}else{
			return "Invalid login, please, try again!";
		}
	}

	public static function setCookie(){
		$ssid = md5(rand().time());
		setcookie('ssid',$ssid, time() + 3600,"/" ); 
		$_COOKIE['ssid']=$ssid;
		$update_query =" UPDATE `admin` SET `ssid`='$ssid' WHERE `id`=1";
		mysqli_query(self::$mysqli,$update_query);
	}

	public static function checkCookie($coockie){
		$query = "SELECT * FROM `admin` WHERE `ssid` = '$coockie'";
		$result = mysqli_query(self::$mysqli,$query);
		$res=array();
		while ($row = mysqli_fetch_assoc($result)){
			$res[] = $row;
		}
	return $res;
	}

	public static function getList(){
		$query = "SELECT * FROM `user`";
		$result = mysqli_query(self::$mysqli,$query);
		$res=array();
		while ($row = mysqli_fetch_assoc($result)){
			$res[] = $row;
		}
		return $res;
	}

	public static function search($search){
		$query = "SELECT * FROM `user`";
		$result = mysqli_query(self::$mysqli,$query);
		$res=array();
		while ($row = mysqli_fetch_assoc($result)){
			$res[] = $row;
		}
		$arr = array();
		$firstArr = array();
		foreach ($res as $key => $value){
			$pos1=strpos(strtoupper($search),strtoupper($value['lastName']));
			$pos2=strpos(strtoupper($search),strtoupper($value['firstName']));
			if ($pos1!==false || $pos2!==false) {
				$arr[]=$res["$key"];
			}
		}
		return $arr;
	}

	public static function logOut(){
		$ssid = md5(rand().time());
		setcookie('ssid',$ssid,time() -3600, "/");
		unset($_COOKIE['ssid']);
		header('Location: /serviceStation');
	}
}

?>