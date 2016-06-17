<?php


class Ability{
	private $name, $id, $requirment, $description, $type;
	public function __construct($id){		
		$row = Db::getInstance()->row("SELECT * FROM `dn_ability` WHERE `ability_id` = `".$id."`");
		$this->type = $row["ability_type"];
		$this->name = $row["ability_name"];
		$this->description = $row["ability_description"];
		$this->requirment = $row["ability_requirment"];
	}

	public static function addAbility($name, $type, $description=array(), $requirment=array(),$dname,$attribute){
		$ser_req = serialize($requirment);
		$ser_des = serialize($description);
		$ser_att = serialize($attribute);
		echo $ser_des."<br />";
		echo $name."<br />";
		echo $type."<br />";
		echo $ser_req."<br />";
		echo $ser_att."<br />";
		$db = Db::getInstance()->query("INSERT INTO `dn_ability` (`ability_name`, `ability_type`, `ability_description`, `ability_requirment`, `ability_display_name`,`ability_primary_attr`) VALUES ('".$name."', '".$type."', '".$ser_des."', '".$ser_req."', '".$dname."', '".$ser_att."')");
	} 

 	
}