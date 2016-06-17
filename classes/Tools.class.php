<?php
class Tools {
	public static function get($index,$method='POST'){
		if(strtoupper($method)=='POST'){
			if (isset($_POST[$index]))return $_POST[$index];
			else return false;
		}
		if(strtoupper($method)=='GET'){
			if (isset($_GET[$index]))return $_GET[$index];
			else return false;
		}
		else{
			if (isset($_POST[$index]))return $_POST[$index];
			else if (isset($_GET[$index]))return $_GET[$index];
			else return false;
		}
	}
	public static function sessionGet($index){
		if (isset($_SESSION[$index]))return $_POST[$index];
		return false;
	}
	public static function sessionSet($index, $value){
		$_SESSION[$index]=$value;
	}

	public static function checkBrute($user_id){
		$now = time();
		$invalid_attempts = $now - (1*60*60);
		echo "aaaa";
        // change to 20
		return count(Db::getInstance()->query('SELECT * FROM `dn_login_attempts` WHERE `user_id` = '.$user_id.' AND `time` > '.$invalid_attempts)) >= 5;
	}
	public static function updateConfig($name,$value){
		
		if(!Db::getInstance()->query("SELECT `id` FROM `dn_config` WHERE `name` = '".$name."'"))echo("asd");
  		
  		if(Db::getInstance()->query("SELECT `id` FROM `dn_config` WHERE `name` = '".$name."'")){
  			Db::getInstance()->query("UPDATE `dn_config` SET `value`= '".$value."' WHERE `name` = '".$name."'");
  		}else{
  			Db::getInstance()->query("INSERT INTO `dn_config`(`name`, `value`) VALUES ('".$name."','".$value."')");
  		}
  		
 	}
 	public static function getConfig($name){
  		if($val = Db::getInstance()->query("SELECT `value` FROM `dn_config` WHERE `name` = '".$name."'")){
  			return $val[0]['value'];
  		}
  		return false;
 	}
 	public static function deleteConfig($name){
 		Db::getInstance()->query("DELETE FROM `dn_config` WHERE `name` = ".$name."'");  		
 	}


}
?>