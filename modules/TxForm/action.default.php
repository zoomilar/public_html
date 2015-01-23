<?php

$db = &$gCms->GetDb();
include('dom.php');
global $langfile;
$content_obj = $gCms->variables['content_obj'];
$formos_id = $params['form'];

if (!(intval($formos_id) > 0)) {
	$formos_alias = $formos_id;
	unset($formos_id);
}

if ($formos_id) {
	$row = $this->adb->getRow("SELECT * FROM ".cms_db_prefix().$lentele." WHERE id=?", array($formos_id));
}
elseif($formos_alias) {
	$row = $this->adb->getRow("SELECT * FROM ".cms_db_prefix().$lentele." WHERE formalias=?", array($formos_alias));
}
$tbl = $row['formalias'];

$prefix_len = strlen($id.$this->prefix); 

foreach ($_POST as $k=>$v){
	if(substr($k, 0, $prefix_len)== $id.$this->prefix) {
		 $key = substr($k,$prefix_len);
		 $params[$key] = $v;
	}
}
$in = array('\'','"');
$out = array('&#34;','&#39;');

$params = str_replace($in,$out,$params);
$fields = $this->prepare_input($params);

$kalba = $this->smarty->get_template_vars('kalba');
$path = $gCms->config['root_path'].'/tmp/languages/'.$kalba.'.conf';

$vkalbos = $this->adb->getArray("SELECT * FROM ".cms_db_prefix()."tx_n_titulinis WHERE kategorija='kalbos' and nerodyti=0 and del=0 and kalba='lt'");
$is_i = array();
foreach ($vkalbos as $tmp){
	$klb = unserialize($tmp['antraste']);
	$is_i[$klb[$kalba]] = $klb[$kalba];	
}

ksort($is_i);

$this->smarty->assign("is_i", $is_i);



if(is_file ($path)){
	$this->smarty->config_load($path);
	$langfile = $smarty->get_config_vars();
}

//$padetys = array("Vedęs (ištekėjusi)","Vienišas(-a)","Našlys(-ė)");
$padetys = array($langfile['f5_wed'],$langfile['f5_single'],$langfile['f5_widower']);

$this->smarty->assign("padetys", $padetys);

$this->smarty->assign("fields", $fields);
$this->smarty->assign("formstart", $this->CreateFormStart($id, 'default',$returnid,'post','multipart/form-data',false, '',array('pid'=>$params['pid'],'form'=>$params['form'],'form_id'=>$params['form'])));

