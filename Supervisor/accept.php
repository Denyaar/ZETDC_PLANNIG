<?php
include "../db_con/db.php";
$id = $_REQUEST['id'];
$quantity = $_REQUEST['qty'];

$query = mysqli_query($con,"UPDATE requisition SET status = 1 WHERE id = '$id'");

	if($query)
	{
		$obj = mysqli_fetch_object(mysqli_query($con,"SELECT item FROM requisition WHERE id = '$id'"));
		$item = $obj->item;
		
		$obj1 = mysqli_fetch_object(mysqli_query($con,"SELECT quantity,id FROM inventory WHERE name = '$item'"));
		$origin_qty = $obj1->quantity;
		$inventory_id = $obj1->id;
		$updated_qty = $origin_qty - $quantity;
		
		if($quantity > $origin_qty)
		{	
		  mysqli_query($con,"UPDATE requisition SET status = -1 WHERE id = '$id'");
          echo ("<script> alert('Automatic pending decision has been selected, quantity being requested is unavailable now');window.location='index.php?page=requisition.php'</script>");
		  exit();
		}else
		{
			$inventory = mysqli_query($con,"UPDATE inventory SET quantity = '$updated_qty' WHERE id = '$inventory_id'");
			
			if($inventory)
			{
				echo ("<script> alert('Response submitted');window.location='index.php?page=requisition.php'</script>");
			}else
			{
				echo ("<script> alert('Response has been submitted with errors, please inform the system adminstrator');window.location='index.php?page=requisition.php'</script>");
			}
		}
	}else
	{
		echo ("<script> alert('An error occured on submission, please try again later');window.location='index.php?page=requisition.php'</script>");
	}

?>