<?php


list($fields_to_show, $names_to_show) = $this->GetNamesAndFields();

/*
$language_list = $this->GetPreference('launguage_list');
$main_language = $this->GetPreference('main_language','lt');

$fields_to_show = array();
$names_to_show = array();

//


if (!empty($language_list)) {
	$langs_temp = explode(',', $language_list);
	if (count($langs_temp) > 0) {
		$fields_to_show[$main_language] = 'value_'.$main_language;
		$names_to_show[$main_language] = strtoupper($main_language);
		foreach ($langs_temp as $key => $val) {
			$fields_to_show[$val] = 'value_'.$val;
			$names_to_show[$val] = strtoupper($val);
		}
	}
	
}*/

if (count($fields_to_show) > 0) {
	$query = "SELECT id, system_name, ".implode(', ', $fields_to_show).", files FROM ".cms_db_prefix()."module_languages_vars ORDER BY id";
	$result = $db->GetArray($query);
	$list = array();
	
	foreach ($result as $key => $val) {
		$list[$val['id']] = $val;
		$list[$val['id']]['edit_url'] = $this->CreateLink($id,'edit_langfile', $returnid, $this->Lang('edit_langfile'), array('edit_id' => $val['id']));
		$list[$val['id']]['delete_url'] = $this->CreateLink($id,'delete_langfile', $returnid, $this->Lang('delete_langfile'), array('delete_id' => $val['id']), $this->Lang('do_delete_this'));
	}
	
}

$smarty->assign('fields_to_show', $fields_to_show);
$smarty->assign('names_to_show', $names_to_show);
$smarty->assign('list', $list);
$smarty->assign('addlink', $this->CreateLink($id,'edit_langfile', $returnid, $this->Lang('add_langfile')));



$smarty->assign('refresh', $this->CreateLink($id,'refresh', $returnid, $this->Lang('refresh')));
$smarty->assign('read_file', $this->CreateLink($id,'read_file', $returnid, $this->Lang('read_file')));
$smarty->assign('default_values', $this->CreateLink($id,'default_values', $returnid, $this->Lang('default_values')));

echo $this->ProcessTemplate('lang_list.tpl');


?>