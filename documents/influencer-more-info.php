<?php
include_once '../dbconfig.php';
session_start();
//Variables

$feed_id = $_GET['feedid'];
?>

<!-- Top Navbar-->
        <div class="navbar">
          <div class="navbar-inner">

			<div class="left">
			 <a href="#" class="sliding back"><i class="fa fa-arrow-left fa-lg"></i></a>  
            </div>
			
           <div class="center sliding">More Info</div></a>
			

			
          </div>

        </div>
        <!-- Pages, because we need fixed-through navbar and toolbar, it has additional appropriate classes-->
        <div class="pages navbar-through">
          <!-- Page, data-page contains page name-->
          <div data-page="more-info" class="page no-toolbar">
            <!-- Scrollable page content-->
            <div class="page-content">
		


    <?php
	//Getting ALL the rows from tbl_uploads and then looping then in 'while'
	
	$sql="SELECT * FROM tbl_uploads INNER JOIN users ON users.ID = tbl_uploads.brand_id WHERE tbl_uploads.id = $feed_id";
	$result_set=mysql_query($sql);
	while($row=mysql_fetch_array($result_set))
	{
		?>
<div class="row">

<div class="col-xs-12 image-col">

<img src="uploads/<?php echo $row['file'] ?>" style="height:100%;width:100%;object-fit:cover;">
<div class="black-gradient-overlay"></div>

<a href="../feed-chat-check.php?brandid=<?php echo $row['brand_id'] ?>"><div class="btn red message-button-feed">Message <?php echo $row['display_name'] ?></div></a>

<div class="feed-text">
<img class="prof-pic-container" style="display:inline-block;" src="uploads/profile-pics/<?php echo $row['profile_picture'] ?>">
<div class="brand-details" >
<p class="display-name"><?php echo $row['display_name'] ?></p>
<p class="brand-name"><?php echo $row['brand_name'] ?></p>
</div>
<h1><?php echo $row['item_title'] ?></h1>

</div>


</div>

</div>

<div class="row feed-description" style="">
<div class="col-xs-12">
<a class="external" target="_blank" href="<?php echo $row['brand_website'] ?>"><div class="view-website-container"><img src='img/view-website-icon.svg'><span class="view-website-text">View Website</span></div></a>
<p><?php echo $row['item_desc'] ?></p>
<a href="../feed-chat-check.php?brandid=<?php echo $row['brand_id'] ?>"><div class="btn red-outline message-button-bottom">Message <?php echo $row['display_name'] ?></div></a>
</div>
</div>

</div>

			         <?php
	}
	?> 

	</div>
			</div>
			</div>
			


