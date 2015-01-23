<?php
if (!isset($gCms)) exit;
include('dom.php');


$phid = $_GET['prop_id'];

if ( !empty($phid) )
{

	$query4 = 'SELECT * FROM '.cms_db_prefix().$lentele.' WHERE id=?';
	$dbresult4 = $db->Execute($query4,array($phid));
	$row4 = $dbresult4->FetchRow();




		$query = 'DELETE FROM  '.cms_db_prefix().$lentele.' WHERE id=?';
		 $dbresult = $db->Execute($query, array($phid));

	check_login();
	$userid = get_userid();
	$query2 = 'SELECT * FROM '.cms_db_prefix().'users WHERE user_id=?';
	$dbresult2 = $db->Execute($query2, array($userid));
	$row2 = $dbresult2->FetchRow();

	


	$query3 = 'INSERT INTO '.cms_db_prefix().'adminlog (timestamp, user_id, username, item_id, item_name, action) VALUES (?,?,?,?,?,?)';
	$db->Execute($query3, array(time(), $userid, $row2['username'], $phid, $row4['pavadinimas'], 'Deleted '.$pavad));




}

$this->Redirect($id, 'defaultadmin', $returnid);
?>