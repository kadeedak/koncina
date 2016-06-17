<?php
	include("../inc/init.php");
	if(!isset($_GET['method']))die("No Method specified");
	$method = $_GET['method'];
	if($method == "additem"){
		$user; $item; $qty;
		if(!isset($_GET['user']))die("No user specified");
		$user=$_GET['user'];
		if(!isset($_GET['item']))die("No item specified");
		$item=$_GET['item'];
		if(!isset($_GET['qty']))$qty=1;
		else $qty=$_GET['qty'];
		
		$char = new Character($user);
		if($qty>0)$char->addItem($item,$qty);
		else $char->removeItem($item,abs($qty));

		
	}
	header("location: ../index.php");

?>