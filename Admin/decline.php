<?php
include "../db_con/db.php";
$id = $_REQUEST['id'];

$query = mysqli_query($con,"UPDATE requisition SET status = 0 WHERE id = '$id'");

	if($query)
	{
		echo ("<script> alert('Response submitted');window.location='index.php?page=requisition.php'</script>");
	
	}else
	{
		echo ("<script> alert('An error occured on submission, please try again later');window.location='index.php?page=requisition.php'</script>");
	}

?>