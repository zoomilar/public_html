<?php
/*
	Zemelapis:
		Naudojimo PVZ.: {$kalba|map:"1":"640,400":"54.689394, 25.215082":"0":"0"}
		PARAMETRAI:
			1 - Kalba
			2 - Ideti JS google maps
			3 - Zemelapio aukstis ir plotis, atskirti per kableli
			4 - Koordinates, per kableli
			5 - Eiles numeris jeigu inc 0
			6 - Ar ijungti clusterius
*/


function smarty_modifier_mapc($lng, $inc, $width_height ,$koord ,$eil, $cluster, $koord_descr, $koord_descr2)
{ 
	$logo_src = "http://".$_SERVER['HTTP_HOST']."/images/map/image.png";
	$shadow_src = "http://".$_SERVER['HTTP_HOST']."/images/map/shadow.png";
	$id = $eil;
	$center = $koord;
	
	switch ($lng) {
		case 'lt':
			$marsrutas = 'Maršrutas';
			$iveskite = 'Įveskite adresą iš kur važiuosite';
			switch ($id) {
				case '0':
					$data['0']['latlong'] = $koord;
					$data['0']['apr'] = $koord_descr;
					$data['0']['apr2'] = $koord_descr2;
				break;
			}
		break;
		case 'en':
			$marsrutas = 'Route';
			$iveskite = 'Enter your current location address';
			switch ($id) {
				case '0':
					$data['0']['latlong'] = $koord;
					$data['0']['apr'] = $koord_descr;
					$data['0']['apr2'] = $koord_descr2;
				break;
			}
		break;
		case 'ru':
			$marsrutas = 'маршрут';
			$iveskite = 'Введите адрес, откуда вы едете';
			switch ($id) {
				case '0':
					$data['0']['latlong'] = $koord;
					$data['0']['apr'] = $koord_descr;
					$data['0']['apr2'] = $koord_descr2;
				break;
			}
		break;
	}
	$center=explode(",", $center);
	$width_height=explode(",", $width_height);
	
	
	$logo = list($width, $height, $type, $attr) = getimagesize($logo_src);
	$shadow = list($width, $height, $type, $attr) = getimagesize($shadow_src);

	$logo_w = round($logo['0']/2);
	$logo_h = round($logo['1']/2);
	$shadow_w = round($shadow['0']/2);
	$shadow_h = round($shadow['1']/2);
	
	
	if($cluster==1) {
		$push = "markers.push(marker);";
		$init = "
			var mcOptions = {gridSize: 40, averageCenter:1,maxZoom:10};	
			var markerCluster  = new MarkerClusterer(map, [], mcOptions);
		";
	}
	if($inc==1){
		$map = "
			<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language={$lng}'></script>
			<script src='http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js' type='text/javascript'></script>
		";
	}
	
	$markers = "";
	/*foreach ($data as $key =>$marker) {
		$koord=explode(",", $data[$key]['latlong']);
		$title = $data[$key]['apr']."<br/>".$data[$key]['gatve'];
		$markers .= "
			marker = new google.maps.Marker({
				position: new google.maps.LatLng({$koord[0]}, {$koord[1]}),
				  map:map,
				  icon: image,
				  //shadow: shadow,
				  shape: shape			
			});		
			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					infowindow.setContent(html);
					infowindow.open(map, marker);
				}
			})(marker, 1));
			".$push;
	}*/

	$markers .= "
			marker = new google.maps.Marker({
				position: new google.maps.LatLng(".$koord."),
				  map:map,
				  icon: image		
			});		
			google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
				return function() {
					html = '<div id=\"infoWindow\">{$koord_descr}<div style=\"padding: 4px 0 0 0; margin-top: 4px; border-top: 1px solid #d2d3d5\">$iveskite:<br/><form action=\"http://maps.google.com/maps\" method=\"get\" target=\"_blank\" style=\"margin:0; padding:0\"><input type=\"text\" maxlength=\"48\" name=\"saddr\" id=\"saddr\" style=\"font-size:10px; width: 200px\" value=\"\" onfocus=\"this.value=\'\'\">&nbsp;<input value=\"$marsrutas\" type=\"SUBMIT\" style=\"font-size:10px; width: 100px\"><input type=\"hidden\" name=\"hl\" value=\"lt\"><input type=\"hidden\" name=\"daddr\" id=\"daddr\" value=\"{$koord}\"></form></div><span style=\"font-size: 11px\">{$koord_descr2}</span></div>';
					//html = '<div id=\"infoWindow\"><div style=\"width:300px; min-height:100px; text-align:center\">".$koord_descr."</div></div>';
					infowindow.setContent(html);
					infowindow.open(map, marker);
				}
			})(marker, 1));
			".$push;
	
	$map .= "
	<script>
  function initialize".$eil."() {
	var mapOptions = {
		zoom: 12,
		scrollwheel: false,
		center: new google.maps.LatLng({$center[0]}, {$center[1]}),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	var map = new google.maps.Map(document.getElementById('map_canvas".$eil."'),
		mapOptions);
	
	".$init."
	
	var infowindow = new google.maps.InfoWindow();
	



		var image = new google.maps.MarkerImage(
		  '".$logo_src."',
		  new google.maps.Size(".$logo['0'].",".$logo['1']."),
		  new google.maps.Point(0,0),
		  new google.maps.Point(".$logo_w.",".$logo_h.")
		); 

		/*var shadow = new google.maps.MarkerImage(
		  '".$shadow_src."',
		  new google.maps.Size(".$shadow['0'].",".$shadow['1']."),
		  new google.maps.Point(0,0),
		  new google.maps.Point(".$shadow_w.",".$shadow_h.")
		);*/

		var shape = {
		  coord: [105,0,107,1,108,2,109,3,110,4,111,5,111,6,111,7,111,8,112,9,112,10,112,11,112,12,112,13,112,14,112,15,112,16,112,17,112,18,112,19,112,20,112,21,112,22,112,23,112,24,112,25,112,26,112,27,112,28,112,29,112,30,112,31,112,32,112,33,112,34,112,35,112,36,112,37,112,38,112,39,112,40,112,41,112,42,112,43,112,44,112,45,112,46,112,47,112,48,112,49,112,50,112,51,112,52,112,53,112,54,112,55,112,56,112,57,112,58,112,59,112,60,112,61,112,62,112,63,112,64,112,65,112,66,112,67,112,68,112,69,112,70,112,71,112,72,112,73,112,74,112,75,112,76,112,77,112,78,112,79,112,80,112,81,112,82,112,83,112,84,112,85,112,86,112,87,112,88,112,89,112,90,112,91,112,92,112,93,112,94,112,95,112,96,112,97,112,98,112,99,112,100,112,101,111,102,111,103,111,104,110,105,110,106,109,107,108,108,108,109,110,110,109,111,107,112,104,113,100,114,94,115,84,116,50,117,50,117,28,116,18,115,10,114,6,113,3,112,1,111,0,110,1,109,3,108,3,107,2,106,1,105,1,104,1,103,0,102,0,101,0,100,0,99,0,98,0,97,0,96,0,95,0,94,0,93,0,92,0,91,0,90,0,89,0,88,0,87,0,86,0,85,0,84,0,83,0,82,0,81,0,80,0,79,0,78,0,77,0,76,0,75,0,74,0,73,0,72,0,71,0,70,0,69,0,68,0,67,0,66,0,65,0,64,0,63,0,62,0,61,0,60,0,59,0,58,0,57,0,56,0,55,0,54,0,53,0,52,0,51,0,50,0,49,0,48,0,47,0,46,0,45,0,44,0,43,0,42,0,41,0,40,0,39,0,38,0,37,0,36,0,35,0,34,0,33,0,32,0,31,0,30,0,29,0,28,0,27,0,26,0,25,0,24,0,23,0,22,0,21,0,20,0,19,0,18,0,17,0,16,0,15,0,14,0,13,0,12,0,11,0,10,0,9,0,8,1,7,1,6,1,5,2,4,2,3,3,2,5,1,6,0,105,0],
		  type: 'poly'
		};


		//icon,shadow,shape
		
		var markers = [];
		".$markers."
		//markerCluster.addMarkers(markers);
		//console.log(markerCluster.getTotalMarkers());
	
  }
  google.maps.event.addDomListener(window, 'load', initialize".$eil.");	
	
	</script>
	
	<div id='map_canvas".$eil."' style='width: {$width_height[0]}; height:{$width_height[1]}; display: block;'></div>";
	return $map;
}

?>
