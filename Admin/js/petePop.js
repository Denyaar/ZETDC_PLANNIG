$(document).ready(function() {
	function hideArray(){
	setTimeout(function(){
		$("#peteBackground").slideUp("slow",function(){ });
		
	},600);		
	}
		$('#peteBackground').hide();
	
    $(".create_votes").click(function(){
		$('#peteBackground').fadeIn("slow");
		$("#petepopBox").fadeIn("slow");
		return false;
		
	});
	 $("#peteClose").click(function(){
		$('#peteBackground').fadeOut("slow");
		$("#petepopBox").fadeOut("slow");
		return false;
		
	});
	$("#peteBackground").click(function(){
		$("#petepopBox").fadeOut("slow");
		$('#peteBackground').slideDown("slow");
		hideArray();
		
		return false;
		
	});
	
	
	
	
	

	function hideArray2(){
	setTimeout(function(){
		$("#peteBackground2").slideUp("slow",function(){ });
		
	},600);		
	}
		$('#peteBackground2').hide();
	
    $(".create_votes2").click(function(){
		$('#peteBackground2').fadeIn("slow");
		$("#petepopBox2").fadeIn("slow");
		return false;
		
	});
	 $("#peteClose2").click(function(){
		$('#peteBackground2').fadeOut("slow");
		$("#petepopBox2").fadeOut("slow");
		return false;
		
	});
	$("#peteBackground2").click(function(){
		$("#petepopBox2").fadeOut("slow");
		$('#peteBackground2').slideDown("slow");
		hideArray2();
		
		return false;
		
	});
});
