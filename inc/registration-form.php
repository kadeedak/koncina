<html>
<head>
<title> LEFIK == <-> </title>
<script type="text/javascript" src="./js/jquery.js"></script>	
<script type="text/javascript" src="./js/registration-form.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="./style/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="./style/registration-form.css" />

</head>
<body>
  <div class="container">
    <div class="inner-container">
    <div class="row" style="padding-top:90px;">
      
      <div class="col-md-12">
        <div id="form-middle">
          <span id="error_msg"></span>
          <div class="input-group">
            <span class="input-group-addon" style="width:90px;">Username</span>
            <input type="text" id="username" class="form-control" style="width:270px;" />
          </div>
          <div class="input-group">
            <span class="input-group-addon" style="width:90px;">Password</span>
            <input type="password" id="pass" class="form-control" style="width:270px;" />
          </div>
          <div class="input-group">
            <span class="input-group-addon" style="width:90px;">E-mail</span>
            <input type="text" id="email" class="form-control" style="width:270px;" />
          </div>
          <div class="btn-group">
            <button type="button" class="btn btn-default" id="register_user"> Sign Up </button>
          </div>
        </div>  
     <!--   
        <div class="btn-group">
          <button type="button" class="btn btn-small dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="racedropdown">
            <span id="asdf"></span>Choose your race <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu" id="race">
          <?php
            $res = Db::getInstance()->query("SELECT * FROM `dn_race`");
            foreach($res as $val) { 
              echo '
              <li id="'.$val["race_id"].'" onclick="getRaceStats(this.id)"><a href="#">'.$val["race_name"].' </a></li>';        
            }
          ?>  

    
          </ul> 
          <div id="shownabilities"> 
           <div class="btn-group">
          <button type="button" class="btn btn-small dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="abilitydropdown">
            <span id="ability"></span>Choose your ability <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
          
			</ul></div>
        </div>
      </div>
      -->
      
      </div>
      
      
      <div class="col-md-6">
             <div id="statsdisplay">
         <center> <span id="racename" style="font-size:25px; line-height:30px; "> </span> </center>
        <table id="table">
          <tr> <td id="str">Strength:&nbsp;</td><td id="strval"></td> <td id="strbut"></td></tr>
          <tr> <td id="agi">Agility:&nbsp;</td><td id="agival"></td> <td id="agibut"></td></tr>
          <tr> <td id="end">Endurance:&nbsp;</td><td id="endval"></td> <td id="endbut"></td></tr>
          <tr> <td id="intl">Inetelect:&nbsp;</td><td id="intlval"></td> <td id="intlbut"></td></tr>
          <tr> <td id="per">Perception:&nbsp;</td><td id="perval"></td> <td id="perbut"></td></tr>
          <tr> <td id="tal">Talent:&nbsp;</td><td id="talval"></td> <td id="talbut"></td></tr>
        </table>
          </div>
      </div>
    </div>
  </div>
      <div class="col-md-4">
        <div id="abilitylevel1">

        </div>
      </div>
      <div class="col-md-4">
        <div id="abilitylevel2">

        </div>
      </div>
      <div class="col-md-4">
        <div id="abilitylevel3">

        </div>
      </div>
  </div>
</body>
</html>