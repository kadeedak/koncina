<?php
class Item{
	private $name, $type, $properties, $description, $id ;
	public function __construct($name){
		$this->db=Db::getInstance();
		$row = $this->db->row("SELECT * FROM `dn_item` WHERE `item_name` = '".$name."'");
		$this->type = $row["i_type"];
		$this->description = $row["decsription"];
	}

	public function serializeProp($properties = array(), $itemId){
			$ser = serialize($properties);
			$this->db->query("UPDATE `dn_item` SET `item_properties` = ('".$ser."') WHERE `item_id` = ".$itemId);
	}
}