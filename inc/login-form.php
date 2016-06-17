<?php
//if user is logged in
if(User::getCurrent())header("Location:./index.php?page=char");
//
if(Tools::get('usr')&&Tools::get('pwd')){
	if($user = User::logIn(Tools::get('usr'),Tools::get('pwd'))){
		Tools::sessionSet('user_id',$user->id);
		header("Location: ./index.php?page=char"); 
	}
}
?>
<form action="./index.php?page=log" method="post">
	<input type="text" name="usr" /> <br />
	<input type="password" name="pwd" /> <br />
	<input type="submit" name="login-submit" />
</form>
<a href="./index.php?page=reg"> Registrace </a>