<title>Student Registration</title>
<?php
include_once('../unicode/unicode.php');
@$a = $_POST['a'];
@$b = $_POST['b'];
@$c = $_POST['c'];
@$nid = $a.$b.$c; 
@$fname = mysql_real_escape_string($_POST['fname']);
@$sname = mysql_real_escape_string($_POST['lname']); 
@$name =  $fname . "  ". $sname ; 
@$grade =  $_POST['grade'];
@$address = mysql_real_escape_string($_POST['address']);
@$home = trim(mysql_real_escape_string($_POST['home']));
@$phone = trim(mysql_real_escape_string($_POST['cell']));
@$email = trim(mysql_real_escape_string($_POST['email'])); 
@$username = mysql_real_escape_string($_POST['username']);
@$pass1 = trim(mysql_real_escape_string($_POST['pass1'])); 
@$level = "student";  
@$pass2 = trim(mysql_real_escape_string($_POST['pass2'])); 
$error = 0;

if(empty($fname)){
 echo "<script> $('#firstname').html('Enter First Name'); </script>";
 $error = 1;
}  
else if(is_numeric($fname)){ 
echo "<script>$('#firstname').html('First name must not be numerics'); </script>";
$error = 1;
} else { 
 echo "<script> $('#firstname').html('<img src='+'images/activate.png'+' />'); </script>"; 
 } 
 ////////////////////////////////////////////////////////////////
if(empty($sname)){
 echo "<script>$('#sname').html('Enter Your Last Name'); </script>";
 $error = 1;
} 
else if(is_numeric($sname)){ 
echo "<script>$('#sname').html('Sirname must not be numerics'); </script>";
$error = 1;
} else { 
 echo "<script> $('#sname').html('<img src='+'images/activate.png'+' />'); </script>";
}
/////////////////////////////////////////////////////////////////////

if(empty($address)){ 
echo "<script>$('#address').html('Enter your home address'); </script>";
$error = 1;
} 
else if(strlen($address) < 15){ 
echo "<script>$('#address').html('Home address is too short'); </script>";
$error = 1;
} 
else if(is_numeric($address)){	
echo "<script>$('#address').html('Enter Valid physical address'); </script>";
$error = 1;
} else { 
 echo "<script> $('#address').html('<img src='+'images/activate.png'+' />'); </script>"; 
}
///////////////////////////////////////////////////////////
@$lolo2 = mysql_query("select* from users where nid = '$nid'")or die(mysql_query());
@$thenid = mysql_num_rows($lolo2);

if(empty($a) && empty($b) && empty($c)){
echo "<script>$('#nid').html('Enter national id number'); </script>";
$error = 1;	 
} 
else if(!is_numeric($a)||!is_numeric($b) || strlen($a)!=2 || strlen($b)!=6){
echo "<script>$('#nid').html('Invalid national id number'); </script>";
$error = 1;	 
} 

else if($thenid > 0){
echo "<script>$('#nid').html('National ID already in use'); </script>";
	$error = 1;
   }
else if(is_numeric(substr($c,0,1)) || !is_numeric(substr($c,strlen($c)-2))){
echo "<script>$('#nid').html('invalid national ID'); </script>";
$error = 1;
} else { 
 echo "<script> $('#nid').html('<img src='+'images/activate.png'+' />'); </script>";
 }
/////////////////////////////////////////
if(empty($phone)){
echo "<script>$('#mobile').html('Enter Mobile Phone Number'); </script>";
		$error = 1;
}
else if(!is_numeric($phone)|| strlen($phone)!=13 || substr($phone,0,5) != "+2637"){
echo "<script>$('#mobile').html('Invalid Mobile Number '); </script>";
		$error = 1;
} else { 
 echo "<script> $('#mobile').html('<img src='+'images/activate.png'+' />'); </script>"; 
}

/////////////////////////////////////// 
if(!empty($email)){
	if (strlen($email)< 11 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
echo "<script>$('#email').html('This ($email) email address is considered invalid.'); </script>";
	$error = 1;
   } else { 
 echo "<script> $('#email').html('<img src='+'images/activate.png'+' />'); </script>"; 
}
}
///////////////////////////////////////////

@$alice = mysql_query("select* from users where username = '$username'")or die(mysql_query());
@$select_username = mysql_num_rows($alice);
if(empty($username)){
echo "<script>$('#username').html('Enter Username'); </script>";
	$error = 1;
   }
