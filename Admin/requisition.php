
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> ZETDC | ePlanner</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
	   <link href="css/style.css" rel="stylesheet">
		<style>
		body{
			background-size: 100vw 100vh;
		}
		#loginform{
			width:50%;
			height:60%;
			
			margin: 7% auto;
			paddding: 15px;
		}
		.modal-dialog{
   width: 80%;
   margin: auto;
}.buttonHolder{ text-align: center; }{
				text-align:center;
			}
		
		</style>

	</head>
	
	<body>
			<div class="container-fluid">
			<div class="panel panel-primary">
				<div class="panel-heading"  style="text-align:center;">Branch Requisition Summary</div>
					<div class="panel-body">
						<table class="table table-condensed table-bordered table-striped">
							<thead>
							<th>No.</th>
							<th>Item</th>
							<th>Quantity</th>
							<th>Branch</th>
							<th>Dispatcher</th>
							<th>Request date</th>
							<th>Status</th>
							<th colspan="2" style="text-align:center">Decision</th>
							</thead>
							<?php
							$sql13="select * from requisition ORDER BY id DESC";
							$query3 = mysqli_query($con,$sql13);
							//$obj = mysqli_fetch_object($query3);
							?>
								<tbody>
									<?php while($order = mysqli_fetch_array($query3)):?>
									<tr>
										<td><?=$order['id'];?></td>
										<td><?=$order['item'];?></a></td>
										<td><?=$order['quantity'];?></td>
										<td><?=$order['branch'];?></td>
										<td><?=$order['created_by'];?></td>
										<td><?=$order['date_created'];?></td>
										<td><?php
											if($order['status'] == -1)
											{
												echo "Awaiting approval";
											}else if($order['status'] == 0)
											{
												echo "Declined";
											}else 
											{
												echo "Accepted";
											}
										?></td>
										<td  align="center"><a href="accept.php?id=<?=$order['id'];?>&qty=<?=$order['quantity'];?>"><input style="background-color:#008000;color:white;" type="submit" value="accept"/></a></td>
										<td align="center"><a href="decline.php?id=<?=$order['id']?>"><input type="submit" value="decline" style="background-color:#FF0000;color:white;"/></a></td>
				
									</tr>
								<?php endwhile; ?>	
								</tbody>
						</table>
					</div>
			</div>
			</div>
		</div>
      	
	
	</body>
</html>

<?php



if(isset($_POST['submit']))
{
	
$item = $_POST['item'];
$quantity = mysqli_real_escape_string($con,$_POST['quantity']);
$email = $_SESSION['email'];

$count_query = mysqli_query($con,"SELECT quantity FROM inventory WHERE name = '$item'");
$obj = mysqli_fetch_object($count_query);
/*echo'<pre>';print_r(ucwords($item));exit;*/
$item_count = $obj->quantity;
$item_string = ucwords($item);
	
	if(empty($quantity)){
		echo ("<script> alert('Please select quantity to be requisited');</script>");
	}
	if($item_count == 0)
	{
		echo ("<script> alert('Sorry $item_string is out of stock, please try again later');</script>");
		exit();
	}else if($quantity > $item_count)
	{
		echo ("<script> alert('Please pick item quantity between 1 and $item_count');</script>");
		exit();
	
	}
	
$qry = mysqli_query($con,"INSERT INTO requisition(item,quantity,branch,created_by) VALUES('$item','$quantity','$branch','$email')");

if($qry)
{
	echo ("<script> alert('Requisition submitted successfully');window.location='index.php?page=requisition.php'</script>");
	
	exit();
}else{
	echo ("<script>alert('Error submitting stock request, please try again later.');</script>");
	
}

}
?>