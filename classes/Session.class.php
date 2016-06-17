<?php
class Session{
private $id, $name, $time, $dm;
	public function __construct($id){
		$row = Db::getInstance()->row("SELECT * FROM `dn_session` WHERE session_id = '".$id."'");
    	$this->id = $row["session_id"];
    	$this->name = $row["session_name"];
    	$this->dm = new User($row["session_dm"]);
    	$this->time = explode(";", $row["session_time"]);
	}
	public function setTime($time){
		Db::getInstance()->query("UPDATE `dn_session` SET session_time = '".$time."' WHERE session_id = ". $this->id);
	}
	public function getTime($time=null){
		if($time==null)return $this->time;
		else if($time=="year")return $this->time[0];
		else if($time=="month")return $this->time[1];
		else if($time=="day")return $this->time[2];
		else if($time=="time")return $this->time[3];
	}
	public function getName(){
		return $this->name;
	}
	public function getDm(){
		return $this->dm;
	}
	public function getId(){
		return $this->id;
	}
	public function getCharacters(){
     $query = Db::getInstance()->query("SELECT c.character_id, c.character_name FROM `dn_character` c JOIN `dn_session_character` sc ON sc.character_id = c.character_id WHERE `session_id` = ".$this->id);
     return $query;
    }
    public static function getCurrent(){
     if(!isset($_SESSION['session_id']))return null;
     return new Session($_SESSION['session_id']);
    }
}
?>