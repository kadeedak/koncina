<?php
class User {
 public $id;

 public function __construct($id=null) {
 	if($id==null){
   if(isset($_SESSION['user_id'])){
    $this->id = $_SESSION['user_id'];
   }
  }else{
    $this->id = $id;
  }

 }
public static function isLogged(){
   return isset($_SESSION['login_string']);
 }
 public static function logIn($username, $password){
  $q = Db::getInstance()->row('SELECT * FROM `dn_user` WHERE `user_username` LIKE "'.$username.'"');
    if($q){
//      if(Tools::checkBrute($q['user_id'])){
//        header("Location: ./index.php?err=2");
//      }else{
        $pw = hash( 'sha512', $password.$q['salt']);
        if($q['user_password'] == $pw){
          $user_browser = $_SERVER['HTTP_USER_AGENT'];
          $user_id = preg_replace("/[^0-9]+/", "", $q['user_id']);
          $_SESSION['user_id'] = $user_id;
          $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $q['user_username']);
          $_SESSION['username'] = $username;
          $_SESSION['login_string'] = hash('sha512', $pw . $user_browser);
          return new self();
        }else{
          Db::getInstance()->query('INSERT INTO `dn_login_attempts` (`user_id`, `time`) VALUES ("'.$q["user_id"].'", '.time().')');
          if(Tools::checkBrute($q['user_id'])){
            if(!$q['blocked']) SELF::blockAccount($q['user_id']);
          }
          header("Location: ./index.php?err=1");
        }
//      }
    }else{
      header("Location: ./index.php?err=1");
    }
 }
 public function getAvailableCharacters(){
 // $rows = Db::getInstance()->query("SELECT c.`character_id`, c.`character_name` FROM `dn_user_character` j JOIN `dn_character` c ON c.`character_id` = j.`character_id`  WHERE `user_id` =".$this->id);
  $rows = Db::getInstance()->query("SELECT * FROM dn_character WHERE user_id =".$this->id);
  return $rows;
 }
 public static function getCurrent(){
 if(!isset($_SESSION['user_id']))return null;
 return new User($_SESSION['user_id']);
}
  public static function blockAccount($usr_id){
    $r = Db::getInstance()->row('SELECT `user_username`, `password` FROM `user` WHERE `user_id` = '.$usr_id);
    if($r){
      $unblock_code = hash('sha512', microtime().rand());
      Db::getInstance()->query('UPDATE `user` SET `blocked`=true, `unblock_code`="'.$unblock_code.'" WHERE `user_id` = '.$usr_id);
      SELF::unblockMail($usr_id);
    }
  }
}



?>
