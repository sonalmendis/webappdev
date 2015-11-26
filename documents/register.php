<?php 
include_once '../dbconfig.php';
if(isset($_POST['submit'])) {
error_reporting(0);
// File attributes to be recorded/captured by PHP (image stuff is there too)
	$file = rand(1000,100000)."-".$_FILES['profile-pic']['name'];
    $file_loc = $_FILES['profile-pic']['tmp_name'];
	$folder="uploads/profile-pics/"; //The upload folder

$email = mysql_real_escape_string($_POST['email']);
$displayname = mysql_real_escape_string($_POST['displayname']);
$brandname = mysql_real_escape_string($_POST['brandname']);
$brandwebsite = mysql_real_escape_string($_POST['brandwebsite']);
$utype = $_POST['user-type'];
$pword = mysql_real_escape_string($_POST['password']);
$pword2 = mysql_real_escape_string($_POST['password2']);
		
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
	
	$final_file=str_replace(' ','-',$new_file_name);
	
	//If the files are able to be uploaded to the folder then

if($pword != $pword2) {
	
	$password_not_match = "Password do not match. <br>";
	
}
else {
	

	$checkexist = mysql_query("SELECT email FROM users WHERE email='$email'");
	if(mysql_num_rows($checkexist)) {
		
		$username_exists = "Email already exists, please select a different one";
		
	}
	else {
		

	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		$sql="INSERT INTO users(email, password, user_type, profile_picture, display_name, brand_name, brand_website) VALUES('$email', '$pword', '$utype', '$final_file', '$displayname', '$brandname', '$brandwebsite')";
		mysql_query($sql);
		
		$success_message = "<div style='font-weight:bold;font-size:18px;'>You have successfully registered. Please login</div><br> <a href='index.php'><input type='submit' class='btn' value='Login'></a>";


	}
	else
	{

	}
		
		
		

		
	}
}



}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>Himmi</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Path to Framework7 Library CSS-->
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	
	<!-- Styles -->
	
	<link rel="stylesheet" href="css/index-style.css" type="text/css" />
	<link rel="stylesheet" href="css/normalize.css" type="text/css" />

    <!-- Path to your custom app styles-->
<link rel="stylesheet" href="css/style.css" type="text/css" />
	

</head>

<body>



<div id="form-container" class="col-md-3 col-xs-10">

<h1>Register</h1>




	<form name="form1" method="post" action="register.php" enctype="multipart/form-data">
	
	
		<div class="register prof-pic-container" style="background-image: url(#);margin:0 auto;"></div>
	
	<label id="prof-pic-label" class="btn red">
    <input type='file' name="profile-pic" id="imgInp" required/>
    <span>Choose a profile pic</span>
</label>
	
<input type="email" name="email" class="form-control" placeholder="Email">
<input type="text" name="displayname" class="form-control" placeholder="Display Name (tip: use your name)">

<div style="margin:40px 0;">
<select id="user-type" name="user-type" class="form-control">
<option value="" disabled selected>Select your account type</option>
<option value="influencer">Influencer</option>
<option value="brand">Brand</option>
</select>
<input type="text" id="brand-name" name="brandname" placeholder="Brand name" style="display:none;" class="form-control">
<input type="text" id="brand-website" name="brandwebsite" placeholder="Brand website" style="display:none;" class="form-control">
</div>

<input class="form-control" placeholder="Password" type="password" name="password">

<input class="form-control" placeholder="Re-enter your password" type="password" name="password2">

<input type="submit" class="btn red" name="submit" value="Register">
</form>


<div style="margin-top:-40xp;font-size:16px;color:white;text-align:center;">
<?php
error_reporting(0); 
echo $password_not_match;
echo $username_exists;
echo $success_message; 
?>
</div>



</div>


</body>

<script>
$('#user-type').change(function(){
  if($(this).val() == 'brand'){ 
    $('#brand-name').show();
	$('#brand-website').show();
  } else {
	  
	  $('#brand-name').hide();
  }
});
</script>


	<script>
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
			$('.prof-pic-container').css('background-image', 'url(' + e.target.result + ')');
        }

        reader.readAsDataURL(input.files[0]);

    } else {
		


	}
}

$("#imgInp").change(function(){
    readURL(this);
});
</script>
</html>