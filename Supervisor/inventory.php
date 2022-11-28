<?php
 include_once('../db_con/db.php');
	   
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
			<p></br></p>
			<div class="panel panel-primary">
				<div class="panel-heading"  style="text-align:center;">Inventory Summary</div>
					<div class="panel-body">
						<table class="table table-condensed table-bordered table-striped">
							<thead>
							<th>Name</th>
							<th>Quantity</th>
							<th>Reorder level</th>
							<th>Warehouse date</th>
							</thead>
							<?php
							$sql13="select * from inventory ORDER BY name";
							$query3 = mysqli_query($con,$sql13);
							//$obj = mysqli_fetch_object($query3);
							?>
								<tbody>
									<?php while($order = mysqli_fetch_assoc($query3)):?>
									<tr>
										<td><a href="index.php?page=inventory_modify.php&id=<?=$order['id'];?>"><?=$order['name'];?></a></td>
										<td><?=$order['quantity'];?></td>
										<td><?=$order['reorder_cap'];?></td>
										<td><?=$order['date_created'];?></td>
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
	

}
?>