<?php
include("../inc/init.php");

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$validData = true;
$data = array(
"passed" => false,
"msg" => ""
);
if(strlen($username)<4 || strlen($username)>24 || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username)){
	$validData=false;
	$data["msg"]="USERNAME : must be >4; must be <24; must not contain special characters.";
}

if(strlen($password)<6 || strlen($password)>1024){
	$validData=false;
	$data["msg"]="PASSWORD : between 6 and 1024 omg.";
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$validData=false;
	$data["msg"]="E-MAIL : is simply not an e-mail.";
}

if($validData){
	$res_uname = Db::getInstance()->row('SELECT * FROM dn_user WHERE user_username LIKE "'.$username.'"');
	$res_mail = Db::getInstance()->row('SELECT * FROM dn_user WHERE user_mail LIKE "'.$email.'"');
	if(count($res_uname)>1){
		$data["msg"] = "Username already exists";
		die(json_encode($data));
	}else if(count($res_mail)>1){
		$data["msg"] = "E-mail already registered";
		die(json_encode($data));
	}else{
		$salt = hash( 'sha512' , microtime().rand());
		$passencrypt = hash( 'sha512' , $password . $salt);
		Db::getInstance()->query('INSERT INTO `dn_user` (`user_username`, `user_password`, `user_mail`, `salt`) 
		VALUES ("'.$username.'", "'.$passencrypt.'", "'.$password.'", "'.$salt.'")');
		$data["passed"] = true;
		die(json_encode($data));
	}
}else{
	die(json_encode($data));
}
?>