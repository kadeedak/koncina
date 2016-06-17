<?php
	require("../inc/init.php");
	$id = $_SESSION['character_id'];
	$session_id = $_SESSION['session_id'];
	$last_id = $_POST['last'];
	$refresh = false;

	$row = Db::getInstance()->query("
		SELECT message_id FROM `dn_message`
		WHERE `message_to` = '".$id."' 
		OR `message_from` = '".$id."' 
		OR `message_to` = 0
		ORDER BY message_id DESC LIMIT 1 
	");

	if($last_id==="undefined")$refresh=true;
	if(intval($last_id) < intval($row[0]['message_id']))$refresh=true;
	if(!$refresh)die();

	//getMessages to or from user

	$data = Db::getInstance()->query("
		SELECT c.message_id, c.message_text, c.message_timestamp, c1.character_name AS 'name_f', c2.character_name AS 'name_t' FROM `dn_message` c 
		JOIN `dn_character` c1 ON c1.character_id = c.message_from
		JOIN `dn_character` c2 ON c2.character_id = c.message_to
		WHERE `message_to` = '".$id."' 
		OR `message_from` = '".$id."' 
		AND `message_to` <> '0'
		AND `message_from` <> '0'
		ORDER BY message_id DESC LIMIT 10 
	");
	//getMessages to all
	$data2 = Db::getInstance()->query("
		SELECT c.message_id, c.message_text, c.message_timestamp, c1.character_name AS 'name_f' FROM `dn_message` c 
		JOIN `dn_character` c1 ON c1.character_id = c.message_from
		WHERE `message_to` = '0' 
		ORDER BY message_id DESC LIMIT 10 
	");
	for ($i=0; $i < count($data2) ; $i++) { 
		$data2[$i]['name_t']='All';
	}

	$data = array_merge($data,$data2);
	function cmp($a, $b){
    	return strtotime($a['message_timestamp']) < strtotime($b['message_timestamp']);
	}
    usort($data, "cmp");
    
	die(json_encode($data));
?>