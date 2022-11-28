<?php
@$pass1 = $_REQUEST['pass1'];
 
@$pass2 = strlen($pass1);
if(!empty($pass2)){ /////
if($pass2 > 9){ $pass2 = 9; }
$pass3 = $pass2*16.7; 
if($pass2 <= 3){ $short = " <span style='+'color:#FF0000;'+'>too short</span>"; }
else if($pass2 <= 5){ $short = " <span style='+'color:#CC0000'+'>short</span>"; }
else if($pass2 <= 7) { $short = "<span style='+'color:#31A5FB'+'>Strong</span>"."<img src='+'images/activate.png'+' />"; }
else { $short = "<span style='+'color:#1E86DB'+'>very strong</span>"."<img src='+'images/activate.png'+' />"; }
 
echo "<script>$('#strong').css('width','$pass3'); $('#strong2').html('$short'); </script>";
}/////////////
?>


<style type="text/css">


</style>