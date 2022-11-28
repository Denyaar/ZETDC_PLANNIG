<?php
 include_once('../db_con/db.php');
 $branch = $_SESSION['branch'];
 
 if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ZETDC ePlanner | Branch Task</title>
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
				<div class="panel-heading"  style="text-align:center;"><?=ucfirst($branch)?> OKR &amp; Plan Summary : <?=date('Y')?></div>
					<div class="panel-body">
						 <table class="table table-condensed table-bordered table-striped">
							<thead>
							<th>Title</th>
							<th>Deadline</th>
							<th>Priority</th>
							<th>Status</th>
							<th>Created</th>
							</thead>
								<tbody>
									<?php
									$query = mysqli_query($con,"SELECT branch_plan.*,state,level FROM `branch_plan`,task_priority,task_status

																												WHERE branch_plan.priority = task_priority.id 
																												AND status = task_status.id 
																												AND YEAR(deadline) = YEAR(CURRENT_DATE)
																												
																												ORDER BY branch_plan.deadline DESC");
										
									while($order = mysqli_fetch_array($query)):?>
									<tr>
										<td><?=$order['title'];?></td>
										<td><?=$order['deadline'];?></td>
										<td><?=$order['level'];?></td>
										<td><?=$order['state'];?></td>
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
	$branch = (mysqli_real_escape_string($con,$_POST['branch']));
	$priority = (mysqli_real_escape_string($con,$_POST['priority']));
	$deadline = (mysqli_real_escape_string($con,$_POST['deadline']));
	$title = ucfirst(mysqli_real_escape_string($con,$_POST['title']));
	$user = $_SESSION['firstname'];
	
	
	if($deadline < date('Y-m-d') || $deadline > date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days')))
	{
		echo ("<script>alert('Please choose a deadline between today and the next 30 days.');</script>");
		exit();
	}
	
	if($branch =="" || $priority=="")
	{
		echo ("<script>alert('Please fill in all select input fields!');</script>");
		exit();
	}
	$qry = mysqli_query($con,"INSERT INTO `branch_plan` (`branch`,`title`, `priority`, `deadline`, `status`,`created_by`)
												VALUES ('$branch', '$title', '$priority', '$deadline', '-1','$user');");

	if($qry)
	{
		echo ("<script> alert('Task submitted successfully');window.location='index.php?page=plans.php'</script>");
		
		exit();
	}else
	{
		echo ("<script>alert('Error submitting task, please try again later.');</script>");
	}

}
?>