
<?php
 include_once('../db_con/db.php');
	$id = $_REQUEST['id'];
	$_SESSION['it'] = $id;
	$obj = mysqli_fetch_object(mysqli_query($con,"SELECT  * FROM inventory WHERE id = '$id'"));
	$item = $obj->name;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> ZETDC | ePlanner</title>
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
				<div class="panel-heading" align="center">Update Inventory Item : <?=$item;?></div>
				<div class="panel-body">	
					<form  method="post">
									<div class="row">
											<div class="form-group  col-md-6">
												<label for="from" class="formText">Quantity</label>
												<input type="number"  value="<?=$obj->quantity;?>" class="form-control" name="quantity"/>
											</div>
											<div class="form-group  col-md-6">
												<label for="from" class="formText">Reorder cap</label>
												<input type="number" value="<?=$obj->reorder_cap;?>" class="form-control" name="reorder"/>
											
											</div>
									</div>
									<div class="buttonHolder">
										<div class="col-md-12">
											<input style="float:center;" value="Update" type="submit" id="submit" name="submit" class="btn btn-success">
										</div>
									</div>
									 <div align="right">
											<a href="index.php?page=viewCo.php&id=<?php echo $id;?>" class="btn btn-large btn-success">Back</a>
																		
										</div>
					</form>
				</div>
				<div class="panel-footer">
               
                </div>
			</div>	
			  <p></br></p>
		</div>
      	
	
	</body>
</html>

<?php
if(isset($_POST['submit']))
{
	$ts = $_SESSION['it'];
	$reorder = mysqli_real_escape_string($con,$_POST['reorder']);
	$quantity = mysqli_real_escape_string($con,$_POST['quantity']);
	

	$qry = mysqli_query($con,"UPDATE inventory SET quantity = '$quantity' AND reorder_cap = '$reorder' WHERE id ='$ts'");

	if($qry)
	{
		echo ("<script> alert('Inventory update success');window.location='index.php?page=inventory.php'</script>");
		
		exit();
	}else
	{
		echo ("<script>alert('Error submitting inventory update, please try again later.');</script>");
	}

}
?>