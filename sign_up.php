<?php
include "db.php";
 $previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ZETDC ePlanner | SignUp</title>
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
			width:30%;
			height:60%;
			
			margin: 7% auto;
			paddding: 15px;
		}.buttonHolder{ text-align: center; }{
				text-align:center;
			}
		

		
		</style>
	</head>
	<body>	
		<div class="navbar navbar-inverse navbar-fixed-top" height="40px">
			<div class="container-fluid">
				<div class="navbar navbar-header">
					<a class ="logo" href="index.php" style="color: #09525E; font-size: 12;"><img src="logo.png" height = "52px"><br><strong>Client convenience through ICT ..</strong></a>
				</div>
			</div>
		</div>
		<p><br/></p>
		<div class="container-fluid" id="loginform">
			<div class="row">
				 <?php
				 
				?>		
				
				<p class="error"><?php $error = ""; echo $error; ?></p><p class="success"><?php  $success="";echo $success; ?></p>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">SignUp</div>
				<div class="panel-body">	
						<form  method="post">
								<div class="form-group">
									<label for="account_type">Branch</label>
									<select name="branch" class="form-control" required>
											<option selected disabled>-- Please Select --</option>
															  <?php
																  $sql = "SELECT * FROM branch ORDER BY name ASC";
																  $result=mysqli_query($con,$sql);
																  while($row=mysqli_fetch_array($result))
																	  echo "<option value='" . $row['name'] . "'>" . $row['name']."</option>";
															   ?>
														</select>
									<label for="email">Firstname</label>
									<input type="text" id="name" name = "firstname" class="form-control" required/>
								</div>
								<div class="form-group">
									<label for="password">Lastname</label>
									<input type="text" id="email" name="lastname" class="form-control" required/>
								</div>
								<div class="form-group">
									<label for="password">Email</label>
									<input type="email" id="email" name="email" class="form-control" required/>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" id="email" name="password" class="form-control" required/>
								</div>
								<div class="buttonHolder">
									<input type="submit" value="Submit" id="signup" name="signup" class="btn btn-large btn-success" />
								</div>
									 <div align="right">
											<a href="<?php echo $previous;?>" class="btn btn-large btn-success">Back</a>
											
										</div>
					</form>
							
								
						</form>
				</div>		
			</div>			
			
		
		</div>
			<div class="panel-footer" align="center">&copy copyright ZETDC <?php echo date('Y');?></span></div>
	</body>
</html>
<?php

session_start();

include "helpers.php";

if(isset($_POST['signup'])){
	$branch = $_POST['branch'];
	$firstname = mysqli_real_escape_string($con,$_POST['firstname']);
	$lastname = mysqli_real_escape_string($con,$_POST['lastname']);
	$mobile_phone = mysqli_real_escape_string($con,$_POST['mobile_phone']);
	$password = mysqli_real_escape_string($con,$_POST['password']);
	$access_level = "employee";
	$email = mysqli_real_escape_string($con,$_POST['email']);

	
	$email_query = mysqli_query($con,"SELECT * FROM user WHERE email = '$email'");
	$num = mysqli_num_rows($email_query);
		
		if($num > 0){
			echo ("<script> alert('Email: $email is already in use!, please use another email address');</script>");
			exit();
		}
		
		$qry = mysqli_query($con,"INSERT INTO `user` (`id`, `firstname`, `lastname`,`password`, `access_level`, `email`, `branch`, `date_created`) 
												VALUES (NULL, '$firstname', '$lastname', '$password', '$access_level', '$email', '$branch', CURRENT_TIMESTAMP);");
	
		if($qry)
		{
			echo ("<script> alert('User registered successfully!');</script>");
			echo ("<script> window.location='index.php';</script>");
		}
		else
		{
			echo ("<script> alert('Failed to register new user, please try again later!');</script>");
		}		
}


?>