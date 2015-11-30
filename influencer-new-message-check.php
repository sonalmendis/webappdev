<?php 
include_once 'dbconfig.php';
$user_id = $_GET['userid'];

	/* First we need to get all the logs that are actually part of the chat the influencer is in, so get the right chat_id first: */
	$get_influencer_chat_ids="SELECT ID FROM user_chat_records WHERE influencer_id = $user_id";
	$chat_ids_results=mysql_query($get_influencer_chat_ids);

	if (mysql_num_rows($chat_ids_results) == 0) {

} else {
	
		while($chat_ids_array=mysql_fetch_array($chat_ids_results))
	{
		$myArray[]=$chat_ids_array['ID']; 
	}
	
		/* Now we actually get the logs based on the chat_ids and grouping them by chat_id (because we only need the latest
 message - meaning one record) and choosing the record with the latest date: */
 
 /* This segment checks for any new messages at all so the chat icon works real time*/
$myArray = join(', ', $myArray);
	$get_logs_from_chat_id="SELECT *, logs.ID AS logsID FROM logs INNER JOIN user_chat_records ON user_chat_records.ID = logs.chat_id INNER JOIN users ON users.ID = user_chat_records.brand_id WHERE date_submitted IN (SELECT MAX(date_submitted) FROM logs WHERE chat_id IN ($myArray) AND user_id != $user_id AND is_read IS NULL GROUP BY chat_id) ORDER BY date_submitted DESC";

	$logs_results=mysql_query($get_logs_from_chat_id);

		
		while($logs_array_new_chats = mysql_fetch_array($logs_results)) {
		
		$myArray_collected_new_messages[]=$logs_array_new_chats['logsID'];
		
	};

		
	};

/* This segment checks if there are any new messages AND if those new messages have already notified the influencer
we can't use just this because once is_notified is set it won't pick up the unread messages i.e the chat icon won't work real time, something like that
 */
 
 	$get_is_notified_logs="SELECT *, logs.ID AS logsID FROM logs INNER JOIN user_chat_records ON user_chat_records.ID = logs.chat_id INNER JOIN users ON users.ID = user_chat_records.brand_id WHERE date_submitted IN (SELECT MAX(date_submitted) FROM logs WHERE chat_id IN ($myArray) AND user_id != $user_id AND is_read IS NULL AND is_notified IS NULL GROUP BY chat_id) ORDER BY date_submitted DESC";

	$is_notified_logs_result=mysql_query($get_is_notified_logs);

		
		while($in_notified_logs_array = mysql_fetch_array($is_notified_logs_result)) {
		
		$myArray_is_not_notified_logs[]=$in_notified_logs_array['logsID'];
		
	};

	
	
	
if( !empty( $myArray_collected_new_messages ) ) {
		
if( !empty( $myArray_is_not_notified_logs ) ) {
	echo "
	<script>
    myApp.addNotification({
        title: 'New message received!',
        message: 'You have received a new message!'
    });
	
		
	    var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', 'notification.wav');
        audioElement.setAttribute('autoplay', 'autoplay');
		$.get();
		audioElement.play();
	</script>
	";

	
	$myArray_is_not_notified_logs = join(', ', $myArray_is_not_notified_logs);
	
	/* Use this if you want to check if an ID is being printed on screen 
	print_r($myArray_collected_new_messages);
	*/
	
	mysql_query("UPDATE logs SET is_notified=1 WHERE ID IN ($myArray_is_not_notified_logs);");
	echo "<img src='img/new-message-icon-18.svg' style='width:31px;margin-top: -6px;' alt='Logo'>";
	
	} else {
		
		echo "<img src='img/new-message-icon-18.svg' style='width:31px;margin-top: -6px;' alt='Logo'>";
	}

		
	
	
} else {
	echo "<i class='fa fa-commenting-o fa-lg'></i>";
	};


?>
