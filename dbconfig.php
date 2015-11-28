<?php
$dbhost = "localhost";
$dbuser = "testingaccount";
$dbpass = "k72erBqhj-bGL8Pr";
$dbname = "image_upload_test";
mysql_connect($dbhost,$dbuser,$dbpass) or die('cannot connect to the server'); 
mysql_select_db($dbname) or die('database selection problem');
?>