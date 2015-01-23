<?php
exit;
if (!isset($gCms)) exit;

global $contentobj;

$filelist_id = 0;
$filename = '';
$location = '';
$user_name = '';
$user_email = '';
$user_nr = '';
$date = '';
$date_end = '';
$time_start = '';
$time_end = '';
$detail = '';
$cooking_course = '';
$short_desc = '';
$keywords = '';
$active = 0;
$needs_registration = 0;
$user_id = $this->_FEU->LoggedInId();
$file = '';
$file_name = '';
$file2 = '';
$file_name2 = '';
$cat_id = array('1' => $returnid);
//$params['cat_id'] = $cat_id;
$has_reg = 0;
$filelist_id_tmp = md5(rand(1000,9999).time());

if (isset($params['filelist_id']) && $params['filelist_id'] > 0) {
	$rec = $this->GetFilelistFrontEnd($params['filelist_id']);
	
	if ($rec !== false && $this->isOwner($params['filelist_id'])) {
		
		$filelist_id = $rec['id'];
		$filename = $rec['filename'];
		$location = $rec['location'];
		$user_name = $rec['user_name'];
		$user_email = $rec['user_email'];
		$user_nr = $rec['user_nr'];
		$date = $rec['date'];
		$date_end = $rec['date_end'];
		$time_start = ((!empty($rec['time_start']) && $rec['time_start'] != '00:00:00')?substr($rec['time_start'],0,5):'');
		$time_end = ((!empty($rec['time_end']) && $rec['time_end'] != '00:00:00')?substr($rec['time_end'],0,5):'');
		$detail = $rec['detail'];
		$cooking_course = $rec['cooking_course'];
		$short_desc = $rec['short_desc'];
		$keywords = $rec['keywords'];
		$active = $rec['active'];
		$needs_registration = $rec['needs_registration'];
		$user_id = $rec['user_id'];
		$file = $rec['file'];
		$file_full = $rec['file_full'];
		$file2 = $rec['file2'];
		$file_full2 = $rec['file_full2'];
		
		$cat_id = $this->GetCats($filelist_id);
		
		$has_reg = $this->HasRegistredUsers($filelist_id);
	}
	
}


if (isset($params['filename']) && !empty($params['filename'])) {
	$filename = $params['filename'];
}
if (isset($params['location']) && !empty($params['location'])) {
	$location = $params['location'];
}
if (isset($params['user_name']) && !empty($params['user_name'])) {
	$user_name = $params['user_name'];
}
if (isset($params['user_email']) && !empty($params['user_email'])) {
	$user_email = $params['user_email'];
}
if (isset($params['user_nr']) && !empty($params['user_nr'])) {
	$user_nr = $params['user_nr'];
}
if (isset($params['detail']) && !empty($params['detail'])) {
	$detail = $params['detail'];
}
if (isset($params['cooking_course']) && !empty($params['cooking_course'])) {
	$cooking_course = $params['cooking_course'];
}
if (isset($params['short_desc']) && !empty($params['short_desc'])) {
	$short_desc = $params['short_desc'];
}
if (isset($params['keywords']) && !empty($params['keywords'])) {
	$keywords = $params['keywords'];
}
if (isset($params['date']) && !empty($params['date'])) {
	$date = $params['date'];
}
if (isset($params['date_end']) && !empty($params['date_end'])) {
	$date_end = $params['date_end'];
}
if (isset($params['time_start']) && !empty($params['time_start'])) {
	$time_start = $params['time_start'];
}
if (isset($params['time_end']) && !empty($params['time_end'])) {
	$time_end = $params['time_end'];
}
if (isset($params['needs_registration']) && !empty($params['needs_registration'])) {
	$needs_registration = $params['needs_registration'];
}
if (isset($params['filelist_id_tmp']) && !empty($params['filelist_id_tmp'])) {
	$filelist_id_tmp = $params['filelist_id_tmp'];
}


$params['active'] = $active;
/*if (isset($params['active']) && !empty($params['active'])) {
	$active = $params['active'];
}*/

