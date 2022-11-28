<?php
 include_once('../db_con/db.php');
	$branch = $_SESSION['branch'];
	   
?>
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
				<div class="panel-heading" align="center">Stock Requisition for: <?php echo ucwords($branch); ?></div>
				<div class="panel-body">	
					<form  method="post">
									<div class="row">
											<div class="form-group  col-md-4">
												<div class="form-group">
													<label for="from" class="formText">Item</label>
														<select name="item">
															<option value="GFCI">Ground Fault Protection</option>
															<option value="Encoders">Encoders</option>
															<option value="PLC">Programmable Logic Controllers</option>
															<option value="Lighting controls and sensors">Lighting Controls and sensors</option>
															<option value="Transformers">Transformer</option>
															<option value="Timers">Timers</option>
															<option value="Motor controls">Motor Controls</option>
															<option value="harare south depot">Circuit Breakers</option>
															<option value="Digital meters">Digital meters</option>
														</select>
												</div>
											</div>
											<div class="form-group  col-md-4">
												<label for="from" class="formText">Quantity</label>
												<input type="number" min="1" max="" class="form-control" name="quantity"/>
											</div>
											<div class="form-group  col-md-4">
												<label for="from" class="formText">Requested by</label>
												<input type="text" class="form-control" readonly value = "<?=ucfirst($_SESSION['firstname']);?>"/>
											</div>
									</div>
									<div class="buttonHolder">
										<div class="col-md-12">
											<input style="float:center;" value="Submit" type="submit" id="submit" name="submit" class="btn btn-success">
										</div>
									</div>
									 <div align="right">
											<a href="index.php?page=viewCo.php&id=<?php echo $id;?>" class="btn btn-large btn-success">Back</a>
																		
										</div>
					</form>
				</div>
				<div class="panel-footer">
               
                </div>
			</div>	
			  <p></br></p>
			<p></br></p>
			<div class="panel panel-primary">
				<div class="panel-heading"  style="text-align:center;">Requisition Summary</div>
					<div class="panel-body">
						<table class="table table-condensed table-bordered table-striped">
							<thead>
							<th>No.</th>
							<th>Item</th>
							<th>Quantity</th>
							<th>Request date</th>
							<th>Requested by</th>
							<th>Status</th>
							</thead>
							<?php
							$sql13="select * from requisition where branch = '$branch'";
							$query3 = mysqli_query($con,$sql13);
							//$obj = mysqli_fetch_object($query3);
							?>
								<tbody>
									<?php while($order = mysqli_fetch_array($query3)):?>
									<tr>
										<td><?=$order['id'];?></td>
										<td><?=$order['item'];?></a></td>
										<td><?=$order['quantity'];?></td>
										<td><?=$order['date_created'];?></td>
										<td><?=$order['created_by'];?></td>
										<td><?php
											if($order['status'] == -1)
											{
												echo "Pending";
											}
											else if($order['status'] == 0)
											{
												echo "Declined";
											}
											else
											{
												echo "Approved";
											}?></td>
									</tr>
								<?php endwhile; ?>	
								</tbody>
						</table>
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
	}else
	{
		echo ("<script>alert('Error submitting stock request, please try again later.');</script>");
	}

}
?>