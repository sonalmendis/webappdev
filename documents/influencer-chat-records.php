<?php
include_once '../dbconfig.php';
//The session already loads the data from the login.php part of it
session_start();

//Variables

$user_id = $_SESSION['ID'];

?>

        <div class="navbar">
          <div class="navbar-inner">

			<div class="left">
			 <a href="#" class="link icon-only sliding back"><i class="fa fa-arrow-left fa-lg"></i></a>  
            </div>
			
           <div class="center sliding">Chats</div></a>
			

			
          </div>
        </div>
        <!-- Pages, because we need fixed-through navbar and toolbar, it has additional appropriate classes-->
        <div class="pages">
          <!-- Page, data-page contains page name-->
          <div data-page="influencer-chat-records" class="page">
            <!-- Scrollable page content-->
            <div class="page-content">

			  
	<div class="all-chat-records-container">

		  
    <?php
	
	
	/* First we need to get all the logs that are actually part of the chat the influencer is in, so get the right chat_id first: */
	$get_influencer_chat_ids="SELECT ID FROM user_chat_records WHERE influencer_id = $user_id";
	$chat_ids_results=mysql_query($get_influencer_chat_ids);
	


if(mysql_num_rows($chat_ids_results))  {
	
	
	
		while($chat_ids_array=mysql_fetch_array($chat_ids_results))
	{
		$myArray[]=$chat_ids_array['ID']; 
	};
	

/* Now we actually get the logs based on the chat_ids and grouping them by chat_id (because we only need the latest
 message - meaning one record) and choosing the record with the latest date: */
$myArray = join(', ', $myArray);
	$get_logs_from_chat_id="SELECT * FROM logs INNER JOIN user_chat_records ON user_chat_records.ID = logs.chat_id INNER JOIN users ON users.ID = user_chat_records.brand_id WHERE date_submitted IN (SELECT MAX(date_submitted) FROM logs WHERE chat_id IN ($myArray) GROUP BY chat_id) GROUP BY chat_id ORDER BY date_submitted DESC";

	$logs_results=mysql_query($get_logs_from_chat_id);

	while($logs_array=mysql_fetch_array($logs_results))
	{
	?>


<a class="" href="../feed-chat-check.php?brandid=<?php echo $logs_array['brand_id'] ?>">
<div class="row chat-record-row">
<div class="col-xs-12">
	
<img class="prof-pic-container" style="display:inline-block;float:left;" src="uploads/profile-pics/<?php echo $logs_array['profile_picture'] ?>">	
<div class="chat-records-brand-details" >
<p class="display-name"><?php echo $logs_array['display_name'] ?></p>
<span class="last-message-date"><?php echo $logs_array['date_submitted'] ?></span>
	<p class="last-message">
<?php 
echo (substr($logs_array['msg'], 0, 35)) . '...';
?>
	</p>
</div>

</div>
</div>
</a>
	
	<?php
		
		
	}; } else {
	
	echo "<h2>No chats to show!</h2>";
	
}

?>

</div>
            </div>
          </div>
        </div>


	





			  

