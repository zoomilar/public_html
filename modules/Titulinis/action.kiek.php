<?php

if (!isset($gCms)) exit;
include('dom.php');
$db = &$gCms->GetDb();

$addi = '';
if($params['tipas'])
	$addi = "and tipas='{$params['tipas']}'";
	


	
	
$query = 'SELECT count(id) as nbm FROM '.cms_db_prefix().$lentele.' WHERE nerodyti=0 and kategorija="klientai" '.$addi.'  and del=0 ';

$result = $db->GetOne($query);   

echo $result;

?>