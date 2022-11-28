<?php
include "../db_con/db.php";
error_reporting(0);
session_start();
if(!isset($_SESSION['admin'])){
echo"<script language=javascript>window.location='../index.php';</script>";
}

$name = $_SESSION['firstname'];

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/bootstrap.min.css"/>
    	 <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
         <link href="../css/profPic.css" rel="stylesheet" type="text/css">
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		
		<!--MORRIS-->
	<link href="../css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
 		 <!--  <link href="css/animate.css" rel="stylesheet">  -->
    <link href="../css/style.css" rel="stylesheet">
	<style>
		.buttonHolder{ text-align: center; }{
				text-align:center;
			}
	</style>	
	</head>
	<body>	
	 <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse" >        
               
             <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php  echo "Hi ".ucfirst($name);?></strong>
                             </span>  </span> </a>
                    </div>
                    <div class="logo-element">
	                 +
                    </div>
                </li>
                
				    <li>
                    <a href="index.php?page=dashboard.php"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span> <span></span></a>
                </li>
				<li>
                     <a href="#"><i class="fa fa-calendar"></i> <span class="nav-label">Job Assignment</span><span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level">
                        <li>
						 <a href="index.php?page=plans.php"><i class="fa fa-plus-circle"></i><span class="nav-label">Branch Tasks</span><span class="fa arrow"></span></a>
						 <a href="index.php?page=our_week.php"><i class="fa fa-calendar"></i><span class="nav-label">Branch Weekly</span><span class="fa arrow"></span></a>
						</li>
					</ul>
                </li>
				
                 <li>
					  <a href="#"><i class=" fa fa-wrench"></i> <span class="nav-label">Tools &amp; Equipment</span><span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level">
                        <li>
						 <a href="index.php?page=inventory.php"><i class="fa fa-cog"></i> <span class="nav-label">Management</span><span class="fa arrow"></span></a>
   						 <a href="index.php?page=requisition.php"><i class="fa fa-download"></i> <span class="nav-label">Requisitions</span><span class="fa arrow"></span></a>
						</li>
					</ul>
				</li>
				<li>
					 <a href="#"><i class=" fa fa-users"></i> <span class="nav-label">Human Resource</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
						 <a href="index.php?page=leaveform.php"><i class="fa fa-calendar"></i> <span class="nav-label">Leave forms</span><span class="fa arrow"></span></a>
						</li>
					</ul>
				</li>
				<li>
					 <a href="#"><i class=" fa fa-flag"></i> <span class="nav-label">Report</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
						  <a href="index.php?page=report.php"><i class="fa fa-file"></i> <span class="nav-label">Plans &amp; Okr</span><span class="fa arrow"></span></a>
						</li>
					</ul>
				</li>
                
				<li>
                     <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Profile</span><span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level">
					   <li><a href="../logout.php"><i class="fa fa-power-off"></i> <span class="nav-label">Logout</a></li>
						
					</ul>
                </li>
               
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">


        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            
		
        </div>	
				
		
			

        </nav>
                <?php 
  
        $pg = @$_REQUEST['page'];
        if($pg != "" && file_exists(dirname(__FILE__)."/".$pg)){
        require(dirname(__FILE__)."/".$pg);
        }elseif(!file_exists(dirname(__FILE__)."/".$pg))
        include_once(dirname(__FILE__)."/pages/404.php");
        else{
    //  include_once("dex.php");
        }
?>
        </div>
				

		</div>
        
        
    
        </div>
			
		
    </div>
	
	   

	    <script src="../js/plugins/jquery-ui/jquery-ui.min.js"></script>
	
	    <!-- Mainly scripts -->

    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	
	   <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>
	</body>
	
</html>
