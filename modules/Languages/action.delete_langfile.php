<?php

if (!isset($gCms)) exit;

$params['delete_id'] = intval($params['delete_id']);

if ($params['delete_id'] > 0) {
	$query = "DELETE FROM ".cms_db_prefix()."module_languages_vars WHERE id = ? LIMIT 1";
	$db->Execute($query, array($params['delete_id']));
}

$this->populateLang();

$this->RedirectToAdminTab('general', '', '');

?>