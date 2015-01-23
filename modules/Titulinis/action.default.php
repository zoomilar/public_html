<?php

if (!isset($gCms)) exit;
include('dom.php');
$db = &$gCms->GetDb();
$kalbos = explode(",", $kalbos); 

//pasiimam 
if ($params['kategorija'] == "nuotraukos"){$addi = " and nuotrauka !='' ";}else{$addi="";}
//if ($params['kalba'])
	//$adk = " and kalba='".$params[kalba]."'";
	
if ($params['titulinis']){$addi = " and tituliniame =1 ";}
	

$adkl = ""; $limkl = ""; $custord;
if ($params['tipas'] == "dideli")	{
	$adkl = " and tipas='{$params['tipas']}'";
	$limkl = " LIMIT 0,9";
}elseif ($params['tipas'] == "valst")	{
	$adkl = " and tipas='{$params['tipas']}'";
	$limkl = " LIMIT 0,6";
}elseif ($params['kategorija']=='klientai'){
 if ($params['frompage']){
	$custord = " FIELD(tipas, 'visi', 'dideli', 'valst', '') ASC, ";
 }else{
	$custord = " FIELD(tipas, 'dideli', 'valst', 'visi', '') ASC, ";
	$limkl = " LIMIT 0,50";
 } 
}
	
	
$query = 'SELECT * FROM '.cms_db_prefix().$lentele.' WHERE nerodyti=0 '.$addi.' and kategorija="'.$params[kategorija].'"'.$adkl.'  and del=0 '.$adk.' ORDER BY '.$custord.' eiliskumas ASC '.$limkl;

$result = $db->Execute($query);   
print mysql_error();
$records = array();

while ($result != false && $row=$result->FetchRow()){
   //print_r($row);
   if (sizeof($kalbos)>1){
     foreach ($row as $k=>$v){
		$data = @unserialize($v);
		if ($data !== false) {
			$val = $data[$params['kalba']];
			if (!$val)
				$val = $data['lt'];
			$row[$k] = $val;
		}
     }
   }
   array_push($records,$row);
}

$this->smarty->assign_by_ref('irasai',$records);
$this->smarty->assign_by_ref('root_url',$config['root_url']);
$this->smarty->assign_by_ref('image_uploads_url',$config['image_uploads_url']);
foreach($titulinio_tabai as $tab_name){
	switch ($params['kategorija']){
		case $tab_name['title']:
			echo $this->ProcessTemplate('w_'.$tab_name['title'].'.tpl');
		break;
	}
};

/*
switch ($params['kategorija']){
	case "foto":
		
	  if ($params['tipas'] == "txt"){
		echo $this->ProcessTemplate('w_foto_txt.tpl');
	  }else{
		echo $this->ProcessTemplate('w_foto.tpl');
	  }	
	break;	
	case "blokai":
	  if ($params['tipas'] == "vidus")
		echo $this->ProcessTemplate('w_blokai_ins.tpl');
	  else
		echo $this->ProcessTemplate('w_blokai.tpl');
	break;	
	case "klientai":
	  if ($params['frompage'])
		echo $this->ProcessTemplate('w2_klientai.tpl');
	  else	
		echo $this->ProcessTemplate('w_klientai.tpl');
	break;	
	case "atsiliepimai":	
		echo $this->ProcessTemplate('w_atsiliepimai.tpl');
	break;	
	case "kalbos":
		echo $this->ProcessTemplate('w_kalbos.tpl');
	break;
}	
*/
?>