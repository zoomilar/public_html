<?php
if (!isset($gCms)) exit;
$phid = $_GET['prop_id'];

if ( !empty($phid) )
{

	$ikur = $_GET['m1_npoz'];
	$query = 'SELECT eiliskumas FROM '.cms_db_prefix().'zemelapiai WHERE id = ?';
	$dbresult = $db->Execute($query, array($_GET['prop_id']))->FetchRow();
	$kelintas = $dbresult['eiliskumas'];


	$query = 'SELECT MAX(eiliskumas) as eiliskumas FROM '.cms_db_prefix().'zemelapiai WHERE kalba = ?';
	$dbresult = $db->Execute($query, array($_GET['kalba']))->FetchRow();
	$maxis = $dbresult['eiliskumas'];
	if ($ikur > $dbresult['eiliskumas']) {$ikur = $dbresult['eiliskumas'];}
	if ($ikur < 1) {$ikur="1";}

	if ($ikur>$kelintas) {
	   $query = 'SELECT * FROM '.cms_db_prefix().'zemelapiai WHERE kalba=? ORDER BY eiliskumas ASC';
	   $dbresult = $db->Execute($query, array($_GET['kalba']));
	while (($row = $dbresult->FetchRow()))
	{
		if ($row['eiliskumas'] <= $ikur) {
		  if ($row['eiliskumas'] == $kelintas) { 


	   $query2 = 'SELECT * FROM '.cms_db_prefix().'zemelapiai WHERE kalba=? and eiliskumas=? ';
	   $dbresult2 = $db->Execute($query2, array($_GET['kalba'], $row['eiliskumas']));
	  $sks = $dbresult2->NumRows();
		   if ($sks>1) {$ikur1=$maxis+1;}else{$ikur1=$ikur;}


		   $query = 'UPDATE '.cms_db_prefix().'zemelapiai SET eiliskumas=? WHERE (id=? AND kalba=?)';
		   $db->Execute($query, array($ikur1,$row['id'],$_GET['kalba']));
		  }elseif($row['eiliskumas'] > $kelintas){
		   $query = 'UPDATE '.cms_db_prefix().'zemelapiai SET eiliskumas=eiliskumas-1 WHERE (id=? AND kalba=?)';
		   $db->Execute($query, array($row['id'],$_GET['kalba']));
		  }else{}
		}
	}
	}

	if ($ikur<=$kelintas) {
	   $query = 'SELECT * FROM '.cms_db_prefix().'zemelapiai WHERE kalba=? ORDER BY eiliskumas DESC';
	   $dbresult = $db->Execute($query, array($_GET['kalba']));
	while (($row = $dbresult->FetchRow()))
	{
		if ($row['eiliskumas'] >= $ikur) {
		  if ($row['eiliskumas'] == $kelintas) { 


	   $query2 = 'SELECT * FROM '.cms_db_prefix().'zemelapiai WHERE kalba=? and eiliskumas=? ';
	   $dbresult2 = $db->Execute($query2, array($_GET['kalba'], $row['eiliskumas']));
	  $sks = $dbresult2->NumRows();
		   if ($sks>1) {$ikur1=$maxis+1;}else{$ikur1=$ikur;} 
//echo $ikur1." + ".$ikur." $sks $maxis <BR>";

		   $query = 'UPDATE '.cms_db_prefix().'zemelapiai SET eiliskumas=? WHERE (id=? AND kalba=?)';
		   $db->Execute($query, array($ikur1,$row['id'],$_GET['kalba']));
		  }elseif($row['eiliskumas'] < $kelintas){
		   $query = 'UPDATE '.cms_db_prefix().'zemelapiai SET eiliskumas=eiliskumas+1 WHERE (id=? AND kalba=?)';
		   $db->Execute($query, array($row['id'],$_GET['kalba']));
		  }else{}
		}
	}
	


	}









		//$query = 'DELETE  FROM '.cms_db_prefix().'zemelapiai WHERE id=?';

// $query = 'UPDATE '.cms_db_prefix().'zemelapiai SET  WHERE id=?';


		 //$dbresult = $db->Execute($query, array($phid));
}

$this->Redirect($id, 'defaultadmin', $returnid);
?>