<?php
$lentele = "tx_n_titulinis";
$pavad = "Titulinis";
$sortinti = "eiliskumas";
$kalbos = "lt,en";

$mod['klientai'] = false;
/*
	Galimi laukai:
		antraste - text
		antraste2 - text
		pavadinimas - text
		pavadinimas2 - text
		pavadinimas3 - text
		tekstas - textarea
		nuoroda - text
		nuorodatxt - text
		tipas 
		kalba - kalbumeniu
		eiliskumas
		nerodyti
		kategorija
		paveiksliukas - image

*/
$approve_style = array('nerodyti');


$titulinio_tabai = array(
	array(
		"title" => "foto", 
		"title_text" => "Titulinio nuotraukos", 
		"allowed_inputs" => array("paveiksliukas", "tekstas", "kalba", "nerodyti")
	)
	
);

?>
