<?php

if (!isset($gCms)) exit;

$params['edit_id'] = intval($params['edit_id']);

list($fields_to_show, $names_to_show) = $this->GetNamesAndFields();


if ($params['edit_id'] > 0) {
	$query = "SELECT * FROM ".cms_db_prefix()."module_languages_vars WHERE id = ? ";
	$row = $db->GetRow($query, array($params['edit_id']));
	$edit_id = $params['edit_id'];
} else {
	$row = array();
	$edit_id = 0;
}

if (isset($params['submit'])) {
	
	//$row = $params;
	$row = array_merge($row, $params);
	
	//print_r($params);
	//die;
	
	if (empty($params['system_name'])) {
		echo $this->ShowErrors($this->Lang('error_empty_system_name'));
	} else {
		if ($params['edit_id'] > 0) {
			
			$query = "SELECT id FROM ".cms_db_prefix()."module_languages_vars WHERE system_name = ? AND id != ?";
			$eid = $db->GetOne($query, array($params['system_name'], $params['edit_id']));
			
			if ($eid > 0) {
				echo $this->ShowErrors($this->Lang('error_dublicate_system_name'));
			} else {
				if (count($fields_to_show) > 0) {
					//update
					
					$fields_update = array();
					$vals_update = array(
						$params['system_name'],
						$params['description']
					);
					foreach ($fields_to_show as $key => $val) {
						$fields_update[] = $val." = ?";
						$vals_update[] = $params[$val];
					}
					
					$query = "UPDATE ".cms_db_prefix()."module_languages_vars SET system_name = ?, description = ?, up_date = NOW(), ".implode(", ", $fields_update)." WHERE id = ? LIMIT 1";
					
					$vals_update[] = $params['edit_id'];
					
					$db->Execute($query, $vals_update);
					
					//echo $db->sql; die;
					
					$this->populateLang();
					
					$this->RedirectToAdminTab('general', '', '');
				}
			}
			
			//
			
		} else {
			$query = "SELECT id FROM ".cms_db_prefix()."module_languages_vars WHERE system_name = ?";
			$eid = $db->GetOne($query, array($params['system_name']));
			
			if ($eid > 0) {
				echo $this->ShowErrors($this->Lang('error_dublicate_system_name'));
			} else {
				//insert
				if (count($fields_to_show) > 0) {
					$fields_update = array();
					$vals_update = array(
						$params['system_name'],
						$params['description']
					);
					foreach ($fields_to_show as $key => $val) {
						$fields_update[] = $val." = ?";
						$vals_update[] = $params[$val];
					}
					
					$query = "INSERT INTO ".cms_db_prefix()."module_languages_vars SET system_name = ?, description = ?, cr_date = NOW(), ".implode(", ", $fields_update)."";
					$db->Execute($query, $vals_update);
					
					$this->populateLang();
					
					$this->RedirectToAdminTab('general', '', '');
				}
			}
		}
	}
} else if (isset($params['cancel'])) {
	$this->RedirectToAdminTab('general', '', '');
}

$smarty->assign('system_name', $this->CreateInputText($id, 'system_name', $row['system_name'], 40, 255));
$smarty->assign('title_system_name', $this->Lang('system_name'));

$values = array();
if (count($fields_to_show) > 0) {
	foreach ($fields_to_show as $key => $val) {
		$values[] = array('title' => $this->Lang('value').' '.$names_to_show[$key], 'value' => $this->CreateInputText($id, $val, $row[$val], 40, 255));
	}
}

$smarty->assign('values', $values);

$smarty->assign('description', $this->CreateTextArea(false, $id, $row['description'], 'description', '', '', '', '', '40', '5'));
$smarty->assign('title_description', $this->Lang('description'));

$smarty->assign('title_files', $this->Lang('files'));
$smarty->assign('files', $row['files']);

$smarty->assign('startform', $this->CreateFormStart($id, 'edit_langfile', $returnid));
$smarty->assign('endform', $this->CreateFormEnd());


$smarty->assign('hidden', $this->CreateInputHidden ($id, 'edit_id', $edit_id));
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', lang('submit')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', lang('cancel')));

echo $this->ProcessTemplate('edit_langfile.tpl');

?>