else if(strlen($username) < 4){
echo "<script>$('#username').html('Username too short'); </script>";
	$error = 1;
}
else if($select_username == 1){
echo "<script>$('#username').html('Username already in use'); </script>";
	$error = 1;
   } else { 
 echo "<script> $('#username').html('<img src='+'images/activate.png'+' />'); </script>"; 
}



////////////////////////////////////////////////

if(empty($pass1)){
echo "<script>$('#strong2').html('Enter password'); </script>";
$error = 1;
   }
else if(strlen($pass1) < 6){ 
$error = 1;
   } else { 
}
 /////////////////////////////////
if(empty($pass2)){
echo "<script>$('#pass2').html('Confirm Password'); </script>";
$error = 1;
   }
else if(strcmp($pass1,$pass2)!=0){
echo "<script>$('#pass2').html('Password does not match'); </script>";
$error = 1;
   } else { 
 echo "<script> $('#pass2').html('<img src='+'images/activate.png'+' />'); </script>"; 
}





/////////////////////////////////////////////////////////////////////////////////////////////


@$filenam = $_FILES["peteFilo"]["name"];
@$tmpname = $_FILES["peteFilo"]["tmp_name"];
@$filesize = $_FILES["peteFilo"]["size"];
@$filetype = $_FILES["peteFilo"]["type"];
@$fileerror = $_FILES["peteFilo"]["error"]; // 0 for false and 1 for true
/*
$allowed = array('docx','.doc','.pdf');
$ext = strtolower(substr($filenam,-4));
if(empty($filenam)){ echo "<script>$('#aform').html('Upload application form'); </script>";  $error = 1;  } 
else if(file_exists('../documents/'. $filenam)){ echo "<script>$('#aform').html('Application Form already exists'); </script>";  $error = 1;  }
else if($fileerror > 0){echo "<script>$('#aform').html('Unexpected error occured, please try again later and if the problem persists contact the I.T support group '); </script>";  $error = 1;  }
else if(!in_array($ext, $allowed)){ echo "<script>$('#aform').html('You can only upload a word document or a pdf'); </script>";  $error = 1;  } 
else if($filesize > 6291456){  echo "<script>$('#aform').html('document too large, maximum limit is 6 MB '); </script>";  $error = 1;  }
else {  echo "<script> $('#aform').html('<img src='+'../../images/activate.png'+' />'); </script>"; }
 */
////////////////////////////////////////////////////////////////////////////////////////////// 

 

if($error == 0){



error_reporting(0);
//@$ = date('d/m/Y')." ,".date('h:i:s');
@$message_details = "Your account have been successfully created at http://Gunde.comlu.com <br/> You are now authorised to assess the system and utilise the system resources <br/> your username is : $username <br/> Your password is : $pass1 <br/> You Can log into the system now http://college.comlu.com "; 
@$subject = "Confirmation of Account Creation"; 
@$mailname = "Gunde High";    //sender
@$email_address = "gundeadmins@gunde.com";  //sender
@$to = $email;     // send to 
   //@$from = stripslashes($name)."<".stripslashes($email).">"; //////////
@$petemydate = "Date Received  " . date('d/F/Y') .": [". date('h:i:a')."]"; 
@$message = "\n\nFrom: $mailname \n\nEmail: $email_address \n\nTo: $to \n\n$petemydate \n\nMessage: \n\n $message_details";	
@$peteheader = "From: ". $mailname . " <" .$email_address. ">\r\n"; //optional headerfields 
@$prosper = mail($to, $subject, $message, $peteheader);

 ///////////////////////////////////////
  






















$other = $_POST['other'];
$regno = "R".date('sdmh'); 
@$sha1pass = sha1($pass1);
@$md5pass = md5($sha1pass);
move_uploaded_file($tmpname,"../applications/".$filename);
$insert = mysql_query("INSERT INTO users(id,fname,sname,name,nid,regno,address,grade, home,phone,email,username,password,level,status,aform,other) VALUES ('','$fname','$sname','$name','$nid','$regno','$address','$grade','$home','$phone','$email','$username','$md5pass','student','1','$filename','$other')")or die (mysql_error()); 

if ($insert) {
echo ("<SCRIPT LANGUAGE='JavaScript'>alert('User $username is successfully created, your registration number is $regno'); window.location.href='index.php';</SCRIPT>");		
	}
	}
 
  
?>


