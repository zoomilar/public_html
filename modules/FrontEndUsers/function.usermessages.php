<?php


$db = $this->GetDb();

$query = "SELECT * FROM ".cms_db_prefix()."module_feusers_messages ORDER BY cr_date DESC";

$all_array = $db->GetArray($query);

if (is_array($all_array) && count($all_array) > 0) {
	foreach ($all_array as $key => $val) {
		$all_array[$key]['edit_link'] = $this->CreateLink ($id, 'editmessage', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang ('edit'), '', '', 'systemicon'), array ('message_id' => $val['id'] ));
		
		$all_array[$key]['delete_link'] = $this->CreateLink ($id,'do_deletemessage',$returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang ('delete'), '', '', 'systemicon'), array ('message_id' => $val['id']), $this->Lang ('areyousure_delete_m', $val['title']));
		
	}
}


$smarty->assign('all_array', $all_array);

$smarty->assign('addlink',  $this->CreateLink($id,'editmessage',$returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('addmessage'),'','','systemicon'), array(), '', false, false, '').' '. $this->CreateLink( $id, 'editmessage', $returnid, $this->Lang('addmessage'), array(), '', false, false, 'class="pageoptions"'));
$smarty->assign('startform', $this->CreateFormStart( $id, 'do_deletemessage'));
$smarty->assign ('endform', $this->CreateFormEnd());

echo $this->ProcessTemplate('usermessages.tpl');

?>