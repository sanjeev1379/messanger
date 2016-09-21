<html>
<head>
	<title>Messenger</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width-device-width scale=1.0" />
	<link rel="shortcut icon" href="image/icon.png" ></link>
	<link rel="stylesheet" href="css/bootstrap.min.css" ></link>
	<script type="text/javascript" src="js/script.js" ></script>
	<script type="text/javascript" src="js/jquery.min.js" ></script>
	<script type="text/javascript" src="js/bootstrap.min.js" ></script>

	<style type="text/css">
	html {
		height: 100%;
	}
	body {
		margin: 0px;
		padding: 0px;
		height: 100%;
		font-family: Helvetica, Arial, Sans-serif;
		font-size: 14px;
	}
	.msg-container {
		width: 100%;
		height: 100%;
	}
	.header {
		background-color:#827E7E;
		width: 100%;
		height: 50px;
		border-bottom: 1px solid #CCC;
		font-size: 20px;
		font-weight: normal;
	}
	#font_id{
		text-align: left;
		font-size:40px;
		letter-spacing:1px;
		font-family:Playbill;
		color:black;
		margin-left:10%;
		text-shadow:1px 1px blue;
	}
	#right_id{
		margin-top:1%;
		float:right;
		font-size:24px;
		letter-spacing:2px;
		font-family:Playbill;
		color:black;
		margin-right:7%;
		text-shadow:1px 1px blue;
	}
	.msg-area {
		height: calc(100% - 102px);
		width: 100%;
		background-color:#FFF;
		overflow-y: scroll;
	}
	.msginput {
		padding: 5px;
		margin: 10px;
		font-size: 14px;
		width: calc(100% - 20px);
		outline: none;
	}
	.bottom {
		width: 100%;
		height: 50px;
		position: fixed;
		bottom: 0px;
		border-top: 1px solid #CCC;
		background-color: #EBEBEB;
	}
	#whitebg {
		width: 100%;
		height: 100%;
		background-color: #FFF;
		overflow-y: scroll;
		opacity: 0.6;
		display: none;
		position: absolute;
		top: 0px;
		z-index: 1000;
	}
	#loginbox {
		width: 600px;
		height: 350px;
		border: 1px solid #CCC;
		background-color: #FFF;
		position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
		z-index: 1001;
		display: none;
	}
	@media only screen and (min-width:100px) and (max-width:600px){
		#loginbox {
			width: 300px;
			height: 350px;
			border: 1px solid #CCC;
			background-color: #FFF;
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			z-index: 1001;
			display: none;
		}
	}
	h1 {
		padding: 0px;
		margin: 20px 0px 0px 0px;
		text-align: center;
		font-weight: normal;
		margin-top:1%;
		font-size:250%;
		letter-spacing:1px;
		font-family:Playbill;
		color:black;
		text-shadow:1px 1px blue;
	}
	button {
		background-color: #43ACEC;
		border: none;
		color: #FFF;
		font-size: 16px;
		margin: 0px auto;
	}
	.buttonp {
		width: 150px;
		margin: 0px auto;
	}

	.msg {
		margin: 10px 10px;
		background-color: #f1f0f0;
		max-width: calc(45% - 20px);
		color: #000;
		padding: 10px;
		font-size: 14px;
	}
	.msgfrom {
		background-color: #0084ff;
		color: #FFF;
		margin: 10px 10px 10px 55%;
	}
	.msgarr {
		width: 0;
		height: 0;
		border-left: 8px solid transparent;
		border-right: 8px solid transparent;
		border-bottom: 8px solid #f1f0f0;
		transform: rotate(315deg);
		margin: -12px 0px 0px 45px;
	}
	.msgarrfrom {
		border-bottom: 8px solid #0084ff;
		float: right;
		margin-right: 45px;
	}
	.msgsentby {
		color: #8C8C8C;
		font-size: 12px;
		margin: 4px 0px 0px 10px;
	}
	.msgsentbyfrom {
		float: right;
		margin-right: 12px;
	}
	#bt{
		font-size:120%;
		font-weight:bold;
	}
	</style>
