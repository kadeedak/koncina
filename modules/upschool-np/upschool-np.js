//Send chat message AJAX function

//Send chat message on click
$("#send-message").click(function() {
 sendChatMessage($("#reciever").val(),$("#message").val());
 $("#message").val("");
});
//Send chat message on keypress Enter
$("#message").keypress(function (e) {
 if(e.which == 13) {
  sendChatMessage($("#reciever").val(),$("#message").val());
  $("#message").val("");
  e.preventDefault();
 }
});
//chat collapse animation
$("#button-collapse").click(function(){
 $( "#fixed_pos" ).slideUp("slow");
});
$("#button-open").click(function(){
 $("#fixed_pos").slideDown("slow");
});

// ----------------------------------

function getChatMessages(){
 $.ajax({
  url: "./script/getChatMessages.php",
  type: "POST",
  data: "last="+$("#messages div").last().attr("data-id")
 }).done(function(data){
  if(!data){

  }else{
  //console.log(data+"asdasdasdsad");
  x=JSON.parse(data);
  $("#messages").html("");
  for (var i = x.length - 1; i >= 0; i--) {
   txt="<br /><div data-time='"+x[i].message_time+"' data-id='"+x[i].message_id+"' style='border-top:1px solid black;margin:0px;'><span id='"+i+"' style='color:blue'>"+x[i].name_f+"</span> -> <span style='color:red'>"+x[i].name_t+"</span> : "+x[i].message_text+"</div>";
   $("#messages").html($("#messages").html()+txt);
   $("#messages").each( function(){
   var scrollHeight = Math.max(this.scrollHeight, this.clientHeight);
   this.scrollTop = scrollHeight - this.clientHeight;
   });
  };

  }

 });

}
function getInfoList(){
 $.ajax({
  url: "./modules/upschool-np/upschool-np-scripts.php",
  type: "POST",
  data: "function=getInfoList"
}).done(function(data){
  writeInfoList(data);
 });
}
function getInfoChar(id){
  $.ajax({
   url: "./modules/upschool-np/upschool-np-scripts.php",
   type: "POST",
   data: "function=getInfoChar&id="+id
 }).done(function(data){
   writeInfoChar(data);
 });
}
function writeInfoList(data){
 x=JSON.parse(data);
 $("#np-container").html("");
 for (var i = x.length - 1; i >= 0; i--) {
 txt="<br /><div data-id='"+x[i].id+"' style='border-top:1px solid black;margin:0px;'><span id='"+i+"' style='color:blue' onclick='getInfoChar("+x[i].id+");'>"+x[i].name+"</span></div>";
  $("#np-container").html($("#np-container").html()+txt);
 }
}
function writeInfoChar(data){
 console.log(data);
 x=JSON.parse(data);
 console.log(x);
 $("#np-container").html("");
 txt="<br /><div data-id='"+x.id+"' style='border-top:1px solid black;margin:0px;'>\
   <span style='color:blue'>"+x.name+"</span><br />\
   <span>str:"+x.strength+"</span><br />\
   <span>agi:"+x.agility+"</span><br />\
   <span>end:"+x.endurance+"</span><br />\
   <span>int:"+x.intelligence+"</span><br />\
   <span>per:"+x.perception+"</span><br />\
   <span>tal:"+x.talent+"</span><br />\
   <span>HP:"+x.c_health+"/"+x.health+"</span><br />\
   <span>EN:"+x.c_capacity+"/"+x.capacity+"</span>\
   <span>MP:"+x.c_energy+"/"+x.energy+"</span><br />\
   <span style='color:blue' onclick='getInfoList();'>back</span>\
   </div>";
   $("#np-container").html(txt);
}
getInfoList();
