<?php
//zemelapio klase 'maps' 


function smarty_modifier_map($lng,$koord,$desc,$width_height)
{
	switch ($lng) {
		case 'lt':
			$bubble_content = 'UAB „Sales Partners';
		break;
		case 'en':
			$bubble_content = 'UAB „Sales Partners';
		break;
		case 'ru':
			$bubble_content = 'UAB „Sales Partners';
		break;		
	}
	$koord = "54.681845,25.298417";
	if(!isset($width_height)) {
		$width_height = "100%,350"; //300,400 - pixeliais
	}
	
	
	
	$koord=explode(",", $koord);
	$width_height=explode(",", $width_height);
	
	return " 
		<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=$lng'></script>
	<script>
  function initialize() {
	var mapOptions = {
		zoom: 15,
		center: new google.maps.LatLng({$koord[0]}, {$koord[1]}),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	var map = new google.maps.Map(document.getElementById('map_canvas'),
		mapOptions);
	
	var infowindow = new google.maps.InfoWindow({infoBoxClearance: '0'});
	

		var image = new google.maps.MarkerImage('/images/icons/map.png',
			new google.maps.Size(50.0, 70.0),
			new google.maps.Point(0, 0),
			new google.maps.Point(10.0, 17.0)
		); 

		var shadow = new google.maps.MarkerImage('/images/map/shadow.png',
			new google.maps.Size(38.0, 34.0),
			new google.maps.Point(0, 0),
			new google.maps.Point(10.0, 17.0)
		);
		
		


		//icon,shadow,shape
		
		marker = new google.maps.Marker({
			position: new google.maps.LatLng({$koord[0]}, {$koord[1]}),
			map: map,
			icon: image
		});		
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
				html = '{$bubble_content}';
				infowindow.setContent(html);
				infowindow.open(map, marker);
			}
		})(marker, 1));
		
	
  }

  google.maps.event.addDomListener(window, 'load', initialize);	
	
	
	
	
	
	
	
	
	</script>
	
	<div id='map_canvas' style='width: {$width_height[0]}px; height:{$width_height[1]}px; display: block;'></div>";
}

?>
