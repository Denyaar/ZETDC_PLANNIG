
<?php
session_start();
include_once('addco.php');
include_once('db_con/db.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Fincheck plus | Company</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="../js/jquery-ui-1.10.4.min.js"></script>
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
}
		
		</style>
	</head>
	<body>	
	
		<div class="container-fluid">
					<div class="panel panel-primary">
				<div class="panel-heading">Search Company</div>
				<div class="panel-body">	
						<form  method="post">
								<div class="form-group">
									<table class="table-reponsive">
										<tr>
									<label for="password">Company Name</label>
									<td width="144"><input type="text" id="coName" name="coName" class="form-control" placeholder="Search..." required/></td><td width="775"><span class="input-group-btn">
                                            <button class="btn btn-success" type="submit" name="searcher">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span></td>
									<td width="97"><a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-large btn-success">+ Add Company </a>       
		
    </td>
										</tr>
                                     
                                        
                               <div id="display_ne"> 
								</table>
								<hr>
								<div class="table-reponsive">
								<table class="table table-bordered table-striped table-auto table-condensed" width="100%">
							
									<tr>
										<th></th>
										<th>Fins Number</th>
										<th>Registration Name</th>
										<th>Trading Name</th>
										<th>Address</th>
										<th align="center">Edit</th>
										<th align="center">Delete</th>
									</tr>
									
									<?php
									if(isset($_POST['searcher'])){
										$num = 1;
									$skey = mysqli_real_escape_string($con,$_POST['coName']);
									$qry = "SELECT * FROM company WHERE fins_number LIKE '%$skey%' OR reg_name LIKE '%$skey%'";
									$rst = mysqli_query($con,$qry)or die(mysqli_error());
									while ($rows = mysqli_fetch_array($rst)) 
									{
									?>

									<tbody>
										<tr>
											<td><?php echo $num; ?></td>
											<td><a name="mycompanyid" value="<?php echo $rows['id'];?>" href="index.php?page=viewCo.php&id=<?php echo $rows['fins_number'];?>"><?php echo $rows['fins_number'];?></a></td>
											<td><?php echo $rows['reg_name'];?></td>
											<td><?php echo $rows['trading_name'];?></td>
											<td><?php echo $rows['current_address'];?></td>
											<td align="center"><a href="index.php?page=editCo.php&id=<?php echo $rows['id']; ?>"><i class="fa fa-edit"></i></td>
											<td align="center"><a href="index.php?page=deleteCo.php&id=<?php echo $rows['id']; ?>"><i class="fa fa-trash"></i></td>
										</tr>
									</tbody>
									<?php
									$num++;
										}
									}
									?>
							
										
                                       
										
								</table> 
                                </div>
									
								
							    </div>
								</div>
								
							
								
						</form>

				</div>		
			</div>			
			</div>
		
	
	</body>
</html>

<?php
 if(isset($_POST['mycompanyid'])){
	 $_SESSION['IDGET'] = $_POST['mycompanyid'];
 }
?>   

