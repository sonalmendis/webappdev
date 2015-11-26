<?php 
include_once 'dbconfig.php';

session_start();
$brand_id = $_GET['brandid'];
$user_id = $_SESSION['ID'];


$logs_chat_id_query = mysql_query("SELECT * FROM logs INNER JOIN user_chat_records ON user_chat_records.ID = logs.chat_id INNER JOIN users ON users.ID = user_chat_records.influencer_id WHERE user_chat_records.influencer_id = $user_id && user_chat_records.brand_id = $brand_id");
while($extract200 = mysql_fetch_array($logs_chat_id_query)){
	
	
	
	if($extract200['user_id'] == $_SESSION['ID']){
		 echo "<div class='message message-sent'><div class='message-name'>" . $extract200['display_name']. "</div><div class='message-text'>" . $extract200['msg']. "</div></div><br>";

	} else {
$get_logs_brand_id = mysql_query("SELECT * FROM users WHERE ID = $brand_id");
$the_brand_details = mysql_fetch_array($get_logs_brand_id);
 
echo "<div class='message message-received'><div class='message-name'>" . $the_brand_details['display_name']. "</div><div class='message-text'>" . $extract200['msg']. "</div></div><br>";
} 

 }

?>
