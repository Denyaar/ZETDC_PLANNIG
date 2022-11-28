<?php
mysqli_report(MYSQLI_REPORT_STRICT);

$servername = "127.0.0.1";
$username = "root";
$password = "";
$db = "eplanner";
	try{
		$con = mysqli_connect($servername, $username, $password, $db);
	}catch(Exception $e){
		?>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		 <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link href="css/style.css" rel="stylesheet">
	   
			<div class="col-md-6" align="center">
				<div class="panel panel-primary" style="float:center">
					<div class="panel-heading">Connection error</div>
					<div class="panel-body">	
						<h3 style="color:red"><?='Error connecting to server, try again later!';?></h3>
					</div>		
				</div>
			</div>
			
		<?php
		exit();
	}


?>
