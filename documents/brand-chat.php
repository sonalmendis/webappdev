<?php
include_once '../dbconfig.php';
?>
<?php
//The session already loads the data from the login.php part of it
session_start();

//Variables

$chat_id = $_GET['chatid'];
$email = $_SESSION['email'];
$user_id = $_SESSION['ID'];

//If there is no username set then this form will appear and exit anything below it i.e. not showing the chat
if(!isset($_SESSION['email'])) {
?>
	<form name="form2" action="../login.php" method="post">
	<table border="1">
	<tr>
	<td>Username: </td>
	<td><input type="text" name="username"></td>
	</tr>
	<tr>
	<td>Password:</td>
	<td><input type="password" name="password"></td>
	</tr>
	<tr>
	<td colspan="2"><input type="submit" name="submit" value="Login"></td>
	</tr>
		<tr>
	<td colspan="2"><a href="register.php">Register here to get an account</a></td>
	</tr>
	</table>
</form>
	


<?php
exit;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Capsule</title>

<link rel="stylesheet" href="css/normalize.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" />
<link rel="stylesheet" href="css/brand-style.css" type="text/css" />

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
function submitChat(){
if(form1.msg.value == '') {
alert('Enter a message!');
return;
}


var premsg = form1.msg.value;
var msg = premsg.replace(/'/g, "''");
var xmlhttp = new XMLHttpRequest();
	
xmlhttp.onreadystatechange = function(){
if(xmlhttp.readyState==4&&xmlhttp.status==200) {
document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
}
}
xmlhttp.open('GET','../brand-chat-insert.php?chatid=<?php echo $chat_id ?>&msg='+msg, true);
xmlhttp.send();
	
}

$(document).ready(function(e) {
	
	$.ajaxSetup({cache:false});
	$('#chatlogs').load('../brand-logs.php?chatid=<?php echo $chat_id ?>');
	setInterval(function() {$('#chatlogs').load('../brand-logs.php?chatid=<?php echo $chat_id ?>')}, 3000);
});




</script>
</head>
<body>
<div class="row">
<div class="col-md-2 left-side">
<h1 style="text-align:center;margin:60px 0;">Capsule</h1>
<div class="chats container-push">

<a href= "../logout.php"class="button"><h3 style="padding-bottom:10px;margin-bottom:40px;">Logout</h3></a>
<h3 style="padding-bottom:10px;border-bottom:1px solid #505070;">Chats</h3>
    <?php
	//The login details given by the login form in index.php

	

	$sql="SELECT * FROM user_chat_records WHERE brand_id='$user_id' ORDER BY ID DESC";
	$result_set=mysql_query($sql);
	while($row=mysql_fetch_array($result_set))
	{
		?>


<!-- Has to pull down a table and essentially display the user_chat_records table which corresponds to the user ID already logged in -->
<div class="chat-link"><a href="brand-chat.php?chatid=<?php echo $row['ID'] ?>"><?php echo $row['ID'] ?></p></a></div>


<?php
	}
	?>
</div>
</div>



<div class="col-md-6 right-side" style="padding-left:50px;">
<h1 style="margin-top:60px;">Chat</h1>

<div class="row">
<div class="col-md-6">

<div id="chatlogs" style="width:100%;margin-top:30px;"> 

</div>

<form name = "form1" style="margin-top:30px;">
Your Message: <br />
<textarea name= "msg" style="width:200px; height: 70px"></textarea><br />
<a href= "#" onclick="submitChat()" class="button" style="display:inline-block;padding:20px;border:1px solid #EAEAEA;color:black;text-decoration:none;margin-top:20px;border-radius:6px;">Send</a><br /><br />
</form>


</div>
</div>

</div>
</div>
</body>
</html>