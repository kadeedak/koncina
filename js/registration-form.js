var abilityArr;
$(document).ready(function(){
    $("#register_user").click(function(){
        registerUser();
    });
});

function defaultRequest(url, data, callback){
  xmlhttp=new XMLHttpRequest();
  xmlhttp.open("POST",url,true);
  
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
        callback();
      }
    }

    xmlhttp.send(data);
}

function getRaceStats(id){
    if(id!=666){
    defaultRequest("./script/getRaceStats.php", "id="+id, function(){
    x = xmlhttp.responseXML.documentElement;
    //alert(new XMLSerializer().serializeToString(xmlhttp.responseXML));
    name = x.childNodes[6].textContent;
    strength = x.childNodes[0].textContent;
    agility = x.childNodes[1].textContent;
    endurance = x.childNodes[2].textContent;
    inteligence = x.childNodes[3].textContent;
    perception = x.childNodes[4].textContent;
    talent = x.childNodes[5].textContent;
    var statsobj = {
        "str":strength,
        "agi":agility,
        "end":endurance,
        "intl":inteligence,
        "per":perception,
        "tal":talent
    };
    $("#racename").html(name);
    $("#statsdisplay").css("display", "block");
    $("#strval").html(strength);
    $("#agival").html(agility);
    $("#endval").html(endurance);
    $("#intlval").html(inteligence);
    $("#perval").html(perception);
    $("#talval").html(talent);
    $("#strbut").html('<input type="button" class="str statbutton" data-value="'+strength+'" data-change="-1" value="-" />');
    $("#strbut").append('<input type="button" class="str statbutton" data-value="'+strength+'" data-change="1" value="+" />');
    $("#agibut").html('<input type="button" class="agi statbutton" data-value="'+agility+'" data-change="-1" value="-" />');
    $("#agibut").append('<input type="button" class="agi statbutton" data-value="'+agility+'" data-change="1" value="+" />');
    $("#endbut").html('<input type="button" class="end statbutton" data-value="'+endurance+'" data-change="-1" value="-" />') ;
    $("#endbut").append('<input type="button" class="end statbutton" data-value="'+endurance+'" data-change="1" value="+" />');
    $("#intlbut").html('<input type="button" class="intl statbutton" data-value="'+inteligence+'" data-change="-1" value="-" />');
    $("#intlbut").append('<input type="button" class="intl statbutton" data-value="'+inteligence+'" data-change="1" value="+" />');
    $("#perbut").html('<input type="button" class="per statbutton" data-value="'+perception+'" data-change="-1" value="-" />');
    $("#perbut").append('<input type="button" class="per statbutton" data-value="'+perception+'" data-change="1" value="+" />');
    $("#talbut").html('<input type="button" class="tal statbutton" data-value="'+talent+'" data-change="-1" value="-" />');
    $("#talbut").append('<input type="button" class="tal statbutton" data-value="'+talent+'" data-change="1" value="+" />');
    $(".str, .agi, .end, .intl, .per, .tal").click(function(){changeStats($(this).attr('class'), $(this).attr('data-value'), $(this).attr('data-change'), statsobj);});
    });	
    $("#tospend").html('Points to spend: 0');
}else{ 
  $("#statsecho span").empty(); 
}
    setTimeout(function(){showAbilities()}, 500);  
}

    function changeStats(buttonClass, dataVal, dataChange, staticStats){
        var somearray = buttonClass.split(" ");
        buttonClass = somearray[0];
        var variableStats = getVariableStatsObject();
        var sum = 0;
        var fittingStaticStat;
        var fittingVariableStat;
        $.each(staticStats, function(key, value){
            if(key == buttonClass){
              fittingStaticStat = parseInt(value);
            } 
        });
        $.each(variableStats, function(key, value){
            if(key == buttonClass){
              fittingVariableStat = parseInt(value);
            }
            sum += parseInt(value);
        });
        var passed = true;
        if(sum>=0 && dataChange>0){
            alert('No way, sum must be 0 maximally');
            passed = false;
        }
        else{
            if((fittingVariableStat-fittingStaticStat==2) && dataChange>0){
                alert('You can change an atribute only by 2 points');
                passed = false;
            }
            if((fittingStaticStat-fittingVariableStat==2) && dataChange<0){
                alert('You can change an atribute only by 2 points'); 
                passed = false;
            } 
        }
        if(passed){
            var diff = parseInt(dataVal) + parseInt(dataChange);
            $("."+buttonClass).attr("data-value", diff);
            $("#"+buttonClass+"val").html(diff);
            meetRequirments();
        }
        var varStatsObject = getVariableStatsObject();
        var helperTim=0;
        $.each(varStatsObject, function(key, value){
            helperTim+=parseInt(value);
        });
        //$("#tospend").html("Points to spend: "+(helperTim+(-2*helperTim)));        
    }

    function getVariableStatsObject(){
        var statsobj = {
            "str":$(".str").attr('data-value'),
            "agi":$(".agi").attr('data-value'),
            "end":$(".end").attr('data-value'),
            "intl":$(".intl").attr('data-value'),
            "per":$(".per").attr('data-value'),
            "tal":$(".tal").attr('data-value')
        };
        return statsobj;
    } 

    function showDetails(id){
        $("#dialog").dialog( "open" );
    }
            
    function showAbilities(){        
        $.ajax({
            url:"./script/getAbilities.php",
            type:"POST",
            data:""
        }).done(function(data){
            abilityArr = JSON.parse(data);
            $("#abilitydropdown").css("display", "block");
            $("#abilitydropdown").find("ul").html("");
            $.each(abilityArr, function (key, value){
                $("#abilitydropdown").find("ul").append("<li><a onclick='abilityDetail("+value['ability_id']+")' id='ability_"+value["ability_id"]+"' href='#'>"+value['ability_name']+"</a></li>");               
            });
        });
        setTimeout(function(){meetRequirments()}, 500);
    }

    function meetRequirments(){
        var currentAttributes = {
            "race" : $("#racename").html(),
            "strength" : getVariableStatsObject()["str"],
            "agility" : getVariableStatsObject()["agi"],
            "endurance" : getVariableStatsObject()["end"],
            "intelligence" : getVariableStatsObject()["intl"],
            "perception" : getVariableStatsObject()["per"],
            "talent" : getVariableStatsObject()["tal"]
        };
        $.each(abilityArr, function (key, value){
            var keys = Object.keys(value["ability_requirment"]);
            var met = true;
            $.each(keys, function(k, v){
                $.each(currentAttributes, function(ke, va){
                    if(v == ke){
                        if(isNumeric(va)){
                            if(va < value["ability_requirment"][v]){
                                met = false;
                            }
                        }else{
                            if(va != value["ability_requirment"][v]){
                                met = false;
                            }
                        }
                    }
                });
            });
            if(met){
                $("#ability_"+value["ability_id"]).css("color", "#00B900");
                $("#ability_"+value["ability_id"]).focus(function(){
                    $(this).css("color", "#00B900");
                });
                $("#ability_"+value["ability_id"]).hover(function(){
                    $(this).css("color", "#00F600");
                });
                $("#ability_"+value["ability_id"]).mouseleave(function(){
                    $(this).css("color", "#00B900");
                });
            }else{
                $("#ability_"+value["ability_id"]).css("color", "#C80A00");
                $("#ability_"+value["ability_id"]).focus(function(){
                    $(this).css("color", "#C80A00");
                });
                $("#ability_"+value["ability_id"]).hover(function(){
                    $(this).css("color", "#FF0D00");
                });
                $("#ability_"+value["ability_id"]).mouseleave(function(){
                    $(this).css("color", "#C80A00");
                });
            }
        });
    }

    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function abilityDetail(id){
        var res = $.grep(abilityArr, function(e){ return e["ability_id"] == id; });
        alert(res[0]["ability_id"]);
    }

    function registerUser(){
        var validForm = true;
        var error_msg = "";
        var username = $("#username").val();
        var pass = $("#pass").val();
        var email = $("#email").val();
        if(username.length<4 || username.length>24 || containsSpecialCharacters(username)){
            validForm = false;
            error_msg = "USERNAME : must be >4; must be <24; must not contain special characters. ";
        }
        if(pass.length<6 || pass.length>1024){
            validForm = false;
            error_msg += "PASSWORD : between 6 and 1024 omg. ";
        }
        if(!validateEmail(email)){
            validForm = false;
            error_msg += "E-MAIL : is simply not an e-mail. ";
        }
        if(validForm){
            alert("lol");
            $.ajax({
                url: "./script/registerUser.php",
                type: "POST",
                data: {username: username, password: pass, email: email}
            }).done(function(data){
                data = JSON.parse(data);
                if(data){
                    if(data["passed"]){
                        
                    }else{
                        $("#error_msg").html(data["msg"]);
                        $("#error_msg").fadeIn(200);
                    }
                }
            });
        }else{
            alert(error_msg);
        }
    }

    function containsSpecialCharacters(str){
        if(/^[a-zA-Z0-9- ]*$/.test(str) == false) {
            return true;
        }else{
            return false;
        }
    }

    function validateEmail(email) {
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        return re.test(email);
    }