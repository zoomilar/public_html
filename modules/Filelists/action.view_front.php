<?php

if (!isset($gCms)) exit;

if (isset($params['filelist_id']) && $params['filelist_id'] > 0) {
	$rec = $this->GetFilelistFrontEnd($params['filelist_id']);
}

if (isset($rec) && is_array($rec) && count($rec) > 0) {
	
	$smarty->assign('rec', $rec);
	
	if ($rec['needs_registration'] == 1) {
		
		$smarty->assign('show_registration', '1');
		
		$prettyurl = $this->GetFilelistPrettyUrl('view_front', array('returnid' => $returnid, 'filelist_id' => $rec['id']));
		$form_action = $this->CreateLink($id, 'view_front', $returnid, '', array(), '', true, false, '', false, $prettyurl);
		$this->smarty->assign('form_action', $form_action);
		
		
		$name = '';
		$email = '';
		$workplace = '';
		$questions = '';
		
		if (isset($params['name']) && !empty($params['name'])) {
			$name = $params['name'];
		}
		if (isset($params['email']) && !empty($params['email'])) {
			$email = $params['email'];
		}
		if (isset($params['workplace']) && !empty($params['workplace'])) {
			$workplace = $params['workplace'];
		}
		if (isset($params['questions']) && !empty($params['questions'])) {
			$questions = $params['questions'];
		}
		
		$errors = array();
		if (isset($params['submit'])) {
			if (empty($name) || empty($email) || empty($workplace)) {
				$errors[] = 'where_is_info';
			} else {
				//print_r($params); die;
				$this->RegisterUser($params);
				header("Location: ".$form_action.'?success=1');
				exit();
			}
		}
		
		$smarty->assign('errors', $errors);
		
		
		$smarty->assign('input_name', $this->CreateInputText($id,'name',$name, 60, 255));
		$smarty->assign('input_email', $this->CreateInputText($id,'email',$email, 60, 255));
		$smarty->assign('input_workplace', $this->CreateInputText($id,'workplace',$workplace, 60, 255));
		$smarty->assign('input_questions', $this->CreateTextArea(true, $id, $questions, 'questions', '', '', '', '', 40, 10));
		
		
		$smarty->assign('hidden', $this->CreateInputHidden($id,'filelist_id',$rec['id']).$this->CreateInputHidden($id,'submit','1'));
		$smarty->assign('mod', $this);
		$smarty->assign('end_form', $this->CreateFormEnd());
		
	}
	
	$smarty->assign('not_found', '0');
} else {
	$smarty->assign('not_found', '1');
}

$prettyurl = $this->GetFilelistPrettyUrl('add_edit_front', array('returnid' => $returnid));
$this->smarty->assign('add_edit', $this->CreateLink($id, 'add_edit_front', $returnid, '', array(), '', true, false, '', false, $prettyurl));


echo $this->ProcessTemplate('view.tpl');

?>