<?php
function smarty_modifier_get_subpage($contid, $label)
{
	global $gCms;
	$db= $gCms->getDb();

	if ($contid){
		$alias = $db->getOne("SELECT content_alias FROM cms_content WHERE parent_id='{$contid}'");
	
		if ($alias)
			$ret = "<a href='/{$alias}' class='techbutton'>{$label}</a>";
	
	}
	
    return $ret;
}


?>
