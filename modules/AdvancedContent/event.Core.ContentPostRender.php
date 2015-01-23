<?php
#-------------------------------------------------------------------------------
#
# Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
#          a content management tool for CMS Made Simple
#          The projects homepage is dev.cmsmadesimple.org/projects/content2/
#          CMS Made Simple is (c) 2004-2013 by Ted Kulp
#          The projects homepage is: cmsmadesimple.org
# Version: 0.9.4
# File   : event.Core.ContentPostRender.php
# Purpose: manages expiration of a page
# License: GPL
#
#-------------------------------------------------------------------------------

if(!function_exists('cmsms') || !is_object(cmsms())) exit;

if ($this->GetPreference('use_advanced_pageoptions',0))
{
	$config = cmsms()->GetConfig();
	$redirect = false;
	$db =& $this->GetDb();
	# get all content of type advanced content that need to be set to active/inactive
	$query = "SELECT C.content_id
		FROM " . cms_db_prefix() . "content C
		LEFT JOIN " . cms_db_prefix() . "content_props USE_EXP
			ON USE_EXP.content_id = C.content_id
		LEFT JOIN " . cms_db_prefix() . "content_props START_DATE
			ON START_DATE.content_id = C.content_id
		LEFT JOIN " . cms_db_prefix() . "content_props END_DATE
			ON END_DATE.content_id = C.content_id
		WHERE
			C.type = ? AND
			USE_EXP.prop_name = ? AND
			USE_EXP.content = ? AND (
				(
					START_DATE.prop_name = ? AND
					START_DATE.content <= ? AND
					END_DATE.prop_name = ? AND
					END_DATE.content > ? AND
					C.active = ?
				)
				OR
				(
					END_DATE.prop_name = ? AND
					END_DATE.content <= ? AND
					C.active = ?
				)
			)
	";
		
	$dbresult = $db->Execute($query, array('advanced_content', 'use_expire_date',
		'1', 'start_date', time(), 'end_date', time(), 0, 'end_date',
		time(), 1));
	
	$contentops = &cmsms()->GetContentOperations();
	while($dbresult && $row = $dbresult->FetchRow())
	{
		$content_obj = $contentops->LoadContentFromAlias($row['content_id']);
		$content_obj->SetActive(!$content_obj->Active());
		$content_obj->Save();
		if($row['content_id'] == cms_utils::get_current_pageid())
			$redirect = $row['content_id'];
	}
	if($redirect)
	{
		$params['content'] = '';
		$this->RedirectContent($redirect);
	}
}
?>
