var abilityArr;
var rqr_vals;
$(document).ready(function(){
	$(".nav a").click(function(){
		var open = $(this).attr("href").slice(1);
		$(".nav li").removeClass("active");
		$(this).parent().addClass("active");
		$("#wrapper > div").slideUp(400, function(){
			$("#wrapper > div.tab_"+open).slideDown(400);
		});
		console.log(open);
	});

	$("#show_create_character").click(function(){
		$(".character_list").removeClass("active");
		$(".session_list").removeClass("active");
		$("#enter_game").addClass("disabled");
		$("#sub_tab_display_characters").slideUp(400,function(){
			$("#sub_tab_create_character").slideDown(400);
		});
	});

	$("#hide_create_character").click(function(){
		$("#sub_tab_create_character").slideUp(400,function(){
			$("#sub_tab_display_characters").slideDown(400);
			$("#stat_wrapper").hide();
			$("#abilitydropdown").hide();
		});
		if($("#sub_tab_ability").is(":visible")){
			$("#sub_tab_ability").slideUp(400, function(){
				$("#sub_tab_sessions").slideDown(400);
			});
		}
	});

	$(".race_a").click(function(){
		showAbilities();
	});

	$("#ability_btn_true").click(function(){
		addAbility();
	});

	$(".character_list").click(function(){
		$(".character_list").removeClass("active");
		$(this).addClass("active");
		if($(".session_list").hasClass("active")) $("#enter_game").removeClass("disabled");
	});

	$(".session_list").click(function(){
		$(".session_list").removeClass("active");
		$(this).addClass("active");
		if($(".character_list").hasClass("active")) $("#enter_game").removeClass("disabled");
	});

	$("#enter_game").click(function(){
		enter_game();
	});
	$("#create_character").click(function(){
		create_character();
	});
});

function getRaceStats(id){
	$(".chngStats").unbind("click");
	$(".minus, .plus").unbind("click");
	$("#race_select_title").html($("#"+id).html());
	id = id.slice(2);
	$.ajax({
		url: "./script/getRaceStats.php",
		type: "POST",
		data: {id: id}
	}).done(function(data){
		data = JSON.parse(data);
		$("#stat_strength").val(data["race_strength"]);
		$("#stat_agility").val(data["race_agility"]);
		$("#stat_endurance").val(data["race_endurance"]);
		$("#stat_perception").val(data["race_perception"]);
		$("#stat_intelligence").val(data["race_intelligence"]);
		$("#stat_talent").val(data["race_talent"]);
		$("#stat_wrapper").fadeIn(400);
		$(".chngStats").click(function(){
			changeStats(data, $(this));
		});
	});
}

function changeStats(data, btn){
	var btn_c = btn.attr("data-way");
	var inpt = btn.parent().parent().find("input");
	var name = inpt.attr("id").slice(5);
	var val = parseInt(inpt.val());
	var def_val = parseInt(data["race_"+name]);
	if(btn_c == "minus"){
		if(def_val-val<2){
			inpt.val(val-1);
			meetRequirments();
		}
	}else if(btn_c == "plus"){
		if(val-def_val<2 && getSum(btn)<0){
			inpt.val(val+1);
			meetRequirments();
		}
	}else{
		alert("WTF!");
	}
}

function getSum(btn){
	var inpts = btn.parent().parent().parent().find("input");
	var sum = 0;
	$.each(inpts, function(k, v){
		sum+=parseInt($(this).val());
	});
	return sum;
}

function getStatValue(name){
	return $("#stat_"+name).val();
}

function showAbilities(){
	if($("#sub_tab_ability").is(":visible")){
		meetRequirments();
	}
    $.ajax({
        url:"./script/getAbilities.php",
        type:"POST"
    }).done(function(data){
        abilityArr = JSON.parse(data);
        $("#abilitydropdown").css("display", "block");
        $("#abilitydropdown").find("ul").html("");
        $.each(abilityArr, function (key, value){
            $("#abilitydropdown").find("ul").append("<li><a class='ability_select' id='ability_"+value["ability_id"]+"' href='#'>"+value['ability_name']+"</a></li>");
        	$("#ability_"+value["ability_id"]).click(function(){
        		abilityDetail(value['ability_id']);
			});
        });
    });
    //setTimeout(function(){meetRequirments()}, 500);
}

function abilityDetail(id){
    var res = $.grep(abilityArr, function(e){ return e["ability_id"] == id; });
    res = res[0];
    var vals = [];
    $.each(res["ability_requirment"], function(k, v){
    	vals.push(v);
    });
    rqr_vals = vals;
    $("#a_name").html(res["ability_name"]+" "+id);
    $("#a_primary_stat").html(res["ability_primary_attr"]);
    console.log(res["ability_description"]);
    $("#a_requirments").html("");
    $.each(vals, function(i, l){
    	if(Object.keys(l).length>0){
    		var cond = false;
    		$.each(l, function(key, val){
    			if(cond) $("#a_requirments").append(" OR ");
				$("#a_requirments").append("<span class='ability_req' id='line_"+key+"'>"+key+" => "+val+"</span>");
				cond = true;
    		});
    		$("#a_requirments").append("<br />");
    	}
    });
    $("#a_type").html(res["ability_type"]);
    $("#lvl_1 .a_description").html(res["ability_description"]["lvl1"]);
    $("#lvl_2 .a_description").html(res["ability_description"]["lvl2"]);
    $("#lvl_3 .a_description").html(res["ability_description"]["lvl3"]);
    $("#hidden_ability_id").val(id);
    if($("#sub_tab_ability").css("display")=="none"){
		$("#sub_tab_sessions").slideUp(400, function(){
			$("#sub_tab_ability").slideDown(400);
		});
	}
	meetRequirments();
}