</head>
<body onload="checkcookie(); update();">
<div id="whitebg"></div>
<div id="loginbox">
<h1>Pick a Username:</h1>
<!--<p><input type="text" name="pickusername" id="cusername" placeholder="Pick a username" class="msginput"></p>-->
<div class="modal-body">
	<form role="form">
		<div class="form-group">
			<input type="text" name="pickusername" class="msginput" id="cusername" class="form-control" placeholder="Pick a Username...">
		</div>
		<div class="modal-footer">
			<button id="bt" class="btn btn-primary btn-block" onclick="chooseusername()">Choose Username</button>
		</div>
	</form>
</div>
<!--<p class="buttonp"><button onclick="chooseusername()">Choose Username</button></p>-->
</div>
<div class="msg-container">
	<div class="header" id=""><font id="font_id">Messenger</font><font id="right_id">Welcome</font></div>
	<div class="msg-area" id="msg-area"></div>
	<div class="bottom"><input type="text" name="msginput" class="msginput" id="msginput" onkeydown="if (event.keyCode == 13) sendmsg()" value="" placeholder="Enter your message here ... (Press enter to send message)"></div>
</div>
<script type="text/javascript">

var msginput = document.getElementById("msginput");
var msgarea = document.getElementById("msg-area");

function chooseusername() {
	var user = document.getElementById("cusername").value;
	document.cookie="messengerUname=" + user
	checkcookie()
}

function showlogin() {
	document.getElementById("whitebg").style.display = "inline-block";
	document.getElementById("loginbox").style.display = "inline-block";
}

function hideLogin() {
	document.getElementById("whitebg").style.display = "none";
	document.getElementById("loginbox").style.display = "none";
}

function checkcookie() {
	if (document.cookie.indexOf("messengerUname") == -1) {
		showlogin();
	} else {
		hideLogin();
	}
}

function getcookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function escapehtml(text) {
  return text
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
}

function update() {
	var xmlhttp=new XMLHttpRequest();
	var username = getcookie("messengerUname");
	var output = "";
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				var response = xmlhttp.responseText.split("\n")
				var rl = response.length
				var item = "";
				for (var i = 0; i < rl; i++) {
					item = response[i].split("\\")
					if (item[1] != undefined) {
						if (item[0] == username) {
							output += "<div class=\"msgc\" style=\"margin-bottom: 30px;\"> <div class=\"msg msgfrom\">" + item[1] + "</div> <div class=\"msgarr msgarrfrom\"></div> <div class=\"msgsentby msgsentbyfrom\">Sent by " + item[0] + "</div> </div>";
						} else {
							output += "<div class=\"msgc\"> <div class=\"msg\">" + item[1] + "</div> <div class=\"msgarr\"></div> <div class=\"msgsentby\">Sent by " + item[0] + "</div> </div>";
						}
					}
				}

				msgarea.innerHTML = output;
				msgarea.scrollTop = msgarea.scrollHeight;

			}
		}
	      xmlhttp.open("GET","get-messages.php?username=" + username,true);
	      xmlhttp.send();
}

function sendmsg() {

	var message = msginput.value;
	if (message != "") {
		// alert(msgarea.innerHTML)
		// alert(getcookie("messengerUname"))

		var username = getcookie("messengerUname");

		var xmlhttp=new XMLHttpRequest();

		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				message = escapehtml(message)
				msgarea.innerHTML += "<div class=\"msgc\" style=\"margin-bottom: 30px;\"> <div class=\"msg msgfrom\">" + message + "</div> <div class=\"msgarr msgarrfrom\"></div> <div class=\"msgsentby msgsentbyfrom\">Sent by " + username + "</div> </div>";
				msginput.value = "";
			}
		}
	      xmlhttp.open("GET","update-messages.php?username=" + username + "&message=" + message,true);
	      xmlhttp.send();
  	}

}

setInterval(function(){ update() }, 1000);
</script>
</body>
</html>
