<?php 
include_once 'dbconfig.php';

session_start();

$msg = $_REQUEST['msg'];
$brand_id = $_GET['brandid'];
$user_id = $_SESSION['ID'];


$sql_query = "SELECT user_chat_records.ID FROM user_chat_records WHERE user_chat_records.influencer_id = $user_id && user_chat_records.brand_id = $brand_id";
$insert_result = mysql_query($sql_query);

$chat_id_extract = mysql_fetch_array($insert_result);
$chat_id = $chat_id_extract['ID'];

mysql_query("INSERT INTO logs(user_id, msg, chat_id) VALUES('$user_id', '$msg', '$chat_id')");

$result1 = mysql_query("SELECT * FROM logs INNER JOIN users ON users.ID = logs.user_id WHERE chat_id = $chat_id");


/* Echoing the message within the actual chat depending on whether it's the user's messages or not, i.e if I sent a message or if someone else did */
while($extract = mysql_fetch_array($result1)){
	if($extract['user_id'] == $_SESSION['ID']){
		
		 echo "<div class='message message-sent'><div class='message-name'>" . $extract['display_name']. "</div><div class='message-text'>" . $extract['msg']. "</div></div><br>";

		
	} else {
 echo "<div class='message message-received'><div class='message-name'>" . $extract['display_name']. "</div><div class='message-text'>" . $extract['msg']. "</div></div><br>";
} 
}





?>
