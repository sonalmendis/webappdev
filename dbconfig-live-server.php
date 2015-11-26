<?php
$dbhost = "localhost";
$dbuser = "viewer";
$dbpass = "pSgMTEefxH6mtX";
$dbname = "himmi";
mysql_connect($dbhost,$dbuser,$dbpass) or die('cannot connect to the server'); 
mysql_select_db($dbname) or die('database selection problem');
?>