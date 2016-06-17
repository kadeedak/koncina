<?php
include("../inc/init.php");
$user = new User();
$function = $_POST["ftion"];
switch($function){
	case "enterGame":
		enterGame();
		break;
}

function enterGame(){
	$_SESSION['character_id']=$_POST['char_id'];
	$_SESSION['session_id']=$_POST['session_id'];
	die(json_encode(true));
}
?>