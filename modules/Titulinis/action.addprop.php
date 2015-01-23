<?php
if (!isset($gCms)) exit;
include('dom.php');
$kalbospre = explode(',', $kalbos);
$kalbos = Array();
foreach ($kalbospre as $kalba){
 $kalbos[$kalba] = $kalba;
}

if (isset($params['cancel'])) 
	$this->Redirect($id, 'defaultadmin', $returnid);

if (isset($params['submit']) && $this->CheckPermission($pavad.' Add')) 
{
	
	$excl['mact'] = 1;
	$excl['sp_'] = 1;
	$excl['m1_hid'] = 1;
	$excl['m1_submit'] = 1;
	//$excl['m1_kat'] = 1;
	$excl['_sx_'] = 1;
	
	
	$failai = array_keys($_FILES);	
	$f=0;
	while ($failai[$f]){
		$excl["m1_".$failai[$f]] = 1;
		$file = $_FILES[$failai[$f]];
		
		if ($file['name']){
		  $fnam = str_replace('-', '_', $file['name']);
		  $fnam = str_replace(' ', '_', $fnam);
		  $fnam = str_replace('%20', '_', $fnam);
		  
		  $ad = time()."_".$f."_";
		  $fupload = $config['root_path'].'/uploads/images/titulinis/'.$ad.$fnam; 
		  @move_uploaded_file($file['tmp_name'], $fupload);	  
		  
		  /*
			require_once(dirname(__FILE__).'/../../lib/filemanager/ImageManager/Classes/gdext.php');
		
			if ($params['kat'] == 'foto'){
				$width=1500;
				$height=425;
			}elseif($params['kat'] == 'klientai' || $params['kat'] == 'atsiliepimai'){
				$width=170;
				$height=66;
			}elseif($params['kat'] == 'kalbos'){
				$width=28;
				$height=20;				
			}else{
				$width=952;
				$height=419;
			};
			
		
			$file_name_thumb = $config['root_path'].'/uploads/images/titulinis/thumb2_'.$ad.$fnam; 
			$img = new gdext;
			$img->load($fupload);
			if ($params['kat'] == 'klientai' || $params['kat'] == 'atsiliepimai')
				$img->resizeANDcenter($width, $height, 1, "255,255,255");
			else	
				$img->resizeANDcrop($width, $height);
			$img->save($file_name_thumb);
			$img->free();
			
			
			$file_name_thumb2 = $config['root_path'].'/uploads/images/titulinis/thumb_'.$ad.$fnam; 
			$img = new gdext;
			$img->load($fupload);
			$img->resizeANDcrop(146, 73);
			$img->save($file_name_thumb2);
			$img->free();
		
		
			*/
		
		
		  $_POST[$failai[$f]] = $ad.$fnam;
	    }	    	 
	    $f++;
	}	
	
	$query5 = 'SELECT MAX(eiliskumas) as eiliskumas FROM '.cms_db_prefix().$lentele.' WHERE del != ? and kalba =? and kategorija=?';
	$dbresult5 = $db->Execute($query5, array('1',$_POST['kalba'], $_POST['m1_kat']));
	$row5 = $dbresult5->FetchRow();	

	$vardai = array_keys($_POST);
	$v=0;
	
	while($vardai[$v]){
     if (!$excl[$vardai[$v]]){
	     
		if ($vardai[$v] == "m1_eiliskumas" && !$_POST[$vardai[$v]])
			$_POST[$vardai[$v]] = $row5[eiliskumas]+1;
		
		if ($vardai[$v] == 'm1_kat'){
			$kint[] = "'".str_replace("'","`",$_POST['m1_kat'])."'";
			$vard[] = 'kategorija';
		}else{
			if (is_array($_POST[$vardai[$v]]))
			$_POST[$vardai[$v]] = serialize($_POST[$vardai[$v]]);
			
			/*echo*/$kint[] = "'".$_POST[$vardai[$v]]."'";
			$vard[] = str_replace('m1_','',$vardai[$v]);
		}
		
	 }
	 	$v++;
	}

	
	
	$kint_list = join(',',$kint);	
	$vard_list = join(',',$vard);	
	
	
		$query = 'INSERT INTO '.cms_db_prefix().$lentele.' ('.$vard_list.') VALUES ('.$kint_list.')';
		//echo $query; die;
		 if(!$db->Execute($query)){
			 echo $query;
			 echo mysql_error();
	 	 }	 


	check_login();
	$userid = get_userid();
	$query2 = 'SELECT * FROM '.cms_db_prefix().'users WHERE user_id=?';
	$dbresult2 = $db->Execute($query2, array($userid));
	$row2 = $dbresult2->FetchRow();

	$query4 = 'SELECT MAX(id) as id FROM '.cms_db_prefix().$lentele;
	$dbresult4 = $db->Execute($query4);
	$row4 = $dbresult4->FetchRow();
	



	$query4a = 'UPDATE '.cms_db_prefix().$lentele.' SET userid='.$userid.' WHERE id='.$row4[id];
	$db->Execute($query4a);
	
	

	$query3 = 'INSERT INTO '.cms_db_prefix().'adminlog (timestamp, user_id, username, item_id, item_name, action) VALUES (?,?,?,?,?,?)';
	$db->Execute($query3, array(time(), $userid, $row2['username'], $row4['id'], $propname, 'Inserted '.$pavad));

	$par[kat]=$_POST['m1_kat'];
	$this->Redirect($id, 'defaultadmin', $returnid, $par);
}

if (! $this->CheckPermission($pavad.' Add')) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}


		$query = 'SELECT * FROM '.cms_db_prefix().$lentele.' LIMIT 1';
		$dbr = $db->Execute('SELECT * FROM '.cms_db_prefix().$lentele);
		
		$dbresult = $db->Execute($query);
		if ( $row = $dbresult->FetchRow()) {
			
			
			$vardai = array_keys($row);
			$v=0;
			$prop = new StdClass();
			//echo '<pre>';
			while ($vardai[$v]){
				$f_info = $dbr->FetchField($v);
				//echo $db->MetaType($f_info);
				$prop->$vardai[$v] = "";
				$propt[$vardai[$v]]= $f_info->type;
				//print_r($f_info);
				$propl[$vardai[$v]]= $f_info->length;
				$v++;
				
			}
			$props[] = $prop;
			//echo '</pre>';
			
		}


include("laukeliai.php");
$stiliai[0] = 'Top';
$stiliai[1] = 'Bottom';
$this->smarty->assign('stiliai', $stiliai);
$this->smarty->assign('kalbos', $kalbos);
$smarty->assign($this->GetName(),$this);  
$smarty->assign('titulinio_tabai', $titulinio_tabai);

echo $this->CreateFormStart($id, 'addprop', $returnid, 'post', 'multipart/form-data');
echo $this->ProcessTemplate('add_edit.tpl');
echo $this->CreateFormEnd();
?>