<?php
include "../db_con/db.php";
$id = $_REQUEST['id'];
$user = $_SESSION['firstname'];
$obj = mysqli_fetch_array(mysqli_query($con,"SELECT  * FROM `leave_form` WHERE id = '$id';"));

$query = mysqli_query($con,"DELETE FROM `leave_form` WHERE `id` = '$id'");

	if($query)
	{
		echo ("<script> alert('deletion success');window.location='index.php?page=leave_form.php'</script>");
	
	}else
	{
		echo ("<script> alert('An error occured on deletion, please try again later');window.location='index.php?page=leave_form.php'</script>");
	}

?>