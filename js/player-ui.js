function onLoad(){
 var items = document.getElementsByClassName("item");
 for (var i = items.length - 1; i >= 0; i--) {
 	items[i].onclick=function(){
 		getItemInfo(this.getAttribute("data-item-id"));
 	};
 };

 $('.ui-window').each(function() {
  $(this).draggable({
   start: function() {
    $( this ).css("z-index",100);
   },
   stop: function() {
   	$('.ui-window').css("z-index",0);
    $( this ).css("z-index",1);
    //$( this ).css("height","auto");
   },
   handle: "p",
   containment: "parent",
   cursor: "move",
   scroll: false
  });
 });
 $( ".ui-window" ).dblclick(function () {
  $(this).draggable( 'disable' );
  $(this).animate({ left: 0, top: 0 }, "slow", function(){
    $(this).draggable( 'enable' );
  });

 });
 $('.ui-window-close').click(function() {
  $(this).parent().parent().hide();
  name=getModConfig(this).name;
  $("#sidemenu").find('[uadata="'+name+'"]').fadeIn("slow");
 });
 $('.icon-image').click(function() {
  name=$(this).attr("uadata");
  $("#"+name).fadeIn("slow");
  $(this).hide();
  //name=getModConfig(this).name;
  //$("#sidemenu").find('[uadata="'+name+'"]').fadeIn("slow");
 });
 $('.ui-window-slide').click(function() {

  $(this).parent().parent().draggable( 'disable' );

  height=getModConfig(this).height;
  if((height.indexOf("%") != -1)){
    a = parseInt(height.substring(0, height.length-1));
    h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    h = Math.min((a/100)*h);
    console.log(h);
  }
  if($(this).parent().parent().find('.ui-window-content').css('display') == 'none'){
    $(this).parent().parent().css( 'height', 'auto' );
    $(this).parent().parent().css( 'max-height', h );
    $(this).parent().parent().find('.ui-window-content').css('display','block');
    // i have no idea what is going on. too drunk, fix later
    newtop=0;
    if(height == "100%")newtop = countTop(h, $(this).parent().parent().css('top'));
    else newtop = countTop(h, $(this).parent().parent().css('top'))-1;
    // ----
    $(this).parent().parent().animate({top:newtop},200);
    $(this).parent().parent().find('.ui-window-content').animate({height:h},200, function(){
      $(this).parent().draggable( 'enable' );
    });
    //$(this).parent().parent().css( 'height', height );
  }
  else{
   $(this).parent().parent().css( 'height', 'auto' );
   $(this).parent().parent().find('.ui-window-content').animate({height:0},200, function(){
     $(this).parent().draggable( 'enable' );
     $(this).parent().find('.ui-window-content').css('display','none');
   });

  }
  /*
  $(this).parent().parent().css( 'height', 'auto' );

  $(this).parent().parent().find('.ui-window-content').slideToggle("slow", function(){
    $(this).parent().draggable( 'enable' );
    //$(this).parent().css( 'height', 'enable' );
  });
  */
});

}
window.onload = onLoad;
function getItemInfo(id){
 $.ajax({
  url: "./script/getItemInfo.php",
  type: "POST",
  data: "id="+id
 }).done(function(data){
  $("#description").html(data);
 });
}
function getModConfig(element){
  return (JSON.parse( $(element).parent().parent().find('.mod-configuration').val().replace(/'/g, '"') ));
}
function countTop(height, top){
  innerHeight = window.innerHeight;
  i = top.indexOf("px");
  if(i >= -1){
    top = top.substring(0, i);
  }
  height = parseInt(height);
  top = parseInt(top);
  innerHeight = parseInt(innerHeight);
  console.log(height+ ', ' +top+ ', ' +innerHeight);
  if(height+top>innerHeight){
    top = innerHeight - height;
    return top;
  }else{
    return top;
  }
}
