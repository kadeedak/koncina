<link rel="stylesheet" type="text/css" href="./style/chat.css" />
  <div id='chat-container'>
  <div id="chat-messages">
   <div id="messages">
    <span id="firstload"></span>
   </div>
  </div>
 <div id="textarea">
  <textarea id="message" class="col-md-12"></textarea>
  <select id="reciever" class="col-md-6">
   <option value="all"> All </option>
   <option value="dm"> DM </option>
   <?php
    $chars = Session::getCurrent()->getCharacters();
    for($i=0;$i<count($chars);$i++)echo '<option value="'.$chars[$i]['character_id'].'">'.$chars[$i]['character_name'].'</option>';
   ?>
   </select>
   <button id="send-message" class="btn btn-primary col-md-6"> SEND </button> 
  </div>
</div>

<script src="./js/chat.js"></script>