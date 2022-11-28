<?php
 include_once('../db_con/db.php');
 $user = $_SESSION['username'];
	

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ZETDC ePlanner | Report</title>
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
		<form method="post">
			<p></br></p>
			<div class="row">
				
				<div class="col-md-4">
					<label>Frequency</label>
					<select name="period" required>
						<option disabled selected>--Please Select--</option>
						<?php
							 $sql = "SELECT * from report_frequency";
							 $result=mysqli_query($con,$sql);
							 while($row=mysqli_fetch_array($result))
							  echo "<option value='" . $row['reference'] . "'>" . $row['frequency'] ."</option>";
						 ?>
					</select>
				</div>
					<div class="col-md-4">
					<label>Report Subject</label>
					<select name="subject" required>
						<option disabled selected>--Please Select--</option>
						<?php
							 $sql = "SELECT * from report_subject";
							 $result=mysqli_query($con,$sql);
							 while($row=mysqli_fetch_array($result))
							  echo "<option value='" . $row['subject'] . "'>" . $row['subject'] ."</option>";
						 ?>
					</select> 
					</div>
				
			</div>
				<p><br/></p>
				<div class="buttonHolder">
					<div class="col-md-12">
						<input style="float:center;" value="Generate" type="submit" id="submit" name="submit" class="btn btn-success">
					</div>
				</div>
		
			<p><br/></p>
			<p><br/></p>
			<div class="panel panel-primary">
			
				<div class="panel-heading"  style="text-align:center;">Report</div>
					<div class="panel-body">
						 <table class="table table-condensed table-bordered table-striped">
							<thead>
							<th>Branch plans</th>
							<th>Highest completed plans</th>
							<th>Highest committed plans</th>
							<th>Weekly done OKR's</th>
							<th>Daily new targets</th>
							<th>Pending weekly plans</th>
							</thead>
								<tbody>
									<?php
									if(isset($_POST['submit']))
									{
										
									
										$period = $_POST['period'];
										$query = mysqli_query($con,"SELECT 
																				(SELECT IFNULL(COUNT(*),'No data') FROM `branch_plan` WHERE `branch_plan`.date_created  BETWEEN  (CURRENT_DATE - INTERVAL '$period' DAY) AND CURRENT_DATE )branch_case,
																				(SELECT IFNULL(`weekly_plan`.branch,'No data') FROM `weekly_plan` WHERE weekly_plan.status = 1
																																										AND `weekly_plan`.date_created  BETWEEN  (CURRENT_DATE - INTERVAL '$period' DAY) 
																																													AND CURRENT_DATE  GROUP BY weekly_plan.branch ORDER BY COUNT(*) LIMIT 1 )highest_branch,
																				(SELECT IFNULL(COUNT(*),0) FROM `branch_plan` WHERE `branch_plan`.`status` = 0 	AND `branch_plan`.date_created  BETWEEN  (CURRENT_DATE - INTERVAL '$period' DAY) 
																																													AND CURRENT_DATE  GROUP BY branch_plan.`status` ORDER BY COUNT(*) LIMIT 1 )brcommitted_plans,
																				(SELECT IFNULL(COUNT(*),0) FROM `weekly_plan` WHERE `weekly_plan`.`status` = 1 	AND `weekly_plan`.date_created  BETWEEN  (CURRENT_DATE - INTERVAL '$period' DAY) 
																																													AND CURRENT_DATE  GROUP BY weekly_plan.`status` ORDER BY COUNT(*) LIMIT 1 )we_done,
																				(SELECT IFNULL(COUNT(*),0) FROM `daily_plan` WHERE `daily_plan`.`status` = -1 	AND `daily_plan`.date_created  BETWEEN  (CURRENT_DATE - INTERVAL '$period' DAY) 
																																													AND CURRENT_DATE   ORDER BY COUNT(*) LIMIT 1 )daily_new_plan,
																				(SELECT IFNULL(COUNT(*),0) FROM `weekly_plan` WHERE `weekly_plan`.`status` = 3 	AND `weekly_plan`.date_created  BETWEEN  (CURRENT_DATE - INTERVAL '$period' DAY) 
																																													AND CURRENT_DATE  GROUP BY status ORDER BY COUNT(*) LIMIT 1 )pending_weekly
																				FROM `weekly_plan`
																	LEFT JOIN daily_plan ON weekly_okr = weekly_plan.id
																	WHERE `weekly_plan`.date_created  BETWEEN  (CURRENT_DATE - INTERVAL '$period' DAY) AND CURRENT_DATE 
																	LIMIT 1
																	")/*Nashtech Global*/;
										
									while($order = mysqli_fetch_array($query)):?>
									<tr>
										<td><?php
												if($order['branch_case'] == "")
												{
														echo "No data";
												}else{echo $order['branch_case'];}	
													?></td>
										<td><?php
											if($order['highest_branch'] == "")
												{
														echo "No data";
												}else{echo $order['highest_branch'];}	
												?></td>
										<td><?php
											if($order['brcommitted_plans'] == "")
												{
														echo "No data";
												}else{echo $order['brcommitted_plans'];}	
												?>
										</td>
										<td><?php
												if($order['we_done'] == "")
												{
														echo "No data";
												}else{echo $order['we_done'];}	
												?></td>
										<td><?php
												if($order['daily_new_plan'] == "")
												{
														echo "No data";
												}else{echo $order['daily_new_plan'];}
										?></td>
										<td><?php
												if($order['pending_weekly'] == "")
												{
														echo "No data";
												}else{echo $order['pending_weekly'];}
										?></td>
									</tr>
										
								</tbody>
						</table>
						<label>Report Comment</label>
						<?php
							$branch_case = $order['branch_case'];
							if($order['branch_case'] == "" || empty($order['branch_case'])){
								$branch_case = 0;
							}
							
							$we_done = $order['we_done'];
							if($order['we_done'] == "" || empty($order['we_done'])){
								$we_done = 0;
							}
							
							
							
							$rate = round(($we_done / $branch_case)* (100),2);
							
							if($branch_case == 0){$rate = 0.00;}
						?>
						
						<textarea type="text" style="width:100%;height:80px" readonly ><?=$order['highest_branch']." "?> branch has showed now that it has the most number of employees meeting deadlines and targets. In addittion, <?= strtolower($order['highest_branch'])." "?> has got the highest committed and done plans  all depots countrywide with a marginal difference of <?=$rate?>%. against other branches.</textarea>
						
						<?php endwhile;}?>
						
					</div>
			</div>
		</form>
		</div>
      	
	
	</body>
</html>