if (isset($params['cat_id']) && !empty($params['cat_id'])) {
	$cat_id = $params['cat_id'];
}

$params['user_id'] = $this->_FEU->LoggedInId();


/*
if (isset($params['cancel'])) {
    $this->Redirect($id, 'defaultadmin', $returnid);
}
*/
$errors = array();
if (isset($params['submit'])) {
	if (empty($filename)) {
		$errors[] = 'no_file';
	} else {
		//print_r($params); die;
		if ($filelist_id > 0 && $this->isOwner($filelist_id)) {
			
			//$this->InsertUpdate($id, $filelist_id, $params);
		} else {
			//insert
			$filelist_id = $this->InsertUpdate($id, 0, $params);
		}
		header("Location: ".$contentobj->GetURL().'?ins=1');
		exit();
		//$this->Redirect($id, 'defaultadmin', $returnid);
	}
}


//$smarty->assign('start_form', $this->CreateFormStart($id, 'add_edit_front', $returnid, 'post', 'multipart/form-data'));

$prettyurl = $this->GetFilelistPrettyUrl('add_edit_front', array('returnid' => $returnid, 'filelist_id' => $filelist_id));
$this->smarty->assign('form_action', $this->CreateLink($id, 'add_edit_front', $returnid, '', array()/*paramsai*/, '', true, false, '', false, $prettyurl));

$prettyurl = $this->GetFilelistPrettyUrl('delete_front', array('returnid' => $returnid, 'filelist_id' => $filelist_id));
$this->smarty->assign('delete_link', $this->CreateLink($id, 'delete_front', $returnid, '', array()/*paramsai*/, '', true, false, '', false, $prettyurl));
//


//$smarty->assign('filelist_id', $filelist_id);


$smarty->assign('title_filename', $this->Lang('title_filename'));
$smarty->assign('input_filename', $this->CreateInputText($id,'filename',$filename, 60, 255));

$smarty->assign('title_date', $this->Lang('title_date'));
$smarty->assign('input_date', $this->CreateInputText($id,'date',$date, 60, 255, 'data-input="date"'));

$smarty->assign('title_date_end', $this->Lang('title_date_ende'));
$smarty->assign('input_date_end', $this->CreateInputText($id,'date_end',$date_end, 60, 255, 'data-input="date"'));

$smarty->assign('title_time_start', $this->Lang('title_time_start'));
$smarty->assign('input_time_start', $this->CreateInputText($id,'time_start',$time_start, 8, 8, 'data-input="time"'));

$smarty->assign('title_time_end', $this->Lang('title_time_end'));
$smarty->assign('input_time_end', $this->CreateInputText($id,'time_end',$time_end, 8, 8, 'data-input="time"'));
/*
$date_end = '';
$time_start = '';
$time_end = '';
*/

$smarty->assign('title_location', $this->Lang('title_location'));
$smarty->assign('input_location', $this->CreateInputText($id,'location',$location, 60, 255));

$smarty->assign('title_user_name', $this->Lang('title_user_name'));
$smarty->assign('input_user_name', $this->CreateInputText($id,'user_name',$user_name, 60, 255));

$smarty->assign('title_user_email', $this->Lang('title_user_email'));
$smarty->assign('input_user_email', $this->CreateInputText($id,'user_email',$user_email, 60, 255));

$smarty->assign('title_user_nr', $this->Lang('title_user_nr'));
$smarty->assign('input_user_nr', $this->CreateInputText($id,'user_nr',$user_nr, 60, 255));

$smarty->assign('title_detail', $this->Lang('title_detail'));
$smarty->assign('input_detail', $this->CreateTextArea(true, $id,$detail,'detail', '', '', '', '', 40, 10));

$smarty->assign('title_cooking_course', $this->Lang('title_cooking_course'));
$smarty->assign('input_cooking_course', $this->CreateTextArea(true, $id,$cooking_course,'cooking_course', '', '', '', '', 40, 10));

$smarty->assign('title_short_desc', $this->Lang('title_short_desc'));
$smarty->assign('input_short_desc', $this->CreateTextArea(true, $id,$short_desc,'short_desc', '', '', '', '', 40, 10));


