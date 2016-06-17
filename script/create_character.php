<?php
include("../inc/init.php");
if(User::isLogged())
	$user = new User();
else
	header("Location: ./index.php");

$db = Db::getInstance();
$abilities = $_POST["abilities"];
$params = $_POST["stats"];
$params["name"] = $_POST["name"];
//str+end+20
$health = intval($params["strength"])+intval($params["endurance"])+20;
//int+tal+20
$energy = intval($params["intelligence"])+intval($params["talent"])+20;
//(str+6)*10
$capacity = (intval($params["strength"])+6)*20;
//tal+per
$appearance = (intval($params["talent"])+intval($params["perception"]));
$params["health"] = $health;
$params["energy"] = $energy;
$params["capacity"] = $capacity;
$params["c_health"] = $health;
$params["c_energy"] = $energy;
$params["c_capacity"] = $capacity;
$params["appearance"] = $appearance;
$params["race"] = $_POST["race"];
$params["u_id"] = $user->id;
var_dump($params);
if($db->query("INSERT INTO dn_character (character_name, character_strength, character_agility, character_endurance, character_intelligence, character_perception,
 character_talent, character_health, character_energy, character_capacity, character_appearance, character_current_health, character_current_energy, 
 character_current_capacity, character_race, user_id) VALUES (:name, :strength, :agility, :endurance, :intelligence, :perception, :talent, :health, :energy, :capacity, 
 :appearance, :c_health, :c_energy, :c_capacity, :race, :u_id)", $params)){	
 	$scnd_params = array("name" => $params["name"]);
	$c_id = $db->single("SELECT character_id FROM dn_character WHERE character_name LIKE :name", $scnd_params);
	foreach ($abilities as $key => $value) {
		$thrd_params = array(
			"c_id" => $c_id,
			"a_id" => $key,
			"level" => $value
		);
		if(!$db->query("INSERT INTO dn_character_ability (character_id, ability_id, ability_level) VALUES (:c_id, :a_id, :level)", $thrd_params))
			die("nope");
	}
	die("okay");
}else
	die(false);
?>

/*
($db->query("INSERT INTO dn_character (character_name, character_strength, character_agility, character_endurance, character_intelligence, character_perception,
	character_talent, character_health, character_energy, character_capacity, character_appearance, character_current_health, character_current_energy, 
	character_current_capacity, character_race) VALUES (:name, :strength, :agility, :endurance, :intelligence, :perception, :talent, :health, :energy, :capacity, 
	:appearance, :health, :energy, :capacity, :race)", $params))
	*/