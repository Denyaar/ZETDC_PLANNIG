<?php
include "../db_con/db.php";
$id = $_REQUEST['id'];
$user = $_SESSION['firstname'];
$obj = mysqli_fetch_array(mysqli_query($con,"SELECT  * FROM `daily_plan` WHERE id = '$id';"));

$query = mysqli_query($con,"DELETE FROM `daily_plan` WHERE `id` = '$id'");

$origin = $obj['created_by'];
$objective = $obj['target'];

mysqli_query($con,"INSERT INTO audit_trail (action,`target`,ip_address,created_by,originated_by)
								VALUES 		('Deletion','$objective',USER(),'$user','$origin')");

	if($query)
	{
		echo ("<script> alert('deletion success');window.location='index.php?page=today.php'</script>");
	
	}else
	{
		echo ("<script> alert('An error occured on deletion, please try again later');window.location='index.php?page=today.php'</script>");
	}

?>