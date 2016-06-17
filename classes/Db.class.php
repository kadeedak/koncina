<?php
class Db{
 private $pdo, $sQuery, $settings, $parameters;
 private $bConnected = false;
 private static $_instance;
 
 private function __construct(){
  $this->Connect();
  $this->parameters = array();
 }
 public static function getInstance(){
  if (self::$_instance === null)self::$_instance = new Db();
  return self::$_instance;
 }
 public function __clone(){
  return false;
 }
 public function __wakeup(){
  return false;
 }
 private function Connect(){
  $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
  try{
   $this->pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
   $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
   $this->bConnected = true;
  }
  catch (PDOException $e){
   die();
  }
 }
 private function Init($query,$parameters = ""){
  if(!$this->bConnected)$this->Connect();
  try{
   $this->sQuery = $this->pdo->prepare($query);
   $this->bindMore($parameters);
   if(!empty($this->parameters)){
    foreach($this->parameters as $param){
     $parameters = explode("\x7F",$param);
     $this->sQuery->bindParam($parameters[0],$parameters[1]);
    }
   }
   $this->succes = $this->sQuery->execute();
  }
  catch(PDOException $e){
   die();
  }
  $this->parameters = array();
 }
 public function bind($para, $value){
  $this->parameters[sizeof($this->parameters)] = ":" . $para . "\x7F" . utf8_encode($value);
 }
 public function bindMore($parray){
  if(empty($this->parameters) && is_array($parray)) {
   $columns = array_keys($parray);
   foreach($columns as $i => &$column)$this->bind($column, $parray[$column]);
  }
 }
 public function query($query,$params = null, $fetchmode = PDO::FETCH_ASSOC){
  $query = trim($query);
  $this->Init($query,$params);
  $rawStatement = explode(" ", $query);
  $statement = strtolower($rawStatement[0]);
  if ($statement === 'select' || $statement === 'show')return $this->sQuery->fetchAll($fetchmode);
  elseif ( $statement === 'insert' || $statement === 'update' || $statement === 'delete' )return $this->sQuery->rowCount();
  else return NULL;
 }
 public function lastInsertId() {
  return $this->pdo->lastInsertId();
 }
 public function row($query,$params = null,$fetchmode = PDO::FETCH_ASSOC){
  $this->Init($query,$params);
  return $this->sQuery->fetch($fetchmode);
 }
 public function single($query,$params = null){
  $this->Init($query,$params);
  return $this->sQuery->fetchColumn();
 }
}
?>