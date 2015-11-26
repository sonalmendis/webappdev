<?php
include_once '../dbconfig.php';
if(isset($_POST['btn-upload']))
{    
     
	 // File attributes to be recorded/captured by PHP (image stuff is there too)
	$file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	$item_title = mysql_real_escape_string($_POST['itemtitle']);
	$item_desc = mysql_real_escape_string($_POST['itemdesc']);
	$brand_id = $_POST['brand-id'];
	$folder="uploads/"; //The upload folder
	
	// new file size in KB
	$new_size = $file_size/1024;  
	// new file size in KB
	
	// make file name in lower case
	$new_file_name = strtolower($file);
	// make file name in lower case
	
	$final_file=str_replace(' ','-',$new_file_name);
	
	//If the files are able to be uploaded to the folder then
	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		$sql="INSERT INTO tbl_uploads(file,type,size,item_title,item_desc,brand_id) VALUES('$final_file','$file_type','$new_size', '$item_title', '$item_desc', '$brand_id')";
		mysql_query($sql);
		?>
		<script>
		alert('successfully uploaded');
        window.location.href='brand-index.php?success'; //Passes on a success POST to index.php which then GET(s) it
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert('error while uploading file');
        window.location.href='brand-index.php?fail';
        </script>
		<?php
	}
}
?>