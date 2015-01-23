jQuery(document).ready(function($) {
	
	$('.changestatus').click(function(){
		var $th = $(this), $state = $th.attr('state'), $img = $th.attr('src'), $six = $("input[name='six']").val(), $fid=$th.attr('fid'), $fname=$th.attr('fname'), $link = "/admin/moduleinterface.php?mact=Titulinis,m1_,changestate,0&suppressoutput=1&_sx_="+$six+"&m1_eventid="+$fid+"&m1_nm="+$fname+"&m1_status=";
		var $icot = $th.attr('ico-t');
		var $icoi = $th.attr('ico-inv');
		
		if ($state == "true"){
			$th.attr({'state': 'false'});
			$img = $img.replace($icot, $icoi);
			//$th.attr({'src': $img});
			$state = 0;
		}else{	
			$th.attr({'state': 'true'});
			$img = $img.replace($icoi, $icot);
				
			$state = 1;
		}	
		//alert($img);
		$link = $link+$state;
		//console.log($link); 
								$.ajax({'type': 'GET', 'url': $link, 'data': "", 
									'success':function(ret){
										$th.attr({'src': $img});	
										//alert(ret);
								}, async: true});	
		
	});
	
	
	


	
});