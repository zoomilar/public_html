<?php


$smarty->assign('start_form', $this->CreateFormStart($id, 'save_admin_prefs', $returnid));
$smarty->assign('end_form', $this->CreateFormEnd());
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));


$smarty->assign('input_allow_add',$this->CreateInputCheckbox($id, 'allow_add', 1, $this->GetPreference('allow_add','0')). $this->Lang('title_allow_add_help'));
$smarty->assign('title_allow_add',$this->Lang('title_allow_add'));

$language_list = $this->GetPreference('launguage_list');
$smarty->assign('input_launguage_list', $this->CreateInputText($id,'launguage_list', $language_list, 40, 255));
$smarty->assign('title_launguage_list',$this->Lang('launguage_list'));

if (!empty($language_list)) {
	$langs_temp = explode(',', $language_list);
	if (count($langs_temp) > 0) {
		$lang_array = array();
		foreach ($langs_temp as $key => $val) {
			$lang_array[strtoupper($val)] = $val;
		}
		
		$smarty->assign('input_main_language', $this->CreateInputDropdown ($id,'main_language', $lang_array, -1, $this->GetPreference('main_language','lt'),40));
		$smarty->assign('title_main_language',$this->Lang('main_language'));
	}
}
echo $this->ProcessTemplate('prefs.tpl');

?>