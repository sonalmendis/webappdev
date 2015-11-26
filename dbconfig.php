<?php
$dbhost = "localhost";
$dbuser = "sonal";
$dbpass = "Klop123az3ery";
$dbname = "image_upload_test";
mysql_connect($dbhost,$dbuser,$dbpass) or die('cannot connect to the server'); 
mysql_select_db($dbname) or die('database selection problem');
?>