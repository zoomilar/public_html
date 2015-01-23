<?php


$smarty->assign('start_form', $this->CreateFormStart($id, 'save_admin_prefs', $returnid));
$smarty->assign('end_form', $this->CreateFormEnd());
$smarty->assign('input_allow_add',$this->CreateInputCheckbox($id, 'allow_add', 1, $this->GetPreference('allow_add','0')). $this->Lang('title_allow_add_help'));

/*kalbos*/
$smarty->assign('prompt_kalbos',$this->Lang('prompt_kalbos'));
$smarty->assign('input_kalbos', $this->CreateInputText($id,'kalbos', $this->GetPreference('kalbos', 'lt'),50,255));

$lng_for_cur = $this->GetPreference('kalbos', 'lt');
$lng_for_cur = explode(',', $lng_for_cur);

if (is_array($lng_for_cur) && count($lng_for_cur) > 0) {
	$pg_arr = array();
	foreach ($lng_for_cur as $val) {
		$pg_arr[] = array('name' => $this->Lang('prompt_pg_field').' '.$val, 'value' => $this->CreateInputText($id,'pg_field_'.$val, $this->GetPreference('pg_field_'.$val, ''),50,255));
	}
	if (count($pg_arr) > 0) {
		$smarty->assign('input_pg_field', $pg_arr);
	}
}


/*kalbos end*/

$smarty->assign('prompt_admin_email',$this->Lang('prompt_admin_email'));
$smarty->assign('input_admin_email', $this->CreateInputText($id,'admin_email', $this->GetPreference('admin_email', ''),50,255));

$smarty->assign('prompt_calendar_mail',$this->Lang('prompt_calendar_mail'));
$smarty->assign('input_calendar_mail', $this->CreateInputText($id,'calendar_mail', $this->GetPreference('calendar_mail', ''),50,255));

$smarty->assign('prompt_calendar_pass',$this->Lang('prompt_calendar_pass'));
$smarty->assign('input_calendar_pass', $this->CreateInputText($id,'calendar_pass', $this->GetPreference('calendar_pass', ''),50,255));

$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));


$smarty->assign('title_allow_add',$this->Lang('title_allow_add'));

echo $this->ProcessTemplate('prefs.tpl');

?>