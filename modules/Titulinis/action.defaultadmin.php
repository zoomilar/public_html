<?php

if (!isset($gCms)) exit;


include('dom.php');
$kalbospre = explode(',', $kalbos);
$kalbos = Array();
foreach ($kalbospre as $kalba){
 $kalbos[$kalba] = $kalba;
}


function GetProps ($special, $kategorija='', $kalba='')
{
	include('dom.php');
	$kalbos = explode(",", $kalbos);
	global $gCms;
	
	($kategorija)?$kati="and kategorija='".$kategorija."'":$kati="";
	$kalbi = "and kalba='".$kalba."'";
	
	
	$db = $gCms->GetDb();
	$config = $gCms->config;
	
	$query = "SELECT * FROM ".cms_db_prefix().$lentele." WHERE del = '0' $kati $kalbi ORDER BY $sortinti ASC";
	$dbresult = $db->Execute($query);
		
	
	if (false == $dbresult)
	{
		echo $this->ShowErrors( $this->Lang('query_failed') );
	}
	$props = array();
	while ( $dbresult && ($row = $dbresult->FetchRow()) )
	{
		$vardai = array_keys($row);
		$v=0;
		$prop = new StdClass();
		while ($vardai[$v]){
		  if (sizeof($kalbos)>1){
			$str = $row[$vardai[$v]];
			$data = @unserialize($str);
			if ($data !== false) {
				$str = $data[$kalba];
			} 	  

			$prop->$vardai[$v] = $str;
		  }else	
			$prop->$vardai[$v] = $row[$vardai[$v]];
			
		  $v++;
			
		}
		$props[] = $prop;
	}
	return $props;
	
}




/** 
 * For separated methods, you won't be able to do permission checks in
 * the DoAction method, so you'll need to do them as needed in your
 * method:
*/ 
if (! $this->CheckPermission($pavad.' Use')) {
  echo "Nera teisiu";
  return;
}
$themeObject = &$gCms->variables['admintheme'];
/**
 * After this, the code is identical to the code that would otherwise be
 * wrapped in the DisplayAdminPanel() method in the module body.
 */
 
// Tab Infrastructure for Admin Area -- create two tabs, one of which
// is only accessible if permissions are right
if (FALSE == empty($params['active_tab']))
  {
    $tab = $params['active_tab'];
  } else {
  $tab = '';
 }



// Content defines and Form stuff for the admin

//$this->smarty->assign('welcome_text','<b>tst</b>');


	$expandImg = $themeObject->DisplayImage('icons/system/expand.gif', lang('expand'),'','','systemicon');
	$contractImg = $themeObject->DisplayImage('icons/system/contract.gif', lang('contract'),'','','systemicon');
	$image_set_false = $themeObject->DisplayImage('icons/system/true.gif', lang('setfalse'),'','','systemicon');
	$image_set_true = $themeObject->DisplayImage('icons/system/false.gif', lang('settrue'),'','','systemicon');
	$downImg = $themeObject->DisplayImage('icons/system/arrow-d.gif', lang('down'),'','','systemicon');
	$upImg = $themeObject->DisplayImage('icons/system/arrow-u.gif', lang('up'),'','','systemicon');

$this->smarty->assign('isskleisti', $expandImg);
$this->smarty->assign('suskleisti', $contractImg);
$this->smarty->assign('setfalse', $image_set_false);
$this->smarty->assign('settrue', $image_set_true);

$special = $this->CheckPermission($pavad.' Special');



if ($this->CheckPermission($pavad.' Delete')) {
	$smarty->assign('allow_del', 'yes');
}



check_login();
$smarty->assign('cuser', get_userid());

$smarty->assign('mod_w', $pavad);	
$smarty->assign('allow_edit', $this->CheckPermission($pavad.' Edit'));
$smarty->assign('allow_more', $this->CheckPermission($pavad.' More'));


$smarty->assign('start_form', $this->CreateFormStart($id, 'save_admin_prefs', $returnid));
$smarty->assign('title_allow_add',$this->Lang('title_allow_add'));
$smarty->assign('input_allow_add',$this->CreateInputCheckbox($id, 'allow_add', 1,
$this->GetPreference('allow_add','0')). $this->Lang('title_allow_add_help'));
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$smarty->assign('end_form', $this->CreateFormEnd());


echo $this->StartTabHeaders();

if (FALSE == empty($_GET['m1_kat']))
  {
	$tab = $_GET['m1_kat'];
  } else {
  $tab = '';
 }
$this->smarty->assign('root_url', $config[root_url]);

$smarty->assign($this->GetName(),$this);  



$this->smarty->assign('kalbos', array('lt'=>'LT'));

foreach($titulinio_tabai as $tab_name){
	echo $this->SetTabHeader($tab_name['title'],$tab_name['title_text'], ($tab_name['title'] == $tab)?true:false);
}

echo $this->EndTabHeaders();

echo $this->StartTabContent();
$tmp = array();
foreach($approve_style as $k=>$v){
	$tmp[$v] = $v;
}
$this->smarty->assign("approve_style", $tmp);


foreach($titulinio_tabai as $tab_name){
	echo $this->StartTab($tab_name['title'], $params);
	if ($this->CheckPermission($pavad.' Add')) {
		$par['kat']=$tab_name['title']; 
		$this->smarty->assign('addlink', $this->CreateLink($id, 'addprop', $returnid, $themeObject->DisplayImage('icons/system/newobject.gif', $this->Lang('addprop'), $par, '', 'systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addprop', $returnid, $this->Lang('addprop'), $par, '', false, false, 'class="pageoptions"'));}
	foreach ($kalbos as $key=>$kalba){
		$prop_list[$key] = GetProps($special, $tab_name['title'], $key); 
	}	 
	$this->smarty->assign("prop_array", $prop_list);
	$this->smarty->assign('kateg', $tab_name['title']);  
	$this->smarty->assign('titulinio_tabai', $titulinio_tabai);  
	
	echo $this->ProcessTemplate('admin_side.tpl');
	echo $this->EndTab();
	
	$filename = $_SERVER['DOCUMENT_ROOT'].'/modules/Titulinis/templates/w_'.$tab_name['title'].'.tpl';
	if (!file_exists($filename)) {
		$create = fopen($filename, 'w');
		if(!chmod($filename, 0777)) {
			echo "<div class='error' style='padding: 10px 45px;'>".$tab_name['title'].".tpl ".$this->Lang('tpl_chmod_fail')."</div>";
		}
		if($create) {
			echo "<div class='success'  style='padding: 10px 45px;'>".$tab_name['title'].".tpl ".$this->Lang('tpl_create_success')."</div>";
		}else{
			echo "<div class='error' style='padding: 10px 45px;'>".$tab_name['title'].".tpl ".$this->Lang('tpl_create_fail')."</div>";
		}
	}
	
}

echo $this->EndTabContent();

?>