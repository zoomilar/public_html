<?php

function smarty_function_cms_include($params)
{

	if (!empty($params['tpl'])) {

		global $gCms;
		$db = $gCms->GetDb();	
		
		$sql = "SELECT * FROM ".cms_db_prefix()."templates WHERE template_name='{$params['tpl']}' LIMIT 1";  
		$res = $db->Execute($sql);

		if ($res && ($row = $res ->FetchRow())) {
		global $CMS_ADMIN_PAGE;
		//echo $CMS_ADMIN_PAGE." cia";
		 if(!empty($row['template_content']) && !$CMS_ADMIN_PAGE){
			global $smarty;
			echo $smarty->fetch("string:{$row['template_content']}");
		 }	
		}
	}
}

?>