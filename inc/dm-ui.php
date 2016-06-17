<link rel="stylesheet" type="text/css" href="./style/general-style.css">
<link rel="stylesheet" type="text/css" href="./style/dm-ui.css">
<link rel="stylesheet" type="text/css" href="./style/bootstrap.min.css" />
<script src="./js/jquery.js"></script>

<?php if(isset($_POST['user_id']))$char = new Character($_POST['user_id']); echo($_POST['user_id']); ?>
<?php $session = new Session(1); ?>


<div id="wrapper" class="container">
<div id="left-content">
<?php echo($session->getTime("day").".".$session->getTime("month").".".$session->getTime("year")." - ".$session->getTime("time")); ?>
<br />
<form action="./script/timeUpdate.php" method="get">
<input type="hidden" name="sessionID" value='<?php echo $session->getId(); ?>'>
<input type="submit" name="15min" value="+15 min">
<input type="submit" name="1hour" value="+1 hour">
<input type="submit" name="1day" value="+1 day">
</form>
<br />Inv: <br /><br />
<div id="lists">
<div class="list">
<?php 
 if($char){
  $itm = $char->getItem();
  foreach ($itm as $value)echo($value['i_name']."	".$value['quantity']."<br /><hr />");
 }
?>
</div>
<div class="list">
<?php
	if($char){
		$abil = $char->getAbilities();
		foreach ($abil as $val) {
			echo ($val['ability_name']."   ".$val['ability_level']."<br /><hr />");
		}
	}
?>
</div>
</div>
<div id="selection">
Additem:<br />
<?php $row = Db::getInstance()->query("SELECT * FROM `item`"); ?>
<form action='./script/characterUpdate.php' method='get'>
 <select id='item_select' name='item'>
 <?php
  foreach ($row as $item) {
   echo("<option value='".$item['i_id']."'>");
   echo($item["i_name"]);			
   echo("</option>");
  }
 ?>
 </select>
 <input type="hidden" name="method" value="additem">
 <input type='hidden' value='<?php echo $char->getId(); ?>' name='user'>
 <input type='number' value='1' name='qty'>
 <input type='submit'>
</form>
<form action='./script/characterUpdate.php' method='get'>
 <input type="hidden" name="method" value="additem">
</form>

<div>


</div>
</div>
</div>
<div id="right-content">
  <?php
 $chars = Character::getCharacters(1);
 foreach ($chars as $value) {
  echo("<br /><a href='index.php?user=".$value['c_id']."'>".$value['c_name']."</a>");
 }
?>
</div>



</div>
<?php include("./inc/chat.php"); ?>