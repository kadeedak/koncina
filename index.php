<?php include("./inc/init.php"); ?>
<html>
 <head>
  <link rel="stylesheet" type="text/css" href="./style/bootstrap.min.css" />
  <link rel="stylesheet" href="./jquery-ui-1.11.4.custom/jquery-ui.min.css">
  <script src="./js/jquery.js"></script>
  <script src="./jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
  <script src="./jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
  <script type="text/javascript" src="./js/bootstrap.min.js"></script>
  <meta charset="utf-8">
  <script>
   //fix tooltip collisions
   $(function() {
    $.widget.bridge('uitooltip', $.ui.tooltip);
    $( document ).tooltip();
   });
   //fix firefox spacebar scroll
   window.onkeydown = function(e) {
    return !(e.keyCode == 32);
   };
   //disable default image dragging
   $('img').on('dragstart', function(event) { event.preventDefault(); });
  </script>
 </head>
 <body>
  <?php
   $page=1;
   if(isset($_GET['page']))$page = $_GET['page'];
   switch($page){
    case 1: ;
    case 'log': include("./inc/login-form.php"); break;
    case 2: ;
    case 'reg': include("./inc/registration-form.php"); break;
    case 3: ;
    case 'char': include("./inc/char_select.php"); break;
    case 4: ;
    case 'main': include("./inc/player-ui.php"); break;
    case 5: ;
    case 'logout': include("./inc/logout.php"); break;
    case 6: ;
    case 'set': include("./inc/settings.php"); break;
    case 7: ;
    case 'lib': include("./inc/library.php"); break;
    default: include("./inc/player-ui.php"); break;
   }
  ?>
 </body>
</html>
