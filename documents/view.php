<?php
include_once '../dbconfig.php';
//The session already loads the data from the login.php part of it
session_start();

//Variables

$user_id = $_SESSION['ID'];

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>Himmi</title>
    <!-- Path to Framework7 Library CSS-->
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/framework7.ios.min.css">
    <link rel="stylesheet" href="css/framework7.ios.colors.min.css">
	
	<!-- Styles -->
	<link rel="stylesheet" href="css/normalize.css" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Path to your custom app styles-->
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	

	
	<!-- Jquery -->
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	 <!-- All favicons-->
<link rel="apple-touch-icon" sizes="57x57" href="img/favicons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="img/favicons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/favicons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/favicons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="img/favicons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/favicons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="img/favicons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="img/favicons/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="img/favicons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="img/favicons/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="img/favicons/manifest.json">
<link rel="mask-icon" href="img/favicons/safari-pinned-tab.svg" color="#5bbad5">
<meta name="apple-mobile-web-app-title" content="Himmi">
<meta name="application-name" content="Himmi">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-TileImage" content="img/favicons/mstile-144x144.png">
<meta name="theme-color" content="#ffffff">

	<!-- start Mixpanel --><script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f)}})(document,window.mixpanel||[]);
mixpanel.init("d1f7ac84a1663ea7dfdecf4072bd0497");</script><!-- end Mixpanel -->
<script>
mixpanel.track("Visit influencers home");
</script>
  </head>
  <body>
    <!-- Status bar overlay for fullscreen mode-->
    <div class="statusbar-overlay"></div>
    <!-- Panels overlay-->
    <div class="panel-overlay"></div>
    <!-- Left panel with reveal effect-->
    <div class="panel panel-left panel-reveal">
      <div class="content-block" >
        <a href="../logout.php" class="link icon-only open-panel external" style="color:white;"><i class="fa fa-paper-plane fa-lg"></i> Logout</a>
      </div>
    </div>
    <!-- Right panel with cover effect-->
    <div class="panel panel-right panel-cover">
      <div class="content-block">
        <p>Right panel content goes here</p>
      </div>
    </div>
    <!-- Views-->
    <div class="views">
      <!-- Your main view, should have "view-main" class-->
      <div class="view view-main">
        <!-- Top Navbar-->
        <div class="navbar">
          <div class="navbar-inner">

			<div class="left">
			<a href="#" class="link icon-only open-panel"> <i class="fa fa-navicon fa-lg"></i></a>  
            </div>
			
            <a href="view.php"><div class="center sliding"><img src="img/feed-icon@1x.png" srcset="img/feed-icon@2x.png 2x, img/feed-icon@3x.png 3x" /></div></a>
			
            <div class="right">
			

			<!-- Real time checking of unread messages -->
<script>
$.ajaxSetup({cache:false});
setInterval(function() {$('#chat-icon').load('../influencer-new-message-check.php?userid='+<?php echo $user_id ?>)}, 3000);
</script>
             <a id="chat-icon" href="influencer-chat-records.php" class="link icon-only"></a>
            </div>

          </div>

        </div>
        <!-- Pages, because we need fixed-through navbar and toolbar, it has additional appropriate classes-->
        <div class="pages navbar-through">
          <!-- Page, data-page contains page name-->
          <div data-page="index" class="page no-toolbar">
            <!-- Scrollable page content-->
            <div class="page-content">
<a href="feed-chat2.php"><h2>feeed chat 2</h2></a>


    <?php
	//Getting ALL the rows from tbl_uploads and then looping then in 'while'
	
	$sql="SELECT *, tbl_uploads.brand_id AS brandID FROM tbl_uploads INNER JOIN users ON users.ID = tbl_uploads.brand_id ORDER BY tbl_uploads.id DESC";
	$result_set=mysql_query($sql);
	while($row=mysql_fetch_array($result_set))
	{
		$brandid = $row['brandID'];

		?>
		
	
<div class="row">
<div class="col-xs-12 item-row">
<a href="influencer-more-info.php?feedid=<?php echo $row['id'] ?>">
<div class="row">
<div class="col-xs-12">
<div class="row">
<div class="col-xs-12 image-col">

<img src="uploads/<?php echo $row['file'] ?>" style="height:100%;width:100%;object-fit:cover;">
<div class="black-gradient-overlay"></div>
<div class="feed-text">
<?php 
$sql2="SELECT * FROM user_chat_records WHERE influencer_id =$user_id && brand_id = $brandid";
$result_set2=mysql_query($sql2);

if (mysql_num_rows($result_set2)){
?>
<img src="img/already-messaged-icon.svg" style="width:50px;height:50px;display:block;" >
<?php
} else {}
?>	
<img class="prof-pic-container" style="display:inline-block;" src="uploads/profile-pics/<?php echo $row['profile_picture'] ?>">
<div class="brand-details" >
<p class="display-name"><?php echo $row['display_name'] ?></p>
<p class="brand-name"><?php echo $row['brand_name'] ?></p>
</div>
<h1><?php echo $row['item_title'] ?></h1>

</div>
</div>

</div>
</div>
</div>
</a>
</div>
</div>
			         <?php
	}
	?> 
			  

            </div>
          </div>
        </div>

		
		
			<div class="toolbar toolbar-hidden" >
			<div class="toolbar-inner">
			
         <form name = "form1" id="message-form" >

<div class="message-textarea-container" >
<input class="form-control message-textarea" name="msg">
</div>

<!--<div class="message-send-container">
<a class="message-send" href= "#" id="send" >Send</a>
</div>-->

</form>

</div>
        </div>
		
      </div>
    </div>
    <!-- Path to Framework7 Library JS-->
    <script type="text/javascript" src="js/framework7.min.js"></script>
    <!-- Path to your app js-->
    <script type="text/javascript" src="js/my-app.js"></script>
	
<script>
$( document ).ready(function() {


$('#chat-icon').load('../influencer-new-message-check.php?userid='+<?php echo $user_id ?>)

});
</script>


  </body>
  

</html>
