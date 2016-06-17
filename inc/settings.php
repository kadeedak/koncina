<?php
 if(!User::getCurrent())header("Location:./index.php?page=log");
?>
<html>
<head>
	<link rel="stylesheet" href="./style/main.css" />
</head>
<body>
	<div id="wrapper">
		<div id="top-menu">
		<ul>
			<li><a href="./index.php?page=char">Characters</a></li>
			<li><a href="./index.php?page=lib">Library</a></li>
			<li><a class="current" href="./index.php?page=set">Settings</a></li>
			<li><a href="./index.php?page=logout">Log out</a></li>
		</ul>
		</div>

		<div id="content">
		</div>
	</div>
</body>
</html>