function meetRequirments(){
	var met=false;
	var failed = [];
	$.each(rqr_vals, function(i, l){
		if(Object.keys(l).length>0){
			$.each(l, function(key, val){
	console.log("key: "+key+"; val: "+val);
				if(key == "race"){
					if($("#race_select_title").html() == val) met = true;
					else{
						failed.push(key);
					}
				}else{
					if(parseInt(getStatValue(key)) >= parseInt(val)){
						met = true;
					}else{
						failed.push(key);
					}
				}
			});
		}
	});
	blockAdding(met, failed);
}

function blockAdding(met, failed){
	$(".ability_req").css("color", "black");
	if(met){
		$("#ability_btn_false").hide();
		$("#ability_btn_true").show();

	}else{
		$("#ability_btn_true").hide();
		$("#ability_btn_false").show();
		$.each(failed, function(i, l){
			$("#line_"+l).css("color", "red");
			console.log(l);
		});
	}
}

//překopat, přidat argumenty, dneska pošašit
function addAbility(){
	var checked = false;
	var selected = false;
	var selected_level;
	var id = $("#hidden_ability_id").val();
	var res = $.grep(abilityArr, function(e){ return e["ability_id"] == id; });
	res = res[0];
	$(".lvl_selection").each(function(){
		if($(this).is(":checked")) checked = true;
	});
	$(".ability_selected").each(function(){
		if($(this).attr("data-a-id") == id){
			selected = true;
			selected_level = $(this).attr("data-level");
		}
	});
	if(checked && !selected){
		addAbilityHtml(res, id);
	}else{
		if(!checked) alert("you gotta select level");
		if(selected){
			alert("you already have this ability selected");

		}
	}
}

function addAbilityHtml(res, id){
	if($("#l_1").is(":checked")){
		if($("#a_s_0").html().length < 1){
			$("#a_s_0").html(res["ability_name"]+" lvl 1; ");
			$("#a_s_0").attr("data-a-id", id);
		}else if($("#a_s_1").html().length < 1){
			$("#a_s_1").html(res["ability_name"]+" lvl 1; ");
			$("#a_s_1").attr("data-a-id", id);
		}else if($("#a_s_2").html().length < 1){
			$("#a_s_2").html(res["ability_name"]+" lvl 1; ");
			$("#a_s_2").attr("data-a-id", id);
		}else alert("You already have 3 level 1 abilities");
	}else if($("#l_2").is(":checked")){
		if($("#a_s_3").html().length < 1){
			$("#a_s_3").html(res["ability_name"]+" lvl 2; ");
			$("#a_s_3").attr("data-a-id", id);
		}else if($("#a_s_4").html().length <1){
			$("#a_s_4").html(res["ability_name"]+" lvl 2; ");
			$("#a_s_4").attr("data-a-id", id);
		}else alert("You already have 2 level 2 abilities");
	}else{
		if($("#a_s_5").html().length <1){
			$("#a_s_5").html(res["ability_name"]+" lvl 3; ");
			$("#a_s_5").attr("data-a-id", id);
		}else alert("You already have 1 level 3 ability");
	}
}

function enter_game(){
	var char_id;
	var session_id;
	$(".character_list").each(function(k, v){
		if($(v).hasClass("active")){
			char_id = $(v).attr("id");
		}
	});
	$(".session_list").each(function(k, v){
		if($(v).hasClass("active")){
			session_id = $(v).attr("id");
		}
	});
	$.ajax({
		url: './script/ajaxCharSelect.php',
		type: 'POST',
		data: {char_id: char_id, session_id: session_id, ftion: "enterGame"}
	}).done(function(data){
		data = JSON.parse(data);
		if(data){
			$(location).attr("href", "./index.php?page=main");
		}
	});
}

function create_character(){
	if(pass_create_character()){
		var stats={};
		var abilities={};
		var name= $("#nick").val();	
		var race= $("#race_select_title").html();
		$(".statinput").each(function(){
			stats[$(this).attr("id").split("_")[1]] = $(this).val(); 
		});
		$(".ability_selected").each(function(){
			abilities[$(this).attr("data-a-id")] = $(this).attr("data-level");
		});
		$.ajax({
			type: "post",
			url: "./script/create_character.php",
			data:{name: name, stats: stats, abilities: abilities, race: race}
		}).done(function(data){
			console.log(data);
		});
	}
}

function pass_create_character(){
	var valid = true;
	var msg = "";
	$(".ability_selected").each(function(){
	  if($(this).html().length < 1){
	  	valid = false;
	  	msg = "Vyber všechny mocné dovednůstky";
	  }	
	});
	if($("#nick").val().length < 2 || $("#nick").val().length > 64){
		valid = false;
		msg = "Annoni už nejsou co bývali, vezmi nick a neotravuj";
	}

	if(!valid){
		alert(msg);
		return false;
	}else return true;
}