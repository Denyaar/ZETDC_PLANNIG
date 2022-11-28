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
		<title>ZETDC ePlanner |  Review Weekly OKR</title>
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
				<div class="panel-heading"  style="text-align:center;">Review Weekly OKR &amp; Plans for month of <?=date('F')?></div>
					<div class="panel-body">
						 <table class="table table-condensed table-bordered table-striped">
							<thead>
							<th>Depot</th>
							<th>Depot Okr</th>
							<th>Objective</th>
							<th>Deadline</th>
							<th>Priority</th>
							<th>Status</th>
							<th>Decision</th>
							<th>Date created</th>
							<th colspan="2" style="text-align:center">Process decision</th>
							</thead>
								<tbody>
									<?php
									$query = mysqli_query($con,"SELECT weekly_plan.*,title,state,level FROM `weekly_plan`,task_priority,task_status,branch_plan

																												WHERE weekly_plan.priority = task_priority.id 
																												AND weekly_plan.status = task_status.id AND branch_okr = branch_plan.id 
																												AND MONTH(weekly_plan.deadline) = MONTH(CURRENT_DATE)
																												
																												ORDER BY weekly_plan.deadline DESC");
										
									while($order = mysqli_fetch_array($query)):?>
									<tr>
										<td><?=$order['branch'];?></td>
										<td><?=$order['title'];?></td>
										<td><?=$order['objective'];?></td>
										<td><?=$order['deadline'];?></td>
										<td><?=$order['level'];?></td>
										<td><?=$order['state'];?></td>
										<td><?php 
												if($order['decision'] == -1)
												{
														echo "Awaiting approval";
												}
												else if($order['decision'] == 0)
												{
													echo "Declined";
												}
												else 
												{
													echo "Accepted";
												}
												?></td>
										<td><?=$order['date_created'];?></td>
										<td  align="center"><a href="accept_plan.php?id=<?=$order['id'];?>"><input style="background-color:#008000;color:white;" type="submit" value="accept"/></a></td>
										<td align="center"><a href="decline_plan.php?id=<?=$order['id']?>"><input type="submit" value="decline" style="background-color:#FF0000;color:white;"/></a></td>
				
									</tr>
										<?php endwhile; ?>	
								</tbody>
						</table>
					</div>
			</div>
		</div>
      	
	
	</body>
</html>

