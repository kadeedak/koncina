<?php
define('MOD_DEFAULTS',serialize(array(
  'displayName' => 'Unnamed module',
  'posX' => 0,
  'posY' => 0,
  'width' => 200,
  'height' => 100,
  'disableSlide' => false,
  'disableClose' => false,
  'fixedPos' => false,
)));

class Module{
  public $name;
  public $path;
  function __construct($name){
    if(is_dir(DIR_ROOT."/modules/".$name)){
      $this->name = $name;
      $this->path = DIR_ROOT."/modules/".$this->name."/";
      $config=json_decode(file_get_contents($this->path.$this->name.".json"),true);
    }
  }
  function getConfig($conf){
    if($conf=='all')return file_get_contents($this->path.$this->name.".json");
    $arr=json_decode(file_get_contents($this->path.$this->name.".json"),true);
    if(isset($arr[$conf]))return $arr[$conf];
    else return unserialize(MOD_DEFAULTS)[$conf];
  }
}
?>
