<?php
if (!isset($gCms)) exit;
include('dom.php');

if (isset($params['cancel'])) 
	$this->Redirect($id, 'defaultadmin', $returnid);

if (isset($params['submit']) && $this->CheckPermission($pavad.' Add')) 
{

	$params['entity_id'] = $params['id'];
	$excl = explode(",", "submit,id,action");
	
	foreach ($excl as $ex){
		unset($params[$ex]);
	}
	
	check_login();
	
	$this->tempfields = $params;
	$this->tempfields['userid'] = get_userid();
	$this->params['table'] = cms_db_prefix().$lentele;
	$this->save();

	$tbl = $this->adb->getOne("SHOW tables LIKE ".cms_db_prefix()."{$this->tempfields['formalias']}");
	if (!$tbl){
			$flds = "
				ID INT NOT NULL AUTO_INCREMENT
			";		
			$taboptarray = array( 'mysql' => 'TYPE=MyISAM' );
			$dict = NewDataDictionary( $this->adb );	
			$sqlarray = $dict->CreateTableSQL( cms_db_prefix().$this->tempfields['formalias'],
							   $flds, 
							   $taboptarray);
			$dict->ExecuteSQLArray($sqlarray);


			$query1 = "ALTER TABLE  ".cms_db_prefix().$this->tempfields['formalias']." ADD UNIQUE (id)";
			$query2 = "ALTER TABLE  ".cms_db_prefix().$this->tempfields['formalias']." CHANGE  `id`  `id` INT  NOT NULL AUTO_INCREMENT";
			$this->adb->Execute($query1);
			$this->adb->Execute($query2);			
			
			
		/*	$query1 = "ALTER TABLE  ".cms_db_prefix().$lentele." ADD UNIQUE (id)";
			$query2 = "ALTER TABLE  ".cms_db_prefix().$lentele." CHANGE  `id`  `id` INT  NOT NULL AUTO_INCREMENT";
			$db->Execute($query1);
			$db->Execute($query2);(*/		
		
	}
	
	
	/*
	exit;
	
	
	
	
	$failai = array_keys($_FILES);	
	$f=0;
	while ($failai[$f]){
		$excl["m1_".$failai[$f]] = 1;
		$file = $_FILES[$failai[$f]];
		
		if ($file['name']){
		  $ad = time()."-"; $fupload = $config['root_path'].'/uploads/images/titulinis/'.$ad.$file['name']; @move_uploaded_file($file['tmp_name'], $fupload);	  
		  //include('image_res.php'); 

		  $_POST[$failai[$f]] = $ad.$file['name'];
	    }	    	 
	    $f++;
	}	
	
	
	
	$vardai = array_keys($_POST);
	$v=0;
	while($vardai[$v]){
     if (!$excl[$vardai[$v]]){
		$kint[] = "'".str_replace("'","`",$_POST[$vardai[$v]])."'";
		$vard[] = str_replace('m1_','',$vardai[$v]);
	 }
	 	$v++;
	}
	
	$kint_list = join(',',$kint);	
	$vard_list = join(',',$vard);	
	
	
		$query = 'INSERT INTO '.cms_db_prefix().$lentele.' ('.$vard_list.') VALUES ('.$kint_list.')';
		
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

	
	*/
	
	$this->Redirect($id, 'defaultadmin', $returnid);
}



if (! $this->CheckPermission($pavad.' Add')) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}

		 $pid = ($_GET['prop_id']) ? $_GET['prop_id'] : $_GET['m1_prop_id'];
		 if ($pid){
			$this->params['id'] = $pid;
			$this->params['table'] = cms_db_prefix().$lentele;
			$this->load();
			$res = $this->fields;
		}	
			//$res = $db->getRow("SELECT * FROM ".cms_db_prefix().$lentele);
		 		 

		 $dbresult = $db->Execute("SHOW columns from ".cms_db_prefix().$lentele);
		 $excl = explode(",", "id,userid");		 

		 while ( $row = $dbresult->FetchRow())
		 {
				$prop = new StdClass();
				$tmp = str_replace(")", "", $row['Type']);
				$tmp = explode("(", $tmp);
				
				$name = $row['Field'];
				$type= $tmp[0];
				$len = $tmp[1];
				$title = $this->Lang($name);
				$value = $res[$name];
				
				if(preg_match('/^module\:/', $title))
					$prop->title = $title; 
				else
					$prop->title = "_".$name; 

				$prop->name = $name;	
				
				if (in_array($name, $excl)){
					$prop->field = $this->CreateInputHidden($id, $name, $value);
					$prop->type = "hidden";
				}else{
					switch ($type){
						case "text":
							$prop->field = $this->CreateTextArea(true, $id, $name, $value, $name, '', '', '',30, 10, '');   
						break;
						case 'int':
						   if($len == 1){
							   $prop->field = $this->CreateInputCheckbox($id, $name, '1', $value);
						   }else{
							   $prop->field = $this->CreateInputText($id, $name, $value, 120, 255);
						   }
						break;
						default: 
						  if($len == 732){
							$prop->type = "upload";
						   $prop->field = $this->CreateFileUploadInput($id, $name);
						   $prop->checkbox = $this->CreateInputCheckbox($id, "d_".$name, '1');					   
						  }else{	    
						   $prop->field = $this->CreateInputText($id, $name, $value, 120, 255);
						  }					
						break;
					}
				}
								
				$props[] = $prop;
		 }

echo $this->CreateFormStart($id, 'addedit', $returnid, 'post', 'multipart/form-data');
$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$this->smarty->assign('conf', $this->CreateInputSubmit($id, 'confirm', lang('confirm')));
$this->smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));
$this->smarty->assign("props", $props);
$this->smarty->assign("mod", $this);
echo $this->ProcessTemplate('add_edit.tpl');
echo $this->CreateFormEnd();
?>