<?php

if( !isset($gCms) ) exit;

$db = $this->GetDb();

$msg_id = 0;
$title = '';
$content = '';
$user_group = 0;
$active = 0;
$priority = 0;
$ex_date = date('Y-m-d', strtotime('+1 month'));
$user = array();
$where = 0;

if (isset($params['submit'])) {
	//print_r($params);
	$msg_id = (isset($params['msg_id'])?$params['msg_id']:$msg_id);
	$title = (isset($params['title'])?$params['title']:$title);
	$content = (isset($params['content'])?$params['content']:$content);
	$user_group = (isset($params['user_group'])?$params['user_group']:$user_group);
	$active = (isset($params['active'])?$params['active']:$active);
	$priority = (isset($params['priority'])?$params['priority']:$priority);
	$ex_date = (isset($params['ex_date'])?$params['ex_date']:$ex_date);
	$user = (isset($params['user'])?$params['user']:$user);
	$where = (isset($params['where'])?$params['where']:$where);
	
	//echo '<pre>';
	//print_r($params);
	//die;
	
	if ($msg_id > 0) {
		//update
		$query = "UPDATE ".cms_db_prefix()."module_feusers_messages SET title = ?, content = ?, user_group = ?, active = ?, priority = ?, ex_date = ?, `where` = ? WHERE id = ?";
		$db->Execute($query, array($title, $content, $user_group, $active, $priority, $ex_date, $where, $msg_id));
	} else {
		//insert
		$query = "INSERT INTO ".cms_db_prefix()."module_feusers_messages SET title = ?, content = ?, user_group = ?, active = ?, priority = ?, ex_date = ?, `where` = ?, cr_date = NOW()";
		$db->Execute($query, array($title, $content, $user_group, $active, $priority, $ex_date, $where));
		
		$msg_id = $db->Insert_ID();
	}
	
	$query = "DELETE FROM ".cms_db_prefix()."module_feusers_messages_users WHERE message_id = ?";
	$db->Execute($query, array($msg_id));
	
	if (count($user) > 0) {
		foreach ($user as $us) {
			$query  = "INSERT INTO ".cms_db_prefix()."module_feusers_messages_users SET user_id = ?, message_id = ?";
			$db->Execute($query, array($us, $msg_id));
		}
		$query3 = "UPDATE ".cms_db_prefix()."module_feusers_messages SET `user` = 1 WHERE id = ?";
		$db->Execute($query3, array($msg_id));
	} else {
		$query3 = "UPDATE ".cms_db_prefix()."module_feusers_messages SET `user` = 0 WHERE id = ?";
		$db->Execute($query3, array($msg_id));
	}
	//echo $db->sql;
	$this->RedirectToTab($id, 'usermessages');
	exit;
}

if (isset($params['message_id']) && $params['message_id'] > 0) {
	$query = "SELECT * FROM ".cms_db_prefix()."module_feusers_messages WHERE id = ?";
	$row = $db->GetRow($query, array($params['message_id']));
	if ($row['id'] > 0) {
		$msg_id = $row['id'];
		$title = $row['title'];
		$content = $row['content'];
		$user_group = $row['user_group'];
		$active = $row['active'];
		$priority = $row['priority'];
		$ex_date = $row['ex_date'];
		$where = $row['where'];
		
		$query2 = "SELECT * FROM ".cms_db_prefix()."module_feusers_messages_users WHERE message_id=?";
		$row2 = $db->GetArray($query2 , array($row['id']));
		if (is_array($row2) && count($row2) > 0) {
			foreach ($row2 as $val2) {
				$user[] = $val2['user_id'];
			}
		}
	}
}
$user_group_list = $this->GetGroupList();

if ($user_group) {
	$user_list_temp = $this->GetUsersInGroup($user_group);
} else {
	$user_list_temp = $this->GetUsersInGroup(array_shift(array_values($user_group_list)));
}
$user_list = array();
foreach ($user_list_temp as $key => $val) {
	$user_list[$val['username']] = $val['id'];
}

$where_list = array(
	$this->Lang('where_profile') => 0,
	$this->Lang('where_messages') => 1
);
/*
echo '<pre>';
print_r($user_list);
echo '</pre>';
*/
$smarty->assign('startform', $this->CreateFormStart( $id, 'editmessage '));

$smarty->assign('msg_id', $this->CreateInputHidden($id, 'msg_id', $msg_id));
$smarty->assign('title', $this->CreateInputText($id, 'title', $title, 40, 255));
$smarty->assign('content', $this->CreateTextArea(false, $id, $content, 'content', '', '', '', '', 80, 20));
$smarty->assign('user_group', $this->CreateInputSelectList($id, 'user_group', $user_group_list, array($user_group), 1,'', false));
$smarty->assign('active', $this->CreateInputCheckbox ($id, 'active', 1, $active));
$smarty->assign('priority', $this->CreateInputCheckbox ($id, 'priority', 1, $priority));
$smarty->assign('ex_date', $this->CreateInputDate ($id, 'ex_date', $ex_date));
$smarty->assign('user', $this->CreateInputSelectList($id, 'user[]', $user_list, $user, 20,'', true));
$smarty->assign('where', $this->CreateInputSelectList($id, 'where', $where_list, array($where), 1,'', false));


$smarty->assign('mtitle_title', $this->Lang('mtitle_title'));
$smarty->assign('mtitle_content', $this->Lang('mtitle_content'));
$smarty->assign('mtitle_user_group', $this->Lang('mtitle_user_group'));
$smarty->assign('mtitle_active', $this->Lang('mtitle_active'));
$smarty->assign('mtitle_priority', $this->Lang('mtitle_priority'));
$smarty->assign('mtitle_ex_date', $this->Lang('mtitle_ex_date'));
$smarty->assign('mtitle_user', $this->Lang('mtitle_user'));
$smarty->assign('mtitle_where', $this->Lang('mtitle_where'));

$smarty->assign('submit', $this->CreateInputSubmit ($id, 'submit',$this->Lang('submit')));

$smarty->assign ('endform', $this->CreateFormEnd());

echo $this->ProcessTemplate('editmessages.tpl');

?>