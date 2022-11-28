<?php
 include_once('../db_con/db.php');
 $branch = $_SESSION['branch'];
 
 if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
$user = $_SESSION['firstname'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ZETDC ePlanner | Task Today</title>
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
				<div class="panel-heading" align="center">Today's schedule</div>
				<div class="panel-body">	
					<form  method="post" >
									<div class="row">
											<div class="form-group  col-md-4">
												<label for="from" class="formText">Weekly OKR</label>
												<select name="weekly_okr" class="form-control" required>
													<option selected disabled>-- Please Select --</option>
															  <?php
																  $sql = "SELECT * FROM weekly_plan WHERE WEEK(deadline) = WEEK(CURRENT_DATE) AND branch = '$branch'
																												ORDER BY weekly_plan.deadline DESC";
																  $result=mysqli_query($con,$sql);
																  while($row=mysqli_fetch_array($result))
																	  echo "<option value='" . $row['id'] . "'>" . $row['objective'] ."  Deadline: ". $row['deadline'] ."</option>";
															   ?>
												</select>
											</div>
											<div class="form-group  col-md-4">
												<label for="from" class="formText">Target</label>
												<input type="text"  class="form-control" name="target"/>
											</div>
											<div class="form-group  col-md-4">
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
									<hr style="height:1px;">
									<div class="row">
										<div class="form-group  col-md-3">
											<label for="from" class="formText">8:00 - 10:00 hours</label>
											<input type="text" class="form-control" name="first"/>
										</div><div class="form-group  col-md-3">
											<label for="from" class="formText">10:30 - 12:00 hours</label>
											<input type="text" class="form-control" name="second"/>
										</div><div class="form-group  col-md-3">
											<label for="from" class="formText">12:00 - 13:00 hours</label>
											<input type="text" class="form-control" name="third"/>
										</div><div class="form-group  col-md-3">
											<label for="from" class="formText">14:00 - 16:30 hours</label>
											<input type="text" class="form-control" name="fourth"/>
										</div>
									</div>
									<p><br/></p>
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
				<div class="panel-heading"  style="text-align:center;">Today's Summary</div>
					<div class="panel-body">
						 <table class="table table-condensed table-bordered table-striped">
							<thead>
							<th>Target</th>
							<th>8:00 - 10:00</th>
							<th>10:30 - 12:00</th>
							<th>12:00 - 13:00</th>
							<th>14:00 - 16:30</th>
							<th>Priority</th>
							<th>Status</th>
							<th>Date created</th>
							<th></th>
							</thead>
								<tbody>
									<?php
									$query = mysqli_query($con,"SELECT daily_timeline.*,daily_plan.*,state,level 
													FROM `daily_plan`,task_priority,task_status,daily_timeline

														WHERE daily_timeline.daily_okr = daily_plan.id 
														AND daily_plan.priority = task_priority.id 
														AND status = task_status.id AND created_by = '$user'
														AND DAY(date_created) = DAY(CURRENT_DATE)
														ORDER BY daily_plan.date_created DESC");
										
									while($order = mysqli_fetch_array($query)):?>
									<tr>
										<td><?=$order['target'];?></td>
										<td><?=$order['8:00-10:00'];?></td>
										<td><?=$order['10:30-12:00'];?></td>
										<td><?=$order['12:00-13:00'];?></td>
										<td><?=$order['14:00-16:30'];?></td>
										<td><?=$order['level'];?></td>
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
	
	$weekly_okr = (mysqli_real_escape_string($con,$_POST['weekly_okr']));
	$priority = (mysqli_real_escape_string($con,$_POST['priority']));
	$target = (mysqli_real_escape_string($con,$_POST['target']));
	
	
	
	$first = ucfirst(mysqli_real_escape_string($con,$_POST['first']));
	$second = ucfirst(mysqli_real_escape_string($con,$_POST['second']));
	$third = ucfirst(mysqli_real_escape_string($con,$_POST['third']));
	$fourth = ucfirst(mysqli_real_escape_string($con,$_POST['fourth']));
	$query_id = mysqli_fetch_object(mysqli_query($con,"SELECT id FROM daily_plan WHERE created_by = 'Tendai' AND DAY(date_created) = DAY(CURRENT_DATE) ORDER BY id DESC LIMIT 1"));
	
	if(!empty($query_id->id))
	{
		echo ("<script>alert('Sorry, you have already updated your daily schedule!');</script>");
		exit();
	}	
	
	if($weekly_okr =="" || $priority=="")
	{
		echo ("<script>alert('Please fill in all select input fields!');</script>");
		exit();
	}
	
	$qry = mysqli_query($con,"INSERT INTO `daily_plan` (`weekly_okr`, `target`, `priority`, `status`,`created_by`)
												VALUES ('$weekly_okr', '$target', '$priority', '-1','$user');");

	if($qry)
	{
		$query_id = mysqli_fetch_object(mysqli_query($con,"SELECT id FROM daily_plan WHERE created_by = '$user' AND DAY(date_created) = DAY(CURRENT_DATE) ORDER BY id DESC LIMIT 1"));
		
		$new_id = $query_id->id;
		
		$qry2 = mysqli_query($con,"INSERT INTO `daily_timeline` (`daily_okr`, `8:00-10:00`, `10:30-12:00`, `12:00-13:00`, `14:00-16:30`)
															VALUES ('$new_id', '$first', '$second', '$third', '$fourth');");
		
		if($qry2)
		{
			echo ("<script> alert('Schedule submitted successfully');window.location='index.php?page=today.php'</script>");
		}else
		{
			echo ("<script> alert('The task schedule has been saved but its timelines were not captured');window.location='index.php?page=today.php'</script>");
			exit();
		}
		
	}else
	{
		echo ("<script>alert('Error submitting the schedule, please try again later.');</script>");
	}

}
?>