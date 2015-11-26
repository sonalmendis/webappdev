<?php
include_once '../dbconfig.php';

//The session already loads the data from the login.php part of it
session_start();

$brand_id = $_GET['brandid'];
$user_id = $_SESSION['ID'];

?>




<div class="navbar">
  <div class="navbar-inner">
    <div class="left sliding"><a href="index.html" class="back link"><i class="icon icon-back"></i><span>Back</span></a></div>
    <div class="center sliding">Messages</div>
    <div class="right"><a href="#" class="link open-panel icon-only"><i class="icon icon-bars"></i></a></div>
  </div>
</div>
<div class="pages navbar-through">
  <div data-page="messages" class="page no-toolbar toolbar-fixed">
    <div class="toolbar messagebar">
      <div class="toolbar-inner"><a href="#" class="link icon-only"><i class="icon icon-camera"></i></a>
        <textarea placeholder="Message"></textarea><a href="#" class="link send-message">Send</a>
      </div>
    </div>
    <div class="page-content messages-content">
      <div class="messages messages-init" data-add-message="animate:true">
        <div class="messages-date">Sunday, Feb 9,<span>12:58</span></div>

      </div>
    </div>
  </div>
</div>
