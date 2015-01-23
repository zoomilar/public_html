<?php

//require_once("../../include.php");
//check_login();

if (!isset($gCms)) exit;
include('dom.php');
check_login();
$phid = $_GET['prop_id'];



if ( !empty($phid) )
{

$degalines = $this->getDegalines();

$delimiter = ";";

@ob_clean();
@ob_clean();
header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private',false);
header('Content-Description: File Transfer');
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename=export.csv');
	echo "\xEF\xBB\xBF";

	$row = $this->adb->getRow("SELECT * FROM ".cms_db_prefix().$lentele." WHERE id=?", array($phid));
		
	$table = cms_db_prefix().$row['formalias'];
	$this->getTableDetails($table);
	$this->rfields;
	
	foreach($this->rfields as $rf){
		echo $rf.$delimiter;	
	}	
	echo "\n";
	
	
	$q = $this->adb->Execute("SELECT * FROM {$table}");
	while($q && ($r = $q->FetchRow())){
		foreach($this->rfields as $rf){
			$val = $r[$rf];
			if ($rf=="adresas")
				$val = $degalines[$val];
		
			echo $val.$delimiter;
		}
		echo "\n";
	}

	

}

?>