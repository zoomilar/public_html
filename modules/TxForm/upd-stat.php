<?php

include_once("../../config.php");

$g_link = mysql_connect( 'localhost', $config['db_username'], $config['db_password']) or die('Could not connect to server.' );
mysql_select_db($config['db_name'], $g_link) or die('Could not select database.');

if ($_GET['veiksmas']=="settrue"){$vks="1";}
if ($_GET['veiksmas']=="setfalse"){$vks="0";}

if (($_GET['kuris'] != "")) {
 if($_GET['tipai']){$priedas="_".$_GET['tipai'];}else{$priedas="";} 	
	
 if(mysql_query("UPDATE cms_zemelapiai$priedas SET statusas='".$vks."' WHERE id='".$_GET['kuris']."'")){
  $grazint = "ok";
 }else{$grazint="neok";}
}





echo $grazint;

?>
