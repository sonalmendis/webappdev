<?php
include_once '../dbconfig.php';
?>
<?php
//The session already loads the data from the login.php part of it
session_start();

//Variables

$user_name = $_SESSION['email'];
$user_id = $_SESSION['ID'];

//If there is no email set then this form will appear and exit anything below it i.e. not showing the chat
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
</head>
<body>
<div class="row">
<div class="col-md-2 left-side">
<h1 style="text-align:center;margin:60px 0;">Capsule</h1>
<div class="chats container-push">

<a href= "../brand-index.php"class="button"><h3 style="padding-bottom:10px;margin-bottom:20px;">Broadcast</h3></a>
<a href= "../logout.php"class="button"><h3 style="padding-bottom:10px;margin-bottom:20px;">Logout</h3></a>

<h3 style="padding-bottom:10px;border-bottom:1px solid #505070;">Chats</h3>
    <?php

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
	<a href="" class="button"><h3 style="padding-bottom:10px;margin-top:20px;">Feedback</h3></a>
		  <div id="feedback-form" >
		  <form name="feedbackform" action="../feedback.php" method="post">
		  <input type="text" class="form-control" name="feedback" placeholder="Give us any feedback here!">
		  <input type="submit" class="button btn" id="feedback-send" name="feedback-send" value="Send" style="width:50%;margin:10px auto 0 auto;color:black;">
		  </form>
		  </div>
</div>
</div>



<div class="col-md-6 right-side" style="padding-left:50px;">
<div class="row">
<div class="col-md-12">


<h2 style="margin-top:60px;">Welcome <?php echo "$user_name" ?></h1>
<h1>What would you like to broadcast today?</h2>
<div id="body">

<div class="col-md-6" style="margin-left: -29px;margin-top:30px;">
	<form class="broadcast-form" action="upload.php" method="post" enctype="multipart/form-data">

	<div class="col-md-12">
	<div id="upload-file-container">
	<input class="form-control" type="file" name="file" />
	</div>
	</div>

	

	<div class="col-md-12">
	<input class="form-control" placeholder="Title of Item (60 chars. max)" type="text" name="itemtitle" />
	</div>

	

	<div class="col-md-12">
	<textarea class="form-control" style="height:137px;" placeholder="Desc. of item (255 chars. max)" name="itemdesc"></textarea>
	</div>

	

	<div class="col-md-12">
	
	<input class="form-control" type="hidden" name="brand-id" value="<?php echo $user_id ?>">
	<button class="btn" style="height:45px;color:white;font-weight:bold;width:100%;background-color:#D61245;" name="btn-upload">Broadcast!</button>
	</div>

	
	
	</form>
</div>

	</div>
	
</div>
</div>
    <?php
	if(isset($_GET['success']))
	{
		?>
        <h2 style="margin-top:30px;">File Uploaded Successfully!</h2>
        <?php
	}
	else if(isset($_GET['fail']))
	{
		?>
        <h2 style="margin-top:30px;">Problem While File Uploading !</h2>
        <?php
	}
	?>
<div class="row">

<div class="col-md-6" style="margin-top:50px;">
<h1 style="margin-bottom:30px;">Your upload history:</h1>
<?php

	$sql="SELECT * FROM tbl_uploads WHERE brand_id='$user_id' ORDER BY ID DESC";
	$result_set=mysql_query($sql);
	while($row=mysql_fetch_array($result_set))
	{
		?>

<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-5">

<img src="uploads/<?php echo $row['file'] ?>" style="max-width:100%;">
</div>
<div class="col-md-5">
<h2 style="font-weight:bold;font-size:20px;margin-bottom:16px;margin-top:12px;"><?php echo $row['item_title'] ?></h2>
<p>
<?php echo $row['item_desc'] ?></p>
<p style="display:none;"><?php echo $row['id'] ?></p>
</div>
</div>
</div>
</div>

<?php
	}
	?>

	
</div>
</div>


</div>




</div>

</body>
</html>