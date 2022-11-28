
<?php
 include_once('../db_con/db.php');
	$id = $_REQUEST['id'];
	$obj = mysqli_fetch_object(mysqli_query($con,"SELECT  weekly_plan.* FROM weekly_plan,task_status WHERE weekly_plan.id = '$id' AND status = task_status.id"));
	$plan = $obj->objective;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> ZETDC | Plan Amendment</title>
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
				<div class="panel-heading" align="center">Amend plan: <?=$plan;?></div>
				<div class="panel-body">	
					<form  method="post">
									<div class="row">
											<div class="form-group  col-md-4">
												<div class="form-group">
													<label for="from" class="formText">Depot Okr</label>
														<select name="monthly_okr"  class="form-control" required>
															  <option selected value="<?=$obj->branch_okr;?>" >-- Unchanged--</option>
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
											
											<div class="form-group  col-md-4">
												<label for="from" class="formText">Objective</label>
												<input type="text" value="<?=$obj->objective;?>" class="form-control" name="objective"/>
											</div>
											<div class="form-group  col-md-4">
												<label for="from" class="formText">Deadline</label>
												<input type="date" value="<?=$obj->deadline;?>" class="form-control" name="deadline"/>
											</div>
											
									</div>
									<div class="row">
											<div class="form-group  col-md-4">
												<label for="from" class="formText">Priority</label>
												<select name="priority" class="form-control" required>
													<option selected value="<?=$obj->priority;?>" >-- Unchanged-- --</option>
															  <?php
																  $sql = "SELECT * from task_priority ORDER BY id ASC";
																  $result=mysqli_query($con,$sql);
																  while($row=mysqli_fetch_array($result))
																	  echo "<option value='" . $row['id'] . "'>" . $row['gauge'] ."</option>";
															   ?>
												</select>
											</div>
											<div class="form-group  col-md-4">
												<label for="from" class="formText">Status</label>
												<select name="status" class="form-control" required>
													<option selected value="<?=$obj->status;?>" >-- Unchanged-- --</option>
															  <?php
																  $sql = "SELECT * from task_priority ORDER BY id ASC";
																  $result=mysqli_query($con,$sql);
																  while($row=mysqli_fetch_array($result))
																	  echo "<option value='" . $row['id'] . "'>" . $row['gauge'] ."</option>";
															   ?>
												</select>
											</div>
											<div class="form-group  col-md-4">
												<label for="from" class="formText">Created by</label>
												<input type="text" value="<?=$obj->created_by;?>" class="form-control" readonly />
											</div>
									</div>
									<div class="buttonHolder">
										<div class="col-md-12">
											<input style="float:center;" value="Update" type="submit" id="submit" name="submit" class="btn btn-success">
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
			  	<div class="panel panel-primary">
				<div class="panel-heading"  style="text-align:center;">Employees Assigned on: <?=" ".$obj->objective;?> for this week</div>
					<div class="panel-body">
						 <table class="table table-condensed table-bordered table-striped">
							<thead>
							<th>Name</th>
							<th>Daily target</th>
							<th>Started @</th>
							<th>8:00 - 10:00 hours</th>
							<th>10:30 - 12:00 hours</th>
							<th>12:00 - 13:00 hours</th>
							<th>14:00 - 16:30 hours</th>
							<th></th>
							</thead>
								<tbody>
									<?php
									$query = mysqli_query($con,"SELECT daily_plan.*,daily_timeline.* FROM daily_plan,daily_timeline 
																			WHERE daily_plan.id = daily_timeline.daily_okr
																			AND WEEK(daily_plan.date_created) = WEEK(CURRENT_DATE)
																			AND daily_plan.weekly_okr = '8'
																			GROUP BY daily_plan.created_by ORDER BY daily_plan.date_created ASC");
										
									while($order = mysqli_fetch_array($query)):?>
									<tr>
										<td><?=$order['created_by'];?></td>
										<td><?=$order['target'];?></td>
										<td><?=$order['date_created'];?></td>
										<td><?=$order['8:00-10:00'];?></td>
										<td><?=$order['10:30-12:00'];?></td>
										<td><?=$order['12:00-13:00'];?></td>
										<td><?=$order['14:00-16:30'];?></td>
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
	$monthly_okr = (mysqli_real_escape_string($con,$_POST['monthly_okr']));
	$priority = (mysqli_real_escape_string($con,$_POST['priority']));
	$deadline = (mysqli_real_escape_string($con,$_POST['deadline']));
	$status = (mysqli_real_escape_string($con,$_POST['status']));
	$objective = ucfirst(mysqli_real_escape_string($con,$_POST['objective']));
	$id = $obj->id;
	$user = $_SESSION['firstname'];
	$origin = $obj->created_by;
	
	if($monthly_okr =="" || $priority=="" || $status == "")
	{
		echo ("<script>alert('An error occured, please fill in all select input fields!');</script>");
		exit();
	}
	
							

	$qry = mysqli_query($con,"UPDATE weekly_plan SET 
											objective = '$objective',
											branch_okr ='$monthly_okr',
											priority = '$priority',
											deadline = '$deadline',
											status = '$status'
											
											WHERE id ='$id'");


	mysqli_query($con,"INSERT INTO audit_trail (action,`objective`,ip_address,created_by,originated_by)
								VALUES 		('Updation','$objective',USER(),'$user','$origin')");
		
	
	if($qry)
	{
		echo ("<script> alert('Task plan update success');window.location='index.php?page=weekly.php'</script>");
		
		exit();
	}else
	{
		echo ("<script>alert('Task plan update failed, please try again later.');</script>");
	}

}
?>