$smarty->assign('title_keywords', $this->Lang('title_keywords'));
$smarty->assign('input_keywords', $this->CreateTextArea(true, $id,$keywords,'keywords', '', '', '', '', 40, 10));


$lng_for_cur = $this->GetPreference('kalbos', 'lt');
$lng_for_cur = explode(',', $lng_for_cur);

$pg_arr = array();
if (is_array($lng_for_cur) && count($lng_for_cur) > 0) {
	foreach ($lng_for_cur as $val) {
		$c_id_a = $this->GetPreference('pg_field_'.$val, '');
		if (strpos($c_id_a, ',') !== false) {
			$c_id_a = explode(',', $c_id_a);
		} else {
			$c_id_a = array($c_id_a);
		}
		if (is_array($c_id_a) && count($c_id_a) > 0) {
			foreach ($c_id_a as $c_id) {
				$this->GetContentsFront($c_id, $pg_arr);
			}
		}
	}
}
/*
if (count($pg_arr) > 0) {
	$smarty->assign('title_cat_id', $this->Lang('title_cat_id'));
	$pg_inputs = array();
	foreach ($pg_arr as $p_name => $p_id) {
		$v = -1;
		
		if (in_array($p_id, $cat_id)) {
			$v = $p_id;
		}
		$pg_inputs[] = array(
			'input' => $this->CreateInputCheckbox($id,'cat_id[]', $p_id, $v, ($active==1?' disabled="disabled" ':'')),
			'name' => $p_name
		);
	}
	$smarty->assign('input_cat_id', $pg_inputs);
}*/
/*
$smarty->assign('title_cat_id', $this->Lang('title_cat_id'));
$smarty->assign('input_cat_id', $this->CreateInputDropdown($id, 'cat_id[]', $pg_arr, -1, $cat_id));
*/

$smarty->assign('input_cat_id', $this->CreateInputHidden($id,'cat_id[]',end($cat_id)));

//$smarty->assign('title_active', $this->Lang('title_active'));
//$smarty->assign('input_active', $this->CreateInputCheckbox ($id,'active', 1, $active));


$smarty->assign('title_file', $this->Lang('title_file'));
$smarty->assign('input_file', $this->CreateFileUploadInput($id, 'file'));

if ($file != '') {
	$smarty->assign('file', $file);
	$smarty->assign('file_full', $file_full);
	$smarty->assign('input_delete_file', $this->CreateInputCheckbox ($id,'delete_file', 1));
}

$smarty->assign('title_file2', $this->Lang('title_file2'));
$smarty->assign('input_file2', $this->CreateFileUploadInput($id, 'file2'));

if ($file2 != '') {
	$smarty->assign('file2', $file2);
	$smarty->assign('file_full2', $file_full2);
	$smarty->assign('input_delete_file2', $this->CreateInputCheckbox ($id,'delete_file2', 1));
}

$smarty->assign('title_active', $this->Lang('title_active'));
$smarty->assign('input_active', $this->CreateInputCheckbox ($id,'active', 1, $active));

$smarty->assign('title_needs_registration', $this->Lang('title_needs_registration'));
$smarty->assign('input_needs_registration', $this->CreateInputCheckbox ($id,'needs_registration', 1, $needs_registration));

if ($filelist_id > 0) {
	$smarty->assign('filelist_id', $filelist_id);
} else {
	$smarty->assign('filelist_id_tmp', $filelist_id_tmp);
}


$smarty->assign('hidden', $this->CreateInputHidden($id,'filelist_id',$filelist_id).$this->CreateInputHidden($id,'filelist_id_tmp',$filelist_id_tmp).$this->CreateInputHidden($id,'submit','1'));
$smarty->assign('cancel', $this->CreateInputSubmit ($id, 'cancel', $this->Lang('cancel')));
$smarty->assign('mod', $this);
$smarty->assign('has_reg', $has_reg);
$smarty->assign('end_form', $this->CreateFormEnd());

$smarty->assign('errors', $errors);


echo $this->ProcessTemplate('add_edit_front.tpl');

?>