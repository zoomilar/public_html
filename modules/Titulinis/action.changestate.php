<?PHP
	if (!isset($gCms)) exit;
	$db = $gCms->GetDb();
	include('dom.php');

	$fname = str_replace("'", "", $db->qstr($params['nm']));
	$fid = $db->qstr($params['eventid']);
	$status = $db->qstr($params['status']);
	
	//print_r($params);
	$query =  "UPDATE ".cms_db_prefix().$lentele." SET {$fname}={$status} WHERE id={$fid}";
	$db->Execute($query);

?>