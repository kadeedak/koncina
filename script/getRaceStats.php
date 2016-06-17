<?php	
	require("../inc/init.php");
	$db = Db::getInstance();
	$id = $_POST['id'];
	$data = $db->row("SELECT * FROM `dn_race` WHERE race_id = '".$id."'");
	die(json_encode($data));
?>