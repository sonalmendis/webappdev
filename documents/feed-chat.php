<?php
include_once '../dbconfig.php';

//The session already loads the data from the login.php part of it
session_start();

$brand_id = $_GET['brandid'];
$user_id = $_SESSION['ID'];

?>




        <div class="navbar">
         <div class="navbar-inner">

			<div class="left">
			 <a href="view.php" id="back-btn-from-chat" class="back link"><i class="fa fa-arrow-left fa-lg"></i></a>  
            </div>
			
           <div class="center sliding">Chat</div></a>
			

			
          </div>
        </div>
        <!-- Pages, because we need fixed-through navbar and toolbar, it has additional appropriate classes-->
        <div class="pages">
          <!-- Page, data-page contains page name-->
          <div data-page="feed-chat" class="page">
            <!-- Scrollable page content-->
            <div class="page-content messages-content">

<div class="row main-feed">
<div class="col-xs-12">
<div class="row">
<div class="col-xs-12" style="text-align:center;">
<?php 

	$brand_user_sql="SELECT profile_picture FROM users WHERE ID=$brand_id OR ID=$user_id";
	$brand_user_result=mysql_query($brand_user_sql);
	while($row = mysql_fetch_array($brand_user_result))
	{
?>
<img class="prof-pic-container" style="display:inline-block;" src="uploads/profile-pics/<?php echo $row['profile_picture'] ?>">
<?php } ?>

<div id="brandid" style="display:none;"><?php echo $brand_id ?></div>
</div>
</div>


<div class="row" style="border-top: 1px solid#b2b2b2;;background-color:white;">
<div class="col-xs-12" style="background-color:white;margin-bottom: 45px;">
<div id="chatlogs" class="messages-content" > 
<div class="messages">

</div>
</div>


</div>

</div>



</div>
</div>  


        


          </div>
		  
        </div>
	
