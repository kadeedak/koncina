<?php
if(!User::getCurrent())header("Location:./index.php?page=log");
if(!Character::getCurrent())header("Location:./index.php?page=char");
$char = Character::getCurrent();?>
<html>
	<head>
		<title>
			Layout
		</title>
		<script src="./js/user-ui.js"></script>

		<meta charset="UTF-8" />
	</head>
	<body>
	<div id='wrap' style="height: 100vh;background-image:url('./img/ricepaper-black.jpg')">
		<!--
		<div id="character" class="ui-widget-content ui-window" style="width:200px;position:absolute;left:0px">
			<p class="ui-widget-header">Character<a class="ui-window-close" href="javascript:void(0)" ><span style="float:right;" class="ui-icon ui-icon-circle-close"></span></a><a class="ui-window-slide" href="javascript:void(0)" ><span style="float:right;" class="ui-icon ui-icon-arrowthick-1-n"></span></a></p>
			<div class="ui-window-content">
				helloworld
				<div class="line" style=""><?php echo($char->getName()); ?></div>
			</div>
		</div>
		<div id="inventory" class="ui-widget-content ui-window" style="width:200px;height:200px;">
			<p class="ui-widget-header">Inventory<a class="ui-window-close" href="javascript:void(0)" ><span style="float:right;" class="ui-icon ui-icon-circle-close"></span></a><a class="ui-window-slide" href="javascript:void(0)" ><span style="float:right;" class="ui-icon ui-icon-arrowthick-1-n"></span></a></p>
			<div class="ui-window-content">
			</div>
		</div>
		<!--
		<div id="wrapper" class="container">
			<div id="top" class="row">
					<div class ="toppannel col-xs-12 col-md-3">
						<div class="line"><?php echo($char->getName()); ?></div>
						<ul id="leftside" class="list-group">
							<li class="list-group-item">Str:<span class="badge"> <?php echo($char->getStat("str")); ?></span></li>
							<li class="list-group-item">Agi:<span class="badge"> <?php echo($char->getStat("agi")); ?></span></li>
							<li class="list-group-item">End:<span class="badge"> <?php echo($char->getStat("end")); ?></span></li>
							<li class="list-group-item">Int:<span class="badge"> <?php echo($char->getStat("int")); ?></span></li>
							<li class="list-group-item">Per:<span class="badge"> <?php echo($char->getStat("per")); ?></span></li>
							<li class="list-group-item">Tal:<span class="badge"> <?php echo($char->getStat("tal")); ?></span></li>
						</ul>
						<ul id="rightside" class="list-group">
							<li class="list-group-item">HP: <span class="badge"><?php echo($char->getStat("chp")) . " / "; echo($char->getStat("hp")); ?></span></li>
							<li class="list-group-item">MP: <span class="badge"><?php echo($char->getStat("cmp")) . " / "; echo($char->getStat("mp")); ?></span></li>
							<li class="list-group-item">Cap:<span class="badge"> <?php echo($char->getStat("ccp")) . " / "; echo($char->getStat("cp")); ?></span></li>
							<li class="list-group-item">App:<span class="badge"> <?php echo($char->getStat("ap")); ?></li>
						</ul>

					</div>
					<div class ="toppannel col-xs-12 col-md-3">
					<div class="line">
					Das spellus mega fellus
					</div>
					<ul class="list-group">
						<?php foreach ($char->getEffect() as $effect) {
							echo("<li class='list-group-item'>");
							echo($effect['effect_name']);
							echo("</li>");
						} ?>
					</ul>
					</div>
					<div class ="toppannel col-xs-12 col-md-3">
						<ul class="list-group">
              <?php foreach ($char->getAbilities() as $effect) {
							echo("<li class='list-group-item'>");
							echo($effect['ability_name']);
              				echo($effect['ability_description']);
							echo("</li>");
						} ?>

             </ul>
					</div>
          <a href="./index.php?page=logout"> Log out </a>
				</div>

			<div id="main" class="row">
				<div id="left" class="col-md-3">
					<div id="itemlist">
						<?php
							foreach ($char->getItem() as $item) {
								echo("<li data-item-id='".$item['item_id']."' class='item'>");
								echo($item['item_name']);
								echo("<div class='qty badge'>");
								echo($item['item_quantity']);
								echo("</div>");
								echo("</li>");
							}
						?>
					</div>
					<div id="description">
						Popis
					</div>
				</div>

				<div id="right" class="col-md-9">

					<span title="Hello!">hello</span>
					<div id ="canvas-container">
						<img src="./img/wpx.png" id="canvas" />
						<script src="./js/canvas.js"></script>
					</div>

				</div>
			</div>
		</div>
   <?php include("./inc/chat.php"); ?>
-->
</div>
	</body>
</html>
