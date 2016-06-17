<?php
class Character {
private $name, $dmRole, $stats, $effects, $id, $items, $abilities;
public function __construct($name) {
    $row = Db::getInstance()->row("SELECT * FROM `dn_character` WHERE character_id = '".$name."'");
    $this->id = $row["character_id"];

    if($row["character_dm"]==1){
      $this->dmRole = true;
      $this->name = "Dungeon Master";
    }else{
      $this->dmRole = false;
      $this->name = $row["character_name"];
      $this->effects=array();
      $this->items=array();
      $this->abilities=array();
      $this->stats = array(
       "str" => (int)$row["character_strength"],
       "agi" => (int)$row["character_agility"],
       "end" => (int)$row["character_endurance"],
       "int" => (int)$row["character_intelligence"],
       "per" => (int)$row["character_perception"],
       "tal" => (int)$row["character_talent"],
       "hp" => (int)$row["character_health"],
       "mp" => (int)$row["character_energy"],
       "cp" => (int)$row["character_capacity"],
       "ap" => (int)$row["character_appearance"],
       "chp" => (int)$row["character_current_health"],
       "cmp" => (int)$row["character_current_energy"],
       "ccp" => (int)$row["character_current_capacity"],
      );
     }

     $row = Db::getInstance()->query("SELECT * FROM `dn_character_effect` ce JOIN `dn_effect` e ON ce.effect_id=e.effect_id WHERE character_id = '".$name."'");
     foreach ($row as $value) {
       array_push($this->effects, $value);
     }
     $row = Db::getInstance()->query("SELECT * FROM `dn_character_item` ci JOIN `dn_item` i ON ci.item_id=i.item_id WHERE character_id = '".$name."'");
     foreach ($row as $value) {
       array_push($this->items, $value);
     }
     $row = Db::getInstance()->query("SELECT * FROM `dn_character_ability` ca JOIN `dn_ability` a ON ca.ability_id=a.ability_id WHERE character_id = '".$name."' ");
     foreach ($row as $value) {
       array_push($this->abilities, $value);
     }

 }
 public function isDM(){
  return $this->dmRole;
 }
 public function getStat($stat=null){ 
  if($stat==null){
    return $this->stats;
  }
  return $this->stats[$stat];
 }
 public function getName(){
  return $this->name;
 }
 public function getId(){
  return $this->id;
 }
 public function getEffect(){
  return $this->effects;
 }
 public function getItem(){
  return $this->items;
 }
 public function getAbilities(){
  return $this->abilities;
 }
 public function addItem($item_id, $qty){
  $query = Db::getInstance()->query("SELECT * FROM `dn_character_item` ci JOIN `dn_item` i ON ci.item_id = i.i_id WHERE `character_id` =".$this->id);
  $new = true;
  foreach ($query as $value) {
    if($value["item_id"]==$item_id){
      $new = false;
      $new_qty = $qty + $value['item_quantity'];
      Db::getInstance()->query("UPDATE `dn_character_item` SET `item_quantity`= ".$new_qty." WHERE `character_id` =".$this->id." AND `item_id` = ".$item_id);
      break;
    }
  }
  if($new){
    Db::getInstance()->query("INSERT INTO `dn_character_item` (`item_quantity`,`character_id`,`item_id`) VALUES (".$qty.", ".$this->id.", ".$item_id.")");
  }
 }
 public function removeItem($item_id, $qty){
  $query = Db::getInstance()->query("SELECT * FROM `dn_character_item` ci JOIN `dn_item` i ON ci.item_id = i.item_id WHERE `character_id` =".$this->id);
  foreach ($query as $value) {
    if($value["item_id"]==$item_id){
      if($value['item_quantity'] <= $qty){
        Db::getInstance()->query("DELETE FROM `dn_character_item` WHERE `character_id` =".$this->id." AND `item_id` = ".$item_id);
      }else{

      }
      $new_qty = $value['item_quantity']-$qty;
      Db::getInstance()->query("UPDATE `dn_character_item` ci SET `item_quantity`= ".$new_qty." WHERE `character_id` =".$this->id." AND `item_id` = ".$item_id);
      break;
    }
  }
 }

 public static function getCharacters($session_id){
  $query = Db::getInstance()->query("SELECT c.character_id, c.character_name FROM `dn_character` c JOIN `dn_session_character` sc ON sc.character_id = c.character_id WHERE `session_id` = ".$session_id);
  return $query;
 }
 public function getAvailableSessions(){
  $rows = Db::getInstance()->query("SELECT s.`session_id`, s.`session_name` FROM `dn_session_character` sc JOIN `dn_session` s ON s.`session_id` = sc.`session_id`  WHERE `character_id` =".$this->id);
  return $rows;
 }
 public static function getCurrent(){
     if(!isset($_SESSION['character_id']))return null;
     return new Character($_SESSION['character_id']);
 }
 
}
?>