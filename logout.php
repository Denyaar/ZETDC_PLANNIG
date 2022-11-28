
<?php 
error_reporting(0);
session_start();
session_destroy();
$id = $_SESSION['id'];
$timeIn = date("l jS \of F Y h:i:s A");
include "db.php";
mysqli_query($con,"UPDATE users SET logged = 'Offline', timeIn = '$timeIn' WHERE id = '$id' ");
header('location:index.php');
?>