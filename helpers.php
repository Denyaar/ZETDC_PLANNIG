<?php
function display_errors($errors){
	$display = "<div class='alert alert-warning'>";
	foreach($errors as $error){
		$display .= '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'.$error.'</b>';
		

	}
	$display .= "</div>";
	return $display;
}
function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}



?>