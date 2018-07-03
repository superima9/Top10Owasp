$(document).ready(function (){
    var refresh = 300; //refresh interval in ms //chatInterval
    var $username = $("#username");
    var $conversation = $("#conversation");
    var $text_message = $("#text_message");
    var $send_message = $("#send_message");


  function sendMessage(){
    var user = $username.val();
    var mess = $text_message.val();


    $.get("./write2db.php", { username: user, message: mess});
    $text_message.val("");
    retrieveMessages();
    }

  function retrieveMessages() {
    $.get("./readfromdb.php", function(data){ $conversation.html(data); });
    }

  $send_message.click(function(){
    sendMessage();
  });

  setInterval(function () {
    retrieveMessages();
  }, refresh);

});
