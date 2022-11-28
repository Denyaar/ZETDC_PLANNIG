<?php
include "../db_con/db.php";
$id = $_REQUEST['id'];


$query = mysqli_query($con,"UPDATE leave_form SET status = 'Accepted' WHERE id = '$id'");

	if($query)
	{
		echo ("<script> alert('Your decision has been processed');window.location='index.php?page=leave.php'</script>");	
	}else
	{
		echo ("<script> alert('An error occured on making the decision, please try again later');window.location='index.php?page=leave.php'</script>");
	}

?>