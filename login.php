<?php 
//Connection details to server and database selection
include_once 'dbconfig.php';

session_start();

//The login details given by the login form in index.php
$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);



//Chooses the records where there's an actual match
$result = mysql_query("SELECT * FROM users WHERE email='$username' AND password='$password'");

//mysql_num_rows confirms the match, if there are rows with the matched records it will run the success script
if(mysql_num_rows($result)){
	
	//Assuming this gets the result in an array that can then be processed by PHP
	$res = mysql_fetch_array($result);
	
	/*This step makes sure the original if(!isset($_SESSION['username'])) 
	in index.php is now set so the form disappears and the actual chat appears
	(otherwise you'll just see the login form again*/
	$_SESSION['email'] = $res['email'];
	$_SESSION['ID'] = $res['ID'];
	
	if ($res['user_type'] == 'brand'){

header("Location: documents/brand-index.php"); 
		
	} else {
		
	header("Location: documents/view.php"); 
		
	}
	//depending on the user-type the result will be different, use an IF statement here

}

//If it can't find a username and password with matching deets
else {
	
	echo "No user found. Please go <a href='documents/index.php'>back</a> and enter the correct details.<br>";
	echo "You may register a new account by clicking here: <a href='documents/register.php'>Here</a>";
	
}

?>
