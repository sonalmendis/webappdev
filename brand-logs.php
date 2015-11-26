<?php 
include_once 'dbconfig.php';

session_start();
$chat_id = $_GET['chatid'];

$logs_chat_id_query = mysql_query("SELECT * FROM logs INNER JOIN users ON users.ID = logs.user_id WHERE chat_id = $chat_id");
while($extract200 = mysql_fetch_array($logs_chat_id_query)){
 echo "<span class='uname'>" . $extract200['display_name']. "</span>: <span class='msg'>" . $extract200['msg']. "</span><br>";
}

?>
