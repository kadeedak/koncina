<?php
	require("../inc/init.php");
	$id = $_POST['id'];
	$data = Db::getInstance()->row("SELECT * FROM `dn_item` WHERE item_id = '".$id."'");
	die($data['item_properties']);
?>