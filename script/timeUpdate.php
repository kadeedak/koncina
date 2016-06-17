<?php
	include("../inc/init.php");
	
	$sess = new Session($_GET['sessionID']);
	

	function timeConvert($time,$add,$num){
		$t=explode(":",$time[3]);
		$hour	=	$t[0];
		$minute	=	$t[1];
		$day	=	$time[2];
		$month	=	$time[1];
		$year	=	$time[0];

		if($add=="minute")	$minute+=$num;
		if($add=="hour")	$hour+=$num;
		if($add=="day")		$day+=$num;
		if($add=="month")	$month+=$num;
		if($add=="year")	$year+=$num;

		if($minute >= 60){
			$hour+=floor($minute/60);
			$minute=$minute%60;
		}
		if($hour >= 24){
			$day+=floor($hour/24);
			$hour=$hour%24;
		}
		if($day >= 90){
			$month+=floor($day/90);
			$day=$day%90;
		}
		if($month >= 4){
			$year+=floor($month/4);
			$month=$month%4;
		}
		$t=implode(":", array($hour,$minute));
		$a=array($year,$month,$day,$t);
		$time = implode(";",$a);
		return $time;
	}

	if(isset($_GET['15min']))$sess->setTime(timeConvert($sess->getTime(),"minute",15));
	else if(isset($_GET['1hour']))$sess->setTime(timeConvert($sess->getTime(),"hour",1));
	else if(isset($_GET['1day']))$sess->setTime(timeConvert($sess->getTime(),"day",1));

	header("location: ../index.php");
	
?>