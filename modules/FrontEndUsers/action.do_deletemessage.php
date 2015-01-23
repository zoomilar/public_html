<?php

if( !isset($gCms) ) exit;

$db = $this->GetDb();
$delete_array = array();
if (isset($params['message_id']) && $params['message_id'] > 0) {
	$delete_array[] = $params['message_id'];
} else if (isset($params['selectedx']) && count($params['selectedx']) > 0) {
	$delete_array = $params['selectedx'];
}
//print_r($delete_array); die;
if (is_array($delete_array) && count($delete_array) > 0) {
	foreach ($delete_array as $key => $val) {
		$query = "DELETE FROM ".cms_db_prefix()."module_feusers_messages WHERE id = ?";
		$db->Execute($query, array(intval($val)));

		$query = "DELETE FROM ".cms_db_prefix()."module_feusers_messages_users WHERE message_id = ?";
		$db->Execute($query, array(intval($val)));
		
		$query = "DELETE FROM ".cms_db_prefix()."module_feusers_messages_seen WHERE message_id = ?";
		$db->Execute($query, array(intval($val)));
	}
}


$this->RedirectToTab($id, 'usermessages');
exit;
?>