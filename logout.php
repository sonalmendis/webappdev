<?php 
session_start();

session_destroy();
header("Location: documents/index.php"); 


?>
