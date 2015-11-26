<?php
include_once 'dbconfig.php';
if(isset($_POST['feedback-send']))
{    
     
	 // File attributes to be recorded/captured by PHP (image stuff is there too)

    $feedback = mysql_real_escape_string($_POST['feedback']);

		$sql="INSERT INTO feedback(feedback) VALUES ('$feedback')";
		mysql_query($sql);
		
		echo "<h1>Feedback sent</h1>";
		echo "<p>The page will redirect in 3 seconds</p>";
header('Refresh: 3; URL=' . $_SERVER['HTTP_REFERER']);


} else {
	
	echo "Please fill out some feedback";
	
}

?>