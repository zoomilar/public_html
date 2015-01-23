<?php

if (!isset($gCms)) exit;

if( $this->CheckPermission( 'Modify Filelists' ) ) {
	
	$cat_id = 0;
	$user_id = 0;
	$search_field = '';
	
	
	
	if (isset($params['cat_id']) && !empty($params['cat_id'])) {
		$cat_id = $params['cat_id'];
	}
	if (isset($params['user_id']) && !empty($params['user_id'])) {
		$user_id = $params['user_id'];
	}
	if (isset($params['search_field']) && !empty($params['search_field'])) {
		$search_field = $params['search_field'];
	}
	
	if (isset($params['reset'])) {
		$this->Redirect($id, 'defaultadmin', $returnid);
		exit;
	}
	
	$smarty->assign('start_form', $this->CreateFormStart($id, 'defaultadmin', $returnid, 'get', 'multipart/form-data'));
	
	$lng_for_cur = $this->GetPreference('kalbos', 'lt');
	$lng_for_cur = explode(',', $lng_for_cur);

	$pg_arr = array($this->Lang('none') => 0);
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
			//print_r($pg_arr);
		}
	}
	
	$smarty->assign('title_cat_id', $this->Lang('title_cat_id'));
	$smarty->assign('input_cat_id', $this->CreateInputDropdown($id, 'cat_id', $pg_arr, -1, $cat_id));
	
	$users = $this->_FEU->GetUsersInGroup();
	
	$users_select = array(' -- ' => 0);
	if (is_array($users) && count($users) > 0) {
		foreach ($users as $key => $val) {
			$users_select[$val['username']] = $val['id'];
		}
	}

	$smarty->assign('title_user_id', $this->Lang('title_user_id'));
	$smarty->assign('input_user_id', $this->CreateInputDropdown($id, 'user_id', $users_select, -1, $user_id));
	
	$smarty->assign('title_search_field', $this->Lang('title_search_field'));
	$smarty->assign('input_search_field', $this->CreateInputText($id,'search_field',$search_field, 45, 255));
	
	$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', $this->Lang('search')));
	$smarty->assign('reset', $this->CreateInputSubmit ($id, 'reset', $this->Lang('reset')));
	
	$smarty->assign('end_form', $this->CreateFormEnd());
	
	if (isset($params['submit'])) {
		$res = $this->GetFilelistsAdmin($params);
	} else {
		$res = $this->GetFilelistsAdmin();
	}
	
	//$res = $this->GetFilelistsAdmin();
	/*echo '<pre>';
	print_r($res);
	echo '</pre>';*/
	if (is_array($res) && count($res) > 0) {
		foreach ($res as $key => $val) {
			
			
			$res[$key]['editlink'] = $this->CreateLink($id, 'editfilelist', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('filelist_id'=>$val['id']));
			
			$res[$key]['deletelink'] = $this->CreateLink($id, 'deletefilelist', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('filelist_id'=>$val['id']), $this->Lang('areyousure_deletefilelist'));
		}
		$this->smarty->assign('item_count', count($res));
	} else {
		$this->smarty->assign('item_count', 0);
	}

	$this->smarty->assign('items', $res);

	$this->smarty->assign('idtext', $this->Lang('idtext'));
	$this->smarty->assign('title_filelists_list', $this->Lang('title_filelists_list'));
	$this->smarty->assign('filenametext', $this->Lang('filenametext'));
	$this->smarty->assign('datetext', $this->Lang('datetext'));
	$this->smarty->assign('activetext', $this->Lang('activetext'));
	$this->smarty->assign('deletedtext', $this->Lang('deletedtext'));
	$this->smarty->assign('usertext', $this->Lang('usertext'));

	$this->smarty->assign('mod', $this);


	$this->smarty->assign('addlink', $this->CreateLink($id, 'editfilelist', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newfolder.gif', $this->Lang('addfilelist'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'editfilelist', $returnid, $this->Lang('addfilelist'), array(), '', false, false, 'class="pageoptions"'));

	echo $this->ProcessTemplate('filelists_list.tpl');

}
?>