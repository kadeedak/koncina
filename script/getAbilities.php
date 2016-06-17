<?php
	require("../inc/init.php");
	$db = Db::getInstance();
	$data = $db->query("SELECT * FROM `dn_ability`");
	for($i = 0; $i<count($data); $i++){
		$data[$i]["ability_requirment"] = unserialize($data[$i]["ability_requirment"]);
		$data[$i]["ability_description"] = unserialize($data[$i]["ability_description"]);
		$data[$i]["ability_primary_attr"] = unserialize($data[$i]["ability_primary_attr"]);
	}
	die(json_encode($data));
?>