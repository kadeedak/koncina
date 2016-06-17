<?php
 $char;
 if(!User::getCurrent())header("Location:./index.php?page=log");
 if(!$char=Character::getCurrent())header("Location:./index.php?page=char");
?>
<link rel="stylesheet" type="text/css" href="./style/player-ui.css" />
<div id='wrap'>
<?php $modules = unserialize(Tools::getConfig('modules')); ?>
<?php foreach ($modules as $module): ?>
    <?php $mod = new Module($module) ?>
    <?php include("./script/moduleCss.php");?>
		<div class="ui-widget-content ui-window" id="<?php echo($mod->name); ?>">
      <input type="hidden" class="mod-configuration" value="<?php echo str_replace('"',"'",($mod->getConfig('all')));?>">
			<p class="ui-widget-header"><?php echo($mod->getConfig('displayName')); ?>
        <?php if(!$mod->getConfig('disableClose')): ?><a class="ui-window-close" href="javascript:void(0)" ><span class="ui-icon ui-icon-circle-close"></span></a><?php endif; ?>
        <?php if(!$mod->getConfig('disableSlide')): ?><a class="ui-window-slide" href="javascript:void(0)" ><span class="ui-icon ui-icon-arrowthick-1-n"></span></a><?php endif; ?>
      </p>
			<div class="ui-window-content">
				<?php include(DIR_ROOT."/modules/".$module."/".$module.".php"); ?>
			</div>
		</div>
<?php endforeach; ?>
<div id="sidemenu">
<ul>
<?php foreach ($modules as $module): ?>
  <li><img class="icon-image" src="<?php echo "./modules/".$module."/".$module.".png"; ?>" ondragstart="return false;" uadata="<?php echo $module; ?>" /></li>
<?php endforeach; ?>
</ul>
</div>
</div>
<script src="./js/player-ui.js"></script>
