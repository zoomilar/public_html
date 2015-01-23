<?php

if (!isset($gCms)) exit;



include('dom.php');

function GetProps ($special)
{
	include('dom.php');
	global $gCms;
	
	if (! $special){$addt = "spec = '0'";}else{unset($addt);}	
	
	$db = $gCms->GetDb();
	$config = $gCms->config;
	
	if ($addt) 
		 $addt = "WHERE {$addt}";
	
	$query = "SELECT * FROM ".cms_db_prefix().$lentele." $addt ORDER BY $sortinti ASC";
	$dbresult = $db->Execute($query);
	if (false == $dbresult)
	{
		echo mysql_error();
	}
	$props = array();
	while ( $dbresult && ($row = $dbresult->FetchRow()) )
	{
		$vardai = array_keys($row);
		$v=0;
		$prop = new StdClass();
		while ($vardai[$v]){
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
$prop_list_lt = GetProps($special); 

$this->smarty->assign('prop_array_lt', $prop_list_lt);


if ($this->CheckPermission($pavad.' Add')) {
 $this->smarty->assign('addlink', $this->CreateLink($id, 'addedit', $returnid, $themeObject->DisplayImage('icons/system/newobject.gif', $this->Lang('addprop'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addedit', $returnid, $this->Lang('addprop'), array(), '', false, false, 'class="pageoptions"'));
 $this->smarty->assign('addlink_tipai', $this->CreateLink($id, 'addtipai', $returnid, $themeObject->DisplayImage('icons/system/newobject.gif', $this->Lang('addtipai'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addtipai', $returnid, $this->Lang('addtipai'), array(), '', false, false, 'class="pageoptions"'));
}

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

echo $this->ProcessTemplate('adminpanel.tpl');
echo $this->ProcessTemplate('propslist.tpl');


?>