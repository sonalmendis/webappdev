<?php 
include_once 'dbconfig.php';

session_start();
$user_id = $_SESSION['ID'];
$msg = $_REQUEST['msg'];
$chat_id = $_GET['chatid'];


mysql_query("INSERT INTO logs(user_id, msg, chat_id) VALUES('$user_id', '$msg', '$chat_id')");

$result1 = mysql_query("SELECT * FROM logs INNER JOIN users ON users.ID = logs.user_id WHERE chat_id = $chat_id");

while($extract = mysql_fetch_array($result1)){
 echo "<span class='uname'>" . $extract['display_name']. "</span>: <span class='msg'>" . $extract['msg']. "</span><br>";
 
}





?>
