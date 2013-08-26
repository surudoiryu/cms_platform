$(document).ready(function() {
  var UserName	=	"ungahstudios";
  $.getJSON("http://api.twitter.com/1/statuses/user_timeline/" + UserName + ".json?callback=?", function(data) {
	 
	 $("#tweet1naam").html('<b><a href="http://twitter.com/#!/ungahstudios" target="_blank" style="color: #fff;">' + data[0].user.screen_name + ':</a></b>');
	 $("#tweet1text").html('<i>' + data[0].text + '<i>');
	 $("#tweet1datum").html(data[0].created_at);
	 
	 $("#tweet2naam").html('<b><a href="http://twitter.com/#!/ungahstudios" target="_blank" style="color: #fff;">' + data[1].user.screen_name + ':</a></b>');
	 $("#tweet2text").html('<i>' + data[1].text + '<i>');
	 $("#tweet2datum").html(data[1].created_at);
  });
});