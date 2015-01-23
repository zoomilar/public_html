<?php
if (!isset($gCms)) exit;
include('dom.php');

if (isset($params['cancel'])) 
	$this->Redirect($id, 'defaultadmin', $returnid);

if ((isset($params['submit'])) || (isset($params['change'])))
{
	
	$excl['mact'] = 1;
	$excl['sp_'] = 1;
	$excl['m1_hid'] = 1;
	$excl['m1_submit'] = 1;
	$excl['m1_change'] = 1;
	

	
	$failai = array_keys($_FILES);	
	$f=0;
	while ($failai[$f]){
		$excl["m1_".$failai[$f]] = 1;
		$excl["m1_d_".$failai[$f]] = 1;
		$file = $_FILES[$failai[$f]];
	
	    $fi = str_replace("m1_", "", $failai[$f]);
	
		if ($file['name']){
		  $ad = time()."-"; $fupload = $config['root_path'].'/uploads/images/titulinis/'.$ad.$file['name']; 
		  @move_uploaded_file($file['tmp_name'], $fupload);	  
		  
		  
		//include('image_res.php'); 
	
        
       // exit;
		  
		  $_POST[$failai[$f]] = $ad.$file['name'];		  		  
		  
	    }		    	 
	    
	    if ($_POST["m1_".$fi]){		    
		    $query = 'UPDATE '.cms_db_prefix().$lentele.'  SET '.$fi.'="'.$_POST[$failai[$f]].'" WHERE id='.$_POST['m1_hid'];
		    $db->Execute($query);

	    }	    
	        
	    $f++;
	}
	
	$vardai = array_keys($_POST);
	//$vardai[] = 'm1_spec';
	  	
	
	$v=0;
	while($vardai[$v]){
     if (!$excl[$vardai[$v]]){
		$kint[] = str_replace('m1_','',$vardai[$v])."='".str_replace("'","`",$_POST[$vardai[$v]])."'";
	 }
		 
	 	$v++;
	}
	

	
		   $kint_list = join(', ',$kint);
		   $query = 'UPDATE '.cms_db_prefix().$lentele.'  SET '.$kint_list.' WHERE id='.$_POST['m1_hid'];		
		   

//		   echo $query." ".$_POST["m1_spec"];
		   
		   $db->Execute($query);
			print_r(mysql_error());

	audit($_POST['m1_hid'], $propname, 'Edited '.$pavad);
	
	
//exit;

if (isset($params['change'])) {
   echo "Atnaujinta";
	$par[prop_id]=$_POST['m1_hid'];
	$this->Redirect($id, 'editprop', $returnid, $par);
}else{

	$this->Redirect($id, 'defaultadmin', $returnid);
}


}

if ($_GET['prop_id'] == "") {$_GET['prop_id'] = $_GET['m1_prop_id'];}

$phid = $_GET['prop_id'];
$query = 'SELECT * FROM '.cms_db_prefix().$lentele.' WHERE id=?';
$dbresult = $db->Execute($query, array($phid));
$curr = $dbresult->FetchRow();
check_login();
$userid = get_userid();

 
 
if (!$this->CheckPermission($pavad.' Edit') && ($curr[userid] != $userid)) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}


if (!$this->CheckPermission($pavad.' Special') && $curr[spec]){
	return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}



if ( isset($phid))
{


 		 $query = 'SELECT * FROM '.cms_db_prefix().$lentele.' WHERE id=?';
 		 $dbr = mysql_query('SELECT * FROM '.cms_db_prefix().$lentele);
 		 
		 $dbresult = $db->Execute($query, array($phid));
		 if ( $row = $dbresult->FetchRow())
	{
		
		
		$vardai = array_keys($row);
		$v=0;
		$prop = new StdClass();
		while ($vardai[$v]){
			$prop->$vardai[$v] = $row[$vardai[$v]];
			$propt[$vardai[$v]]= mysql_field_type($dbr, $v);
			$propl[$vardai[$v]]= mysql_field_len($dbr, $v);
			$v++;
			
		}
		$props[] = $prop;
		
		
	}

}
$this->smarty->assign('hid', $this->CreateInputHidden($id, 'hid', $phid));


include("laukeliai.php");

$this->smarty->assign('change', $this->CreateInputSubmit($id, 'change', $this->lang('change')));

echo $this->CreateFormStart($id, 'editprop', $returnid, 'post', 'multipart/form-data');
echo $this->ProcessTemplate('add_edit.tpl');
echo $this->CreateFormEnd();
?>