<?php include("./inc/init.php"); ?>
<link rel="stylesheet" type="text/css" href="./style/user-ui.css" />
<link rel="stylesheet" type="text/css" href="./style/bootstrap.min.css" />
<link rel="stylesheet" href="./jquery-ui-1.11.4.custom/jquery-ui.min.css">
<script src="./js/jquery.js"></script>
<script src="./jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
<script src="./jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<meta charset="utf-8">


<?php

if(isset($_POST['mods'])){
	$mods = serialize($_POST['mods']);
	Tools::updateConfig("modules",$mods);
}
?>

<form action="#" method="post">

<?php
$temp = scandir(DIR_ROOT."/modules");
$temp = array_diff($temp, array('.', '..'));

$modules = array();
foreach($temp as $value)if(is_dir(DIR_ROOT."/modules/".$value))array_push($modules, $value);

echo("available modules:");
foreach ($modules as $module) {
	echo("<br />".$module."&nbsp<input type='checkbox' value='".$module."' name='mods[]'>");
}



?>
<br />
<input type='submit' />
</form>


<?php


var_dump(Tools::getConfig("modules"));

?>
