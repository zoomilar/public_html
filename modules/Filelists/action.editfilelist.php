<?php

if (!isset($gCms)) exit;

if( $this->CheckPermission('Modify Filelists') ) {
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
	$admin_msg = '';
	$active = 0;
	$needs_registration = 0;
	$deleted = 0;
	$user_id = 0;
	$file = '';
	$file_name = '';
	$file2 = '';
	$file_name2 = '';
	$cat_id = array();
	$has_reg = 0;
	$filelist_id_tmp = md5(rand(1000,9999).time());


	if (isset($params['filelist_id']) && $params['filelist_id'] > 0) {
		$rec = $this->GetFilelistAdmin($params['filelist_id']);
		
		if ($rec !== false) {
			
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
			$deleted = $rec['deleted'];
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
	if (isset($params['admin_msg']) && !empty($params['admin_msg'])) {
		$admin_msg = $params['admin_msg'];
	}
	if (isset($params['active']) && !empty($params['active'])) {
		$active = $params['active'];
	}
	if (isset($params['needs_registration']) && !empty($params['needs_registration'])) {
		$needs_registration = $params['needs_registration'];
	}
	if (isset($params['deleted']) && !empty($params['deleted'])) {
		$deleted = $params['deleted'];
	}
	if (isset($params['user_id']) && !empty($params['user_id'])) {
		$user_id = $params['user_id'];
	}
	if (isset($params['cat_id']) && !empty($params['cat_id'])) {
		$cat_id = $params['cat_id'];
	}
	if (isset($params['filelist_id_tmp']) && !empty($params['filelist_id_tmp'])) {
		$filelist_id_tmp = $params['filelist_id_tmp'];
	}

	if (isset($params['cancel'])) {
		$this->Redirect($id, 'defaultadmin', $returnid);
	}


	if (isset($params['submit'])) {
		if (empty($filename)) {
			echo $this->ShowErrors($this->Lang('no_filename'));
		} else {
			$params['admin'] = true;
			if ($filelist_id > 0) {
				//update
				$this->InsertUpdate($id, $filelist_id, $params);
			} else {
				//insert
				$filelist_id = $this->InsertUpdate($id, 0, $params);
			}
			$this->Redirect($id, 'defaultadmin', $returnid);
		}
	}


	$smarty->assign('start_form', $this->CreateFormStart($id, 'editfilelist', $returnid, 'post', 'multipart/form-data'));


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
	
	$smarty->assign('title_location', $this->Lang('title_location'));
	$smarty->assign('input_location', $this->CreateInputText($id,'location',$location, 60, 255));
	
	$smarty->assign('title_user_nr', $this->Lang('title_user_nr'));
	$smarty->assign('input_user_nr', $this->CreateInputText($id,'user_nr',$user_nr, 60, 255));
	
	$smarty->assign('title_user_name', $this->Lang('title_user_name'));
	$smarty->assign('input_user_name', $this->CreateInputText($id,'user_name',$user_name, 60, 255));
	
	$smarty->assign('title_user_email', $this->Lang('title_user_email'));
	$smarty->assign('input_user_email', $this->CreateInputText($id,'user_email',$user_email, 60, 255));
	
	$smarty->assign('title_detail', $this->Lang('title_detail'));
	$smarty->assign('input_detail', $this->CreateTextArea(false, $id,$detail,'detail', '', '', '', '', 40, 10));
	
	$smarty->assign('title_cooking_course', $this->Lang('title_cooking_course'));
	$smarty->assign('input_cooking_course', $this->CreateTextArea(false, $id,$cooking_course,'cooking_course', '', '', '', '', 40, 10));

	$smarty->assign('title_short_desc', $this->Lang('title_short_desc'));
	$smarty->assign('input_short_desc', $this->CreateTextArea(false, $id,$short_desc,'short_desc', '', '', '', '', 40, 10));

	$smarty->assign('title_keywords', $this->Lang('title_keywords'));
	$smarty->assign('input_keywords', $this->CreateTextArea(false, $id,$keywords,'keywords', '', '', '', '', 40, 10));
	
	$smarty->assign('title_admin_msg', $this->Lang('title_admin_msg'));
	$smarty->assign('input_admin_msg', $this->CreateTextArea(false, $id,$admin_msg,'admin_msg', '', '', '', '', 40, 10));

	$smarty->assign('title_active', $this->Lang('title_active'));
	
	
	$statuses = array(
		$this->Lang('no_approved') => 0,
		/*$this->Lang('needs_fixing') => 2,*/
		$this->Lang('approved') => 1 /*,
		$this->Lang('canceled') => 3*/
	
	);
	
	$smarty->assign('input_active', $this->CreateInputDropdown($id, 'active', $statuses, -1, $active));
	
	$smarty->assign('title_needs_registration', $this->Lang('title_needs_registration'));
	$smarty->assign('input_needs_registration', $this->CreateInputCheckbox ($id,'needs_registration', 1, $needs_registration));

	$smarty->assign('title_deleted', $this->Lang('title_deleted'));
	$smarty->assign('input_deleted', $this->CreateInputCheckbox ($id,'deleted', 1, $deleted));



	$users = $this->_FEU->GetUsersInGroup();



	$users_select = array(' -- ' => 0);
	if (is_array($users) && count($users) > 0) {
		foreach ($users as $key => $val) {
			$users_select[$val['username']] = $val['id'];
		}
	}

	$smarty->assign('title_user_id', $this->Lang('title_user_id'));
	$smarty->assign('input_user_id', $this->CreateInputDropdown($id, 'user_id', $users_select, -1, $user_id));



	$smarty->assign('title_file', $this->Lang('title_file'));
	/*$smarty->assign('input_file', $this->CreateFileUploadInput($id, 'file'));

	if ($file != '') {
		$smarty->assign('file', $file);
		$smarty->assign('file_full', $file_full);
		$smarty->assign('title_delete_file', $this->Lang('title_delete_file'));
		$smarty->assign('input_delete_file', $this->CreateInputCheckbox ($id,'delete_file', 1));
	}*/

	$smarty->assign('title_file2', $this->Lang('title_file2'));
	/*$smarty->assign('input_file2', $this->CreateFileUploadInput($id, 'file2'));

	if ($file2 != '') {
		$smarty->assign('file2', $file2);
		$smarty->assign('file_full2', $file_full2);
		$smarty->assign('title_delete_file2', $this->Lang('title_delete_file2'));
		$smarty->assign('input_delete_file2', $this->CreateInputCheckbox ($id,'delete_file2', 1));
	}*/
	
	$file2_list = array(
		$this->Lang('file_none') => '',
		$this->Lang('file_pdf') => 'images/files/file_pdf.png',
		$this->Lang('file_jpg') => 'images/files/file_jpg.png',
		$this->Lang('file_2d') => 'images/files/file_2d.png',
		$this->Lang('file_3d') => 'images/files/file_3d.png'
	);
	
	$smarty->assign('title_file_t2', $this->Lang('title_file_t2'));
	$smarty->assign('input_file2', $this->CreateInputDropdown($id, 'file2', $file2_list, -1, $file2));


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
					$this->GetContentsAdmin($c_id, $pg_arr);
				}
			}
		}
	}
	/*
	echo '<pre>';
	print_r($pg_arr);
	echo '</pre>';
*/
	


	$smarty->assign('title_cat_id', $this->Lang('title_cat_id'));
	$smarty->assign('input_cat_id', $this->CreateInputSelectList ($id, 'cat_id[]', $pg_arr, $cat_id, 10));

	if ($filelist_id > 0) {
		$smarty->assign('filelist_id', $filelist_id);
	} else {
		$smarty->assign('filelist_id_tmp', $filelist_id_tmp);
	}
	
	$smarty->assign('has_reg', $has_reg);
	$smarty->assign('submit', $this->CreateInputHidden($id,'filelist_id',$filelist_id).$this->CreateInputHidden($id,'filelist_id_tmp',$filelist_id_tmp).$this->CreateInputSubmit($id, 'submit', $this->Lang('submit')));
	$smarty->assign('cancel', $this->CreateInputSubmit ($id, 'cancel', $this->Lang('cancel')));
	
	$smarty->assign('mod', $this);
	$smarty->assign('end_form', $this->CreateFormEnd());


	echo $this->ProcessTemplate('add_edit.tpl');
}
?>