$validator = new validation;
$form_errors=array();
if(isset($fields['form_id'])){



 
if($fields['form_id']=='1') { 
	if ($validator->required($fields['vardas'])===false) $form_errors['vardas']=$langfile['ne_vardas'];
	if ($validator->required($fields['el_pastas'])===false) $form_errors['el_pastas']=$langfile['no_el_pastas'];
		//elseif ($validator->valid_email($fields['el_pastas'])===false)  $form_errors['el_pastas']=$langfile['bad_el_pastas'];
	//if ($validator->required($fields['zinute'])===false) $form_errors['zinute']=$langfile['ne_zinute'];
}

if($fields['form_id']=='4') {
	if ($validator->required($fields['vardas'])===false) $form_errors['vardas']=$langfile['ne_vardas'];
	if ($validator->required($fields['el_pastas'])===false) $form_errors['el_pastas']=$langfile['no_el_pastas'];
		elseif ($validator->valid_email($fields['el_pastas'])===false)  $form_errors['el_pastas']=$langfile['bad_el_pastas'];
	if ($validator->required($fields['telefonas'])===false) $form_errors['telefonas']=$langfile['ne_telefonas'];
}
 

 if (sizeof($form_errors) || !sizeof($fields)){
	$this->smarty->assign("form_errors", $form_errors);
 }
 else{
 
	if ($row['sendbyemail']){
				$row['sendbyemail'] = str_replace(";", ",", $row['sendbyemail']);
				$emails = explode(",", $row['sendbyemail']);

				if($fields['form_id']=='4') {
					$msg .= "<H1>{$langfile['uzklausa_is_prod']}</H1>";
				} else {
					$msg .= "<H1>{$langfile['uzklausa_is']}</H1>";
				}
				/*
				echo "<pre>";
				print_r($fields);
				echo "</pre>";*/
				if($fields['form_id']=='5') {
			
			
					foreach ($fields as $k=>$field){
								$in = array('\r\n','<','>');
								$out = array(" ",'&#60;','&#62;');
								$field = str_replace($in,$out,$field);
								
									
									if($k=="f5_lietuviu" || $k=="f5_anglu" || $k=="f5_rusu" || $k=="f5_vokieciu" || $k=="f5_kita") {
										if (in_array($langfile[$k], $fields['kalbos'])) {
											$msg .= "<b>$langfile[$k]</b>" . " - {$field}<br/>";
										}elseif ($k=="f5_kita"){
											$msg .= "<b>Kita kalba:</b>" . " - {$field}<br/>";
										}
									}else if($k=="f5_koks_domina" || $k=="kalbos" || $k=="pazymejimas") {
										$msg .= "<b>$langfile[$k] </b>";
										foreach ($field as $key=>$item) {
											if(is_array($item)) {$item = implode(",", $item);}
											if($key==0) {
												
												$msg .= "{$item}";
												
											}else{
												
												$msg .= ", {$item}";
											}
										}
										$msg .= "<br/>";
									}else if($k!='returnid' && $k!='pid' && $k!='form' && $k!='action' && $k!='form_id' && $k != 'is_product' && $k!='module' && $k!='f5_detal'){
										if(is_array($field)) {
											foreach($field as $item) {
												if($langfile[$k]!=$item) {
													$msg .= "<b>$langfile[$k]</b>" . " - ";
													$msg .= "{$item} ";
													$msg .= "<br/>";
												}
											}
										}else{
											if($langfile[$k]!=$field) {$msg .= "<b>$langfile[$k]</b>" . " - {$field}<br/>";}
										}
									}
								
					}
				}else{
					foreach ($fields as $k=>$field){
								$in = array('\r\n','<','>');
								$out = array(" ",'&#60;','&#62;');
								$field = str_replace($in,$out,$field);
								if($k!='returnid' && $k!='pid' && $k!='form' && $k!='action' && $k!='form_id' && $k != 'is_product' && $k!='module'){
									$msg .= "<b>$langfile[$k]</b>" . " - {$field}<br/>";
								}
					}
				}
				

				

				
				$cmsmailer = $this->GetModuleInstance('CMSMailer');
				//print_r($emails); die;
				foreach ($emails as $email){
					$cmsmailer->AddAddress($email);
				}
				
				$flarrays = 'f5_nuotrauka,f5_priseg_cv,f5_kita_info,f5_prid_dip,f5_prid_baig_darb';
				$flarray = explode(',',$flarrays);
				foreach ($flarray as $file){
				
					$cmsmailer->AddAttachment($_FILES[$id.$this->prefix.$file]["tmp_name"],$_FILES[$id.$this->prefix.$file]['name']);
					$ext_a = explode('.', $_FILES[$id.$this->prefix.$file]['name']);
					$ext = array_pop($ext_a);
					unset($ext_a);
					$new_fname = md5(time()).'.'.$ext;
					
					copy($_FILES[$id.$this->prefix.$file]["tmp_name"], $_SERVER['DOCUMENT_ROOT'].'/uploads/TxForm/'.$new_fname);
					$fields[$file] = '/uploads/TxForm/'.$new_fname;
					//$msg .= '<b>'.$langfile['file'].'</b>' . " - ".$_FILES[$id.$this->prefix.$file]['name']."<br/>";
				}
				
			
				$cmsmailer->SetBody($msg);
				$cmsmailer->IsHTML(true);
				if($fields['form_id']=='4') {
					$cmsmailer->SetSubject("{$langfile['uzklausa_is_prod']}");
				} else {
					$cmsmailer->SetSubject("{$langfile['uzklausa_is']}");
				}
				$cmsmailer->Send();
				
				if($fields['form_id']=='1') { 
					unlink($pdf_file_root);
				}
	}
	
	if ($row['storedb']){ 
				$this->params['table'] = cms_db_prefix().$tbl;
				$this->tempfields = $fields;
				$this->tempfields['irasyta'] = date("Y-m-d H:i:s");
				$this->save();
	}
	
		
		if ($fields['form_id']=='1' OR $fields['form_id']=='4') {
			$this->smarty->assign("sekmingai", true);
		} else {
			$this->smarty->assign("sekmingai", true);
		}
	
	
 } 
}



$this->smarty->assign("prefix", $id.$this->prefix);
if(!isset($template))
	$template =  $this->ProcessTemplate($row['formtpl'].".tpl");
echo $template;
 
?>