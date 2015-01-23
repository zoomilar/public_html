<?php

if (!isset($gCms)) exit;


if (! $this->CheckPermission('Use Languages')) {
  return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}


if (FALSE == empty($params['active_tab'])) {
    $tab = $params['active_tab'];
} else {
	$tab = '';
}

/*mano*/

echo $this->StartTabHeaders();

echo $this->SetTabHeader('general',$this->Lang('title_general'),('general' == $tab)?true:false);

if ($this->CheckPermission('Set Languages Prefs')) {
	echo $this->SetTabHeader('prefs',$this->Lang('title_mod_prefs'), ('prefs' == $tab)?true:false);
}

echo $this->EndTabHeaders();

echo $this->StartTabContent();

echo $this->StartTab('general', $params);
include(dirname(__FILE__).'/function.admin_langfiles.php');
echo $this->EndTab();

if ($this->CheckPermission('Set Languages Prefs')) {
	echo $this->StartTab('prefs',$params);
	include(dirname(__FILE__).'/function.admin_prefstab.php');
	echo $this->EndTab();
}

echo $this->EndTabContent();





/*
$tab_header = $this->StartTabHeaders() .
$tab_header .= $this->SetTabHeader('general',$this->Lang('title_general'),('general' == $tab)?true:false);
if ($this->CheckPermission('Set Languages Prefs')) {
	$tab_header .= $this->SetTabHeader('prefs',$this->Lang('title_mod_prefs'), ('prefs' == $tab)?true:false);
}


$this->smarty->assign('start_general_tab',$this->StartTab('general', $params));


if ($this->CheckPermission('Set Languages Prefs')) {
	$this->smarty->assign('start_prefs_tab',$this->StartTab('prefs', $params));
} else {
	$this->smarty->assign('start_prefs_tab','');
}

$this->smarty->assign('tabs_start',$tab_header.$this->EndTabHeaders().$this->StartTabContent());
$this->smarty->assign('tab_end',$this->EndTab());
$this->smarty->assign('tabs_end',$this->EndTabContent());

// Content defines and Form stuff for the admin
$smarty->assign('start_form', $this->CreateFormStart($id, 'save_admin_prefs', $returnid));
$smarty->assign('input_allow_add',$this->CreateInputCheckbox($id, 'allow_add', 1,
   $this->GetPreference('allow_add','0')). $this->Lang('title_allow_add_help'));
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));

// translated strings
$smarty->assign('title_allow_add',$this->Lang('title_allow_add'));
$smarty->assign('welcome_text',$this->Lang('welcome_text'));

echo $this->ProcessTemplate('adminpanel.tpl');
*/


?>