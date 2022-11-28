<?php
 include_once('../db_con/db.php');
 $branch = $_SESSION['branch'];
 $user = $_SESSION['firstname'];
 
 if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ZETDC ePlanner | Leave Form</title>
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
			<p></br></p>
			<div class="panel panel-primary">
				<div class="panel-heading"  style="text-align:center;">Leave Request Summary</div>
					<div class="panel-body">
						 <table class="table table-condensed table-bordered table-striped">
							<thead>
							<th>Name</th>
							<th>Type</th>
							<th>Beginning</th>
							<th>Ending</th>
							<th>Status</th>
							<th>Date created</th>
							<th colspan="2" style="text-align:center">Decision</th>
							</thead>
								<tbody>
									<?php
									$query = mysqli_query($con,"SELECT * FROM leave_form WHERE YEAR(date_created) = YEAR(CURRENT_DATE) ORDER BY date_created DESC");
										
									while($order = mysqli_fetch_array($query)):?>
									<tr>
										<td><?=ucfirst($order['created_by']);?></td>
										<td><?=ucfirst($order['type']);?></td>
										<td><?=$order['start'];?></td>
										<td><?=$order['end'];?></td>
										<td><?=$order['status'];?></td>
										<td><?=$order['date_created'];?></td>
										<td  align="center"><a href="accept.php?id=<?=$order['id'];?>"><input style="background-color:#008000;color:white;" type="submit" value="accept"/></a></td>
										<td align="center"><a href="decline.php?id=<?=$order['id']?>"><input type="submit" value="decline" style="background-color:#FF0000;color:white;"/></a></td>
				
									</tr>
										<?php endwhile; ?>	
								</tbody>
						</table>
					</div>
			</div>
		</div>
      	
	
	</body>
</html>

