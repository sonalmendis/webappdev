<?php
include_once 'dbconfig.php';
/*
This page checks if there is already a feed chat the influencer is a part of that is relevant to the feed item they just clicked
If there is it continued to the feed-chat page and loads up the logs
If there isn't it will make a new chat instance with the feed_item_id
and then update the user_chat_records with two new rows, one for the influencer and a new one for the brand
*/
session_start();

/* Variables */
$brand_id = $_GET['brandid'];

$user_id = $_SESSION['ID'];

/* I want to select all the entries from user_chat_records where
the brand_id = [whatever I got from the view.php feed which is actually from tbl_uploads]
the influencer_id = [user ID of current session (because if they're using this page they must be an influencer)]
This will give the chat between the brand and influencer (since its only one chat you only need user_id and brand_id and not feed_id
*/

$sql_query = "SELECT ID AS userchatrecordsid FROM user_chat_records WHERE user_chat_records.influencer_id = $user_id && user_chat_records.brand_id = $brand_id";
$result100 = mysql_query($sql_query);
$results_100_array = mysql_fetch_array($result100);
$results_100_value = $results_100_array['userchatrecordsid'];
$empty_check =  mysql_num_rows($result100);

/*If there are records (i.e, you've chatted with this brand before) then it will go to the feed-chat page and give the brand_id to know who you're talking to)*/


if (!empty($empty_check)){
$get_logs_from_chat_id="SELECT *, logs.ID AS logsID FROM logs WHERE user_id = $brand_id && chat_id = $results_100_value && is_read IS NULL";

	$logs_results=mysql_query($get_logs_from_chat_id);

		

		
	while($message_to_be_changed_to_read =  mysql_fetch_array($logs_results))
	{
		$ids_of_messages[] = $message_to_be_changed_to_read['logsID'];
	};
	
ob_start();
$ids_of_messages = join(', ', $ids_of_messages);
header('Location: documents/view.php');
mysql_query("UPDATE logs SET is_read=1 WHERE ID IN ($ids_of_messages);");
header("Location: documents/feed-chat.php?brandid=$brand_id");
ob_end_flush();


}

/*If the records are empty (i.e, you haven't talked with the brand before) a new record of the chat will be made using the brand_id and influencer_id*/

else {
mysql_query("INSERT INTO user_chat_records(influencer_id, brand_id) VALUES('$user_id', '$brand_id')");
header("Location: documents/feed-chat.php?brandid=$brand_id");
}
?>
