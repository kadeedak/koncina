//Send chat message AJAX function
function sendChatMessage(to, text){
 if(!text)return;
 $.ajax({
  url: "./script/sendChatMessage.php",
  type: "POST",
  data: "to="+to+"&text="+text
 }).done(function(){
  getChatMessages();
 });
}
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
  console.log(data+"asdasdasdsad");
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

setInterval(function(){
  getChatMessages();
 },1000);
