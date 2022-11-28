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
		<title>ZETDC ePlanner | Weekly Task</title>
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
				<div class="panel-heading" align="center">Add branch weekly plan</div>
				<div class="panel-body">	
					<form  method="post" enctype="multipart/form-data">
									<div class="row">
											<div class="form-group  col-md-3">
												<div class="form-group">
													<label for="from" class="formText">Depot OKR</label>
														<select name="monthly_okr" class="form-control" required>
															  <option selected disabled>-- Please Select --</option>
															  <?php
																  $sql = "SELECT * FROM branch_plan

																												WHERE MONTH(deadline) = MONTH(CURRENT_DATE)
																												
																												ORDER BY branch_plan.deadline DESC";
																  $result=mysqli_query($con,$sql);
																  while($row=mysqli_fetch_array($result))
																	  echo "<option value='" . $row['id'] . "'>" . $row['title'] .".   Deadline : ". $row['deadline'] ."</option>";
															   ?>
														</select>
												</div>
											</div>
											
											<div class="form-group  col-md-3">
												<label for="from" class="formText">Objective</label>
												<input type="text"  class="form-control" name="objective"/>
											</div>
											
											<div class="form-group  col-md-3">
												<label for="from" class="formText">Deadline</label>
												<input type="date" class="form-control" name="deadline"/>
											</div>
											
											<div class="form-group  col-md-3">
												<label for="from" class="formText">Priority</label>
												<select name="priority" class="form-control" required>
													<option selected disabled>-- Please Select --</option>
															  <?php
																  $sql = "SELECT * from task_priority ORDER BY id ASC";
																  $result=mysqli_query($con,$sql);
																  while($row=mysqli_fetch_array($result))
																	  echo "<option value='" . $row['id'] . "'>" . $row['level'] ."</option>";
															   ?>
												</select>
											</div>
									</div>
									<div class="buttonHolder">
										<div class="col-md-12">
											<input style="float:center;" value="Submit" type="submit" id="submit" name="submit" class="btn btn-success">
										</div>
									</div>
									 <div align="right">
											<a href="<?=$previous?>" class="btn btn-large btn-success">Back</a>
																	
									</div>
					</form>
				</div>
				<div class="panel-footer">
               
                </div>
			</div>	
			  <p></br></p>
			<p></br></p>
			<div class="panel panel-primary">
				<div class="panel-heading"  style="text-align:center;">Branch Weekly plans Summary for Month of <?=date('F')?></div>
					<div class="panel-body">
						 <table class="table table-condensed table-bordered table-striped">
							<thead>
							<th>Depot Okr</th>
							<th>Objective</th>
							<th>Deadline</th>
							<th>Priority</th>
							<th>Decision</th>
							<th>Status</th>
							<th>Date created</th>
							<th></th>
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
										<td><?=$order['title'];?></td>
										<td><a href="index.php?page=modify_plan.php&id=<?=$order['id'];?>"><?=$order['objective'];?></td>
										<td><?=$order['deadline'];?></a></td>
										<td><?=$order['level'];?></td>
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
										<td><?=$order['state'];?></td>
										
										<td><?=$order['date_created'];?></td>
										<td><a href="index.php?page=delete.php&id=<?=$order['id'];?>"><input type="submit" value="delete" class="btn btn-primary" style="background-color:red;height:30px;"/></a></td>
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
	$objective = (mysqli_real_escape_string($con,$_POST['objective']));
	$priority = (mysqli_real_escape_string($con,$_POST['priority']));
	$monthly_okr = (mysqli_real_escape_string($con,$_POST['monthly_okr']));
	$deadline = (mysqli_real_escape_string($con,$_POST['deadline']));
	$user = $_SESSION['firstname'];
	
	
	
	
	if($deadline < date('Y-m-d') || $deadline > date('Y-m-d', strtotime(date('Y-m-d'). ' + 7 days')))
	{
		echo ("<script>alert('Please choose a deadline between today and the next 7 days.');</script>");
		exit();
	}
	
	if($monthly_okr =="" || $priority=="")
	{
		echo ("<script>alert('Please fill in all select input fields!');</script>");
		exit();
	}
	$qry = mysqli_query($con,"INSERT INTO `weekly_plan` (`id`, `branch_okr`, `branch`, `objective`, `deadline`, `priority`, `status`, `date_created`, `created_by`) 
												 VALUES (NULL, '$monthly_okr', '$branch', '$objective', '$deadline', '$priority', '-1', CURRENT_TIMESTAMP, '$user');");

	if($qry)
	{
		echo ("<script> alert('Task submitted successfully');window.location='index.php?page=weekly.php'</script>");
		
		exit();
	}else
	{
		echo ("<script>alert('Error submitting task, please try again later.');</script>");
	}

}
?>