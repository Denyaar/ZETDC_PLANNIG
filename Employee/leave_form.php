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
			<div class="panel panel-primary">
				<div class="panel-heading" align="center">Request Leave Form</div>
				<div class="panel-body">	
					<form  method="post" enctype="multipart/form-data">
									<div class="row">
											<div class="form-group  col-md-4">
												<div class="form-group">
													<label for="from" class="formText">Leave Type</label>
														<select name="type" class="form-control" required>
															  <option selected disabled>--Please Select--</option>
															  <option value="annual">Annual Leave</option>
															  <option value="maternity">Maternity Leave</option>
															  <option value="sick">Sick Leave</option>
															  
														</select>
												</div>
											</div>
											
											<div class="form-group  col-md-4">
												<label for="from" class="formText">Beginning</label>
												<input type="date"  class="form-control" name="start"/>
											</div>
											
											<div class="form-group  col-md-4">
												<label for="from" class="formText">Ending</label>
												<input type="date" class="form-control" name="end"/>
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
				<div class="panel-heading"  style="text-align:center;">Leave Request Summary</div>
					<div class="panel-body">
						 <table class="table table-condensed table-bordered table-striped">
							<thead>
							<th>Type</th>
							<th>Beginning</th>
							<th>Ending</th>
							<th>Status</th>
							<th>Date created</th>
							<th></th>
							</thead>
								<tbody>
									<?php
									$query = mysqli_query($con,"SELECT * FROM leave_form WHERE created_by = '$user' ORDER BY date_created DESC");
										
									while($order = mysqli_fetch_array($query)):?>
									<tr>
										<td><?=ucfirst($order['type']);?></td>
										<td><?=$order['start'];?></td>
										<td><?=$order['end'];?></td>
										<td><?=$order['status'];?></td>
										<td><?=$order['date_created'];?></td>
										<td><a href="index.php?page=delete_form.php&id=<?=$order['id'];?>"><input type="submit" value="delete" class="btn btn-primary" style="background-color:red;height:30px;"/></a></td>
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
	$type = (mysqli_real_escape_string($con,$_POST['type']));
	$start = (mysqli_real_escape_string($con,$_POST['start']));
	$end = (mysqli_real_escape_string($con,$_POST['end']));
	$status = "Pending";
	
	$qq = mysqli_fetch_object(mysqli_query($con,"SELECT id FROM leave_form WHERE type='annual' AND created_by = '$user' AND YEAR(date_created) = YEAR(CURRENT_DATE) ORDER BY id LIMIT 1"));
	
	if($type == "annual")
	{
		if(!empty($qq->id))
		{
			echo ("<script>alert('Oops, you cannot apply more than one annual leave within the same year!');</script>");
			exit();
		}
	}
	
	
	if($type =="")
	{
		echo ("<script>alert('Please fill in the select input field!');</script>");
		exit();
	}
	
	$qry = mysqli_query($con,"INSERT INTO `leave_form` (`type`,`start`,`end`,`status`,`created_by`) 
												 VALUES ('$type','$start','$end','$status','$user');");

	if($qry)
	{
		echo ("<script> alert('Form submitted successfully');window.location='index.php?page=leave_form.php'</script>");
		
		exit();
	}else
	{
		echo ("<script>alert('Error submitting the leave form, please try again later.');</script>");
	}

}
?>