
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ZETDC ePlanner | Login</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/pnotify.custom.min.js"></script>
        <link href="css/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />
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
				
				<p class="error"><?php $error="";echo $error; ?></p><p class="success"><?php $success="";echo $success; ?></p>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">Login</div>
				<div class="panel-body">	
						<form  method="post">
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" id="email" name = "email" class="form-control" required/>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" id="password" name="password" class="form-control" required/>
								</div>
								<div class="form-group">
									
									<input type="submit" value="login" name = "login_btn" class="btn btn-primary"/>
									<a href="sign_up.php"  style="float: right">create account<a>
								</div>
						</form>
				</div>		
			</div>			
			
		
		</div>
			<div class="panel-footer" align="center">&copy copyright ZETDC <?php   echo date('Y');?></span></div>
	</body>
</html>
<?php
//error_reporting(0);

include "db.php";
include "helpers.php";

if(isset($_POST['login_btn'])){
	//$access_level=$_POST['access_level'];
	$email = mysqli_real_escape_string($con,$_POST['email']);
	$password =  mysqli_real_escape_string($con,$_POST['password']);
	//$password = md5($password);
	
	$query="SELECT * FROM user WHERE email = '$email' AND password = '$password' ";
	$result = mysqli_query($con, $query);
	$num = mysqli_num_rows($result);
	if($num == 1){
	$object = mysqli_fetch_object($result);
	
	//fetch database objects
	$firstname = $object->firstname;
	$id = $object->id;
	$access_level = $object->access_level;
	$email = $object->email;
	$password = $object->password;
	
	$timeIn = date("Y-m-d");

	//switch case to direct each user to his view depending on his access level
	session_start();
	if(!empty($access_level)){
		mysqli_query($con,"UPDATE user SET logged = 'Online', time_in = '$timeIn' WHERE id = '$id' ");
		$_SESSION['firstname'] = $firstname;
		$_SESSION['branch'] = $object->branch;
		$_SESSION['email'] = $object->email;
	switch ($access_level) {
		case 'admin':
				
				$_SESSION['id'] = $id;
				$_SESSION['admin'] = $access_level;
				
				echo ("<script> window.location='Admin/index.php?page=dashboard.php';</script>");
			break;

		case 'employee':
				$_SESSION['id'] = $id;
				$_SESSION['employee'] = $access_level;
				echo ("<script> window.location='Employee/index.php?page=dashboard.php';</script>");
			break;
			
		case 'supervisor':
				$_SESSION['id'] = $id;
				$_SESSION['supervisor'] = $access_level;
				echo ("<script> window.location='Supervisor/index.php?page=dashboard.php';</script>");
			break;
			
		default:
			echo ("<script>alert('User account has undefined security level, please contact system adminstrator')</script>");
			break;
	}
}else{
			?>
			<script type="text/javascript">
			
			$(function(){
				new PNotify({
					title: 'Suspended',
					text: 'Sorry You are currently Suspended',
				});
			});
	</script>
	<?php

		}
			
	}
	
	else{
		$timeTried = date("l jS \of F Y h:i:s A");
		mysqli_query($con,"INSERT INTO failed_login(email,password) VALUES('$email','$password')");
		?>
		<script type="text/javascript">
		
		$(function(){
		  new PNotify({
		    title: 'Access Denied',
		    text: 'Invalid Login',
		  });
		});
</script>
<?php
		
	}
	
			
		
}


?>