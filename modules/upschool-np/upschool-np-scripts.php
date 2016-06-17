<?php
require_once("./../../inc/init.php");
switch($_POST['function']){
 case "getInfoList":

  $res = Db::getInstance()->query("SELECT * FROM dn_character");
  $data = array();
  for($i = 0; $i<count($res); $i++){
   $data[$i]["id"] = $res[$i]["character_id"];
   $data[$i]["name"] = $res[$i]["character_name"];
   $data[$i]["race"] = $res[$i]["character_race"];
  }
  die(json_encode($data));
 break;
 case "getInfoChar":
  if(!isset($_POST['id']))die("err");
  $id = $_POST['id'];

  $res = Db::getInstance()->query("SELECT * FROM dn_character WHERE character_id=".$id);
  $data = array();
  $data["id"] = $res[0]["character_id"];
  $data["name"] = $res[0]["character_name"];
  $data["race"] = $res[0]["character_race"];
  $data["strength"] = $res[0]["character_strength"];
  $data["agility"] = $res[0]["character_agility"];
  $data["endurance"] = $res[0]["character_endurance"];
  $data["intelligence"] = $res[0]["character_intelligence"];
  $data["perception"] = $res[0]["character_perception"];
  $data["talent"] = $res[0]["character_talent"];
  $data["health"] = $res[0]["character_health"];
  $data["energy"] = $res[0]["character_energy"];
  $data["capacity"] = $res[0]["character_capacity"];
  $data["appearance"] = $res[0]["character_appearance"];
  $data["c_health"] = $res[0]["character_current_health"];
  $data["c_energy"] = $res[0]["character_current_energy"];
  $data["c_capacity"] = $res[0]["character_current_capacity"];
  die(json_encode($data));
 break;
 case "getFullList":

  $res = Db::getInstance()->query("SELECT * FROM dn_character_npc");
  for($i = 0; $i<count($res); $i++){
   $data[$i]["id"] = $data[$i]["character_id"];
   $data[$i]["name"] = $data[$i]["character_name"];
   $data[$i]["race"] = $data[$i]["character_race"];
  }
 break;
 default: break;

}
?>
