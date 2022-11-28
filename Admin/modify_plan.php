
<?php
 include_once('../db_con/db.php');
	$id = $_REQUEST['id'];
	$obj = mysqli_fetch_object(mysqli_query($con,"SELECT  branch_plan.* FROM branch_plan,task_status WHERE branch_plan.id = '$id' AND status = task_status.id"));
	$plan = $obj->title;
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
													<label for="from" class="formText">Branch</label>
														<select name="branch"  class="form-control" required>
															  <option selected value="<?=$obj->branch;?>" >-- Unchanged--</option>
															  <?php
																  $sql = "SELECT * from branch ORDER BY name ASC";
																  $result=mysqli_query($con,$sql);
																  while($row=mysqli_fetch_array($result))
																	  echo "<option value='" . $row['name'] . "'>" . $row['name'] ."</option>";
															   ?>
														</select>
												</div>
											</div>
											
											<div class="form-group  col-md-4">
												<label for="from" class="formText">Description</label>
												<input type="text" value="<?=$obj->title;?>" class="form-control" name="title"/>
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
				<div class="panel-heading"  style="text-align:center;">Employees Assigned on: <?=" ".$obj->title;?></div>
					<div class="panel-body">
						 <table class="table table-condensed table-bordered table-striped">
							<thead>
							<th>Name</th>
							<th>Task</th>
							<th>Started @</th>
							<th>Finishes @</th>
							<th>Supervisor</th>
							<th></th>
							</thead>
								<tbody>
									<?php
									$query = mysqli_query($con,"SELECT branch_plan.*,state,gauge FROM `branch_plan`,task_priority,task_status WHERE branch_plan.priority = task_priority.id AND status = task_status.id ORDER BY branch_plan.deadline DESC");
										
									while($order = mysqli_fetch_array($query)):?>
									<tr>
										<td><?=$order['branch'];?></td>
										<td><a href="index.php?page=modify_plan.php&id=<?=$order['id'];?>"><?=$order['title'];?></td>
										<td><?=$order['deadline'];?></a></td>
										<td><?=$order['gauge'];?></td>
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
	$branch = (mysqli_real_escape_string($con,$_POST['branch']));
	$priority = (mysqli_real_escape_string($con,$_POST['priority']));
	$deadline = (mysqli_real_escape_string($con,$_POST['deadline']));
	$status = (mysqli_real_escape_string($con,$_POST['status']));
	$title = ucfirst(mysqli_real_escape_string($con,$_POST['title']));
	$id = $obj->id;
	
	
	echo ("<script>alert('$branch - $priority- $status');</script>");
	if($branch =="" || $priority=="" || $status == "")
	{
		echo ("<script>alert('An error occured, please fill in all select input fields!');</script>");
		exit();
	}

	$qry = mysqli_query($con,"UPDATE branch_plan SET 
											title = '$title',
											branch ='$branch',
											priority = '$priority',
											deadline = '$deadline',
											status = '$status'
											
											WHERE id ='$id'");

	if($qry)
	{
		echo ("<script> alert('Task plan update success');window.location='index.php?page=plans.php'</script>");
		
		exit();
	}else
	{
		echo ("<script>alert('Task plan update failed, please try again later.');</script>");
	}

}
?>