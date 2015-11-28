<?php
include_once '../dbconfig.php';
session_start();
/* Extend cookie life time by an amount of your liking, use this once the page issue is fixed to have a session that works on iOS
(so user doesn't have to keep logging in to the app every time they open it)
$cookieLifetime = 365 * 24 * 60 * 60; // A year in seconds
setcookie(session_name(),session_id(),time()+$cookieLifetime);
*/

//If there is no ID set then this form will appear and exit without redirection the user
if(!isset($_SESSION['ID'])) {
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>Himmi</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
    <!-- Path to Framework7 Library CSS-->
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	
	<!-- Styles -->
	

	<link rel="stylesheet" href="css/normalize.css" type="text/css" />

    <!-- Path to your custom app styles-->
	<link rel="stylesheet" href="css/index-style.css" type="text/css" />

	
	<!-- start Mixpanel --><script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f)}})(document,window.mixpanel||[]);
mixpanel.init("d1f7ac84a1663ea7dfdecf4072bd0497");</script><!-- end Mixpanel -->

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
<link rel="icon" type="image/png" href="img/favicons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="img/favicons/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="img/favicons/manifest.json">
<link rel="mask-icon" href="img/favicons/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-TileImage" content="img/favicons/mstile-144x144.png">
<meta name="theme-color" content="#ffffff">
</head>

<body>
<div id="form-container" class="col-md-3 col-xs-10">

<h1>Himmi</h1>

	<form name="form2" action="../login.php" method="post">
<input placeholder="Username" class="form-control" type="text" name="username">
<input class="form-control" placeholder="Password" type="password" name="password">
<input type="submit" name="submit" class="btn" value="Login">
</form>

<h3>Don't have an account?</h3>
<a style="text-decoration:none" href="register.php"><input type="submit" class="btn red" value="Register"></a>

<script>
mixpanel.track("Open App");
</script>



</div>


</body>

</html>


<?php
exit;
}

else {

$user_id = $_SESSION['ID'];

$user_type_check = mysql_query("SELECT user_type FROM users WHERE ID='$user_id'");
$user_type_extract = mysql_fetch_array($user_type_check);
$user_type = $user_type_extract['user_type'];

if($user_type == 'brand') {
	
	header("Location: brand-index.php"); 
	
} elseif ($user_type == 'influencer') {
	
	header("Location: view.php"); 
	
} else {
	
	header("Location: ../index.php"); 
}



	
}

?>
