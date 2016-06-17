<?php
 if(!User::getCurrent())header("Location:./index.php?page=log");
 if(isset($_POST['r1']) && isset($_POST['r2'])){
	$_SESSION['character_id']=$_POST['r1'];
	$_SESSION['session_id']=$_POST['r2'];
	header("Location: ./index.php?page=main");
 }
?>
<html>
<head>
	<link rel="stylesheet" href="./style/main.css" />
	<script src="./js/main.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-tabs">
					<li role="presentation" class="active"><a href="#char">Characters</a></li>
					<li role="presentation"><a href="#library">Library</a></li>
					<li role="presentation"><a href="#settings">Settings</a></li>
					<li role="presentation"><a href="./index.php?page=logout">Log out</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div id="wrapper">

				<div class="tab_char" class="tab_wrapper">
					<div class="col-md-6">
						<div id="sub_tab_display_characters">
							<div class="panel panel-default">
								<h3 class="panel-heading">Characters</h3>
								<div class="panel-content">
									<ul class="list-group">
									<?php
										$user=new User();
		 								$chars = $user->getAvailableCharacters();
		 								foreach ($chars as $value) {
		 									echo('<a href="#" class="list-group-item character_list" id="'.$value["character_id"].'"/>'.$value["character_name"].'</a>');
		 								}
									?>
									</ul>
								</div>
								<div class="panel-footer">
									<button type="button" class="btn btn-info" id="show_create_character"> Create character </button>
								</div>
							</div>
						</div>


						<div id="sub_tab_create_character" style="display: none;">
							<div class="panel panel-default">
								<h3 class="panel-heading">Create Character <span id="hide_create_character" class="glyphicon glyphicon-remove clickable" style="float:right;"></span></h3>
								<div class="panel-content">
									<div class="content_inside_wrap">
										<div class="input-group">
							             	<span class="input-group-addon" id="basic-addon1">Character name</span>
							               	<input type="text" id="nick" class="form-control" aria-describedby="basic-addon1">
											<div class="input-group-btn">
							              		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							               			<span id="race_select_title"> Select race </span>

							               			<span class="caret"></span>
							               		</button>
							               		<ul class="dropdown-menu" role="menu">
							               		<?php
							               			$res = Db::getInstance()->query("SELECT * FROM `dn_race`");
			          								foreach($res as $val) {
			              								echo '<li><a href="#" id="r_'.$val["race_id"].'" class="race_a" onclick="getRaceStats(this.id)">'.$val["race_name"].'</a></li>';
			  										}
						                		?>
						                		</ul>
											</div>
							            </div>
							            <div class="btn-group" id="abilitydropdown" style="display: none">
							            	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							            		<span id="ability_select_title"> Select ability </span>
							            		<span class="caret"></span>
							            	</button>
							            	<ul class="dropdown-menu" role="menu">

							            	</ul>
							            </div>
							            <div id="stat_wrapper" style="display:none">
								            <label for="stat_strength"> Strength </label>
								            <div class="input-group">
								            	<div class="input-group-btn">
								            		<button type="button" class="btn btn-default chngStats" data-way="minus"> - </button>
								            	</div>
								            	<input type="text" id="stat_strength" disabled="disabled" class="form-control inside_center statinput" />
								            	<div class="input-group-btn">
								            		<button type="button" class="btn btn-default chngStats" data-way="plus"> + </button>
								            	</div>
								            </div>
								            <label for="stat_agility"> Agility </label>
								            <div class="input-group">
								            	<div class="input-group-btn">
								            		<button type="button" class="btn btn-default chngStats" data-way="minus"> - </button>
								            	</div>
								            	<input type="text" id="stat_agility" disabled="disabled" class="form-control inside_center statinput" />
								            	<div class="input-group-btn">
								            		<button type="button" class="btn btn-default chngStats" data-way="plus"> + </button>
								            	</div>
								            </div>
								            <label for="stat_perception"> Perception </label>
								            <div class="input-group">
								            	<div class="input-group-btn">
								            		<button type="button" class="btn btn-default chngStats" data-way="minus"> - </button>
								            	</div>
								            	<input type="text" id="stat_perception" disabled="disabled" class="form-control inside_center statinput" />
								            	<div class="input-group-btn">
								            		<button type="button" class="btn btn-default chngStats" data-way="plus"> + </button>
								            	</div>
								            </div>
								            <label for="stat_endurance"> Endurance </label>
								            <div class="input-group">
								            	<div class="input-group-btn">
								            		<button type="button" class="btn btn-default chngStats" data-way="minus"> - </button>
								            	</div>
								            	<input type="text" id="stat_endurance" disabled="disabled" class="form-control inside_center statinput" />
								            	<div class="input-group-btn">
								            		<button type="button" class="btn btn-default chngStats" data-way="plus"> + </button>
								            	</div>
								            </div>
								            <label for="stat_intelligence"> Intelligence </label>
								            <div class="input-group">
								            	<div class="input-group-btn">
								            		<button type="button" class="btn btn-default chngStats" data-way="minus"> - </button>
								            	</div>
								            	<input type="text" id="stat_intelligence" disabled="disabled" class="form-control inside_center statinput" />
								            	<div class="input-group-btn">
								            		<button type="button" class="btn btn-default chngStats" data-way="plus"> + </button>
								            	</div>
								            </div>
								            <label for="stat_talent"> Talent </label>
								            <div class="input-group">
								            	<div class="input-group-btn">
								            		<button type="button" class="btn btn-default chngStats" data-way="minus"> - </button>
								            	</div>
								            	<input type="text" id="stat_talent" disabled="disabled" class="form-control inside_center statinput" />
								            	<div class="input-group-btn">
								            		<button type="button" class="btn btn-default chngStats" data-way="plus"> + </button>
								            	</div>
								            </div>
								        </div>
								        <div class="ability_selected" id="a_s_0" style="width:100%" data-level="1" data-a-id=""></div>
								        <div class="ability_selected" id="a_s_1" style="width:100%" data-level="1" data-a-id=""></div>
								        <div class="ability_selected" id="a_s_2" style="width:100%" data-level="1" data-a-id=""></div>
								        <div class="ability_selected" id="a_s_3" style="width:100%" data-level="2" data-a-id=""></div>
								        <div class="ability_selected" id="a_s_4" style="width:100%" data-level="2" data-a-id=""></div>
								        <div class="ability_selected" id="a_s_5" style="width:100%" data-level="3" data-a-id=""></div>
					        </div>
								</div>
								<h4 class="panel-footer">
									<button type="button" class="btn btn-success" id="create_character"/>Create</button>
								</h4>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div id="sub_tab_sessions">
							<div class="panel panel-default">
								<h3 class="panel-heading">Sessions</h3>
								<div class="panel-content">
									<ul class="list-group">
									<?php
		 								$sessions = Db::getInstance()->query("SELECT * FROM dn_session WHERE 1");
		 								foreach ($sessions as $value) {
		 									echo('<a href="#" class="list-group-item session_list" id="'.$value["session_id"].'"/>'.$value["session_name"].'</a>');
		 								}
									?>
									</ul>
								</div>
								<div class="panel-footer">
									<button type="button" class="btn btn-info"> Create Session </button>
								</div>
							</div>
						</div>

						<div id="sub_tab_ability" style="display:none">
							<div class="panel panel-default">
								<input type="hidden" id="hidden_ability_id" value="" />
								<h3 class="panel-heading">Select Abilities</h3>
								<div class="panel-content">
									<center><h2 id="a_name">Název</h3></center>
									<p id="a_primary_stat"> Primární atribut </p>
									<p id="a_requirments"> Požadavky </p>
									<p id="a_type"> Typ </p>
									<div id="lvl_1">
										<h3> Level 1 <input type="radio" class="lvl_selection" id="l_1" name="lvl_select"> </h3>
										<p class="a_description"> dslfhjkshfkjsdfkjshdfkjhsdkfshdffdfsdfdsf </p>
									</div>
									<div id="lvl_2">
										<h3> Level 2 <input type="radio" class="lvl_selection" id="l_2" name="lvl_select"> </h3>
										<p class="a_description"> dslfhjkshfkjsdfkjshdfkjhsdkfshdffdfsdfdsf </p>
									</div>
									<div id="lvl_3">
										<h3> Level 3 <input type="radio" class="lvl_selection" id="l_3" name="lvl_select"> </h3>
										<p class="a_description"> dslfhjkshfkjsdfkjshdfkjhsdkfshdffdfsdfdsf </p>
									</div>
								</div>
								<div class="panel-footer">
									<button type="button" id="ability_btn_true" class="btn btn-info"> Add ability </button>
									<button type="button" id="ability_btn_false" class="btn btn-danger" style="display: none"> Add ability </button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="tab_library" style="display:none">
					topkek
				</div>

				<div class="tab_settings" style="display:none">
					toplel
				</div>



			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-success disabled" id="enter_game"> ENTER </button>
			</div>
		</div>
	</div>

</body>
</html>
