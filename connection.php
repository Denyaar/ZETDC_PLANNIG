<?php
error_reporting(0);
include "db.php";


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Fincheck plus | Connection Error</title>
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

		
		</style>
	</head>
	<body>
		<div class="container-fluid" style="float: center">
			<div class="panel panel-primary">
				<div class="panel-heading">Connection error</div>
				<div class="panel-body">	
						<form  method="post">
							<h3>Error connecting to the server</h3><span class="fa fa-home"><a href="http://fincheckzim.com"></a></span>
						</form>
				</div>		
			</div>
		</div>
			<div class="panel-footer" align="center">&copy copyright Fincheck <?php echo date('Y');?></span></div>
	
	</body>
</html>
