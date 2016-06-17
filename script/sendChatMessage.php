<?php
	require_once("../inc/init.php");
	$from=$_SESSION['character_id'];
	$session_id = $_SESSION['session_id'];
	$to = $_POST['to'];
	$text = $_POST['text'];
	
	Db::getInstance()->query("INSERT INTO `dn_message` (`session_id`,`message_from`,`message_to`,`message_text`) VALUES ('".$session_id."','".$from."', '".$to."', '".$text."')");
?>