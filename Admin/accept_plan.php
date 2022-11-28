<?php
include "../db_con/db.php";
$id = $_REQUEST['id'];

$query = mysqli_query($con,"UPDATE weekly_plan SET decision = 1 WHERE id = '$id'");

	if($query)
	{
		echo ("<script> alert('Response submitted');window.location='index.php?page=our_week.php'</script>");
	
	}else
	{
		echo ("<script> alert('An error occured on submission, please try again later');window.location='index.php?page=our_week.php'</script>");
	}

?>