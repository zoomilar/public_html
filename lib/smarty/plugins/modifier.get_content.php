<?php

function smarty_modifier_get_content($id) {
	
	global $contentops;
	global $smarty;
	global $gCms;
	$config = $gCms->GetConfig();
	$db = $gCms->GetDb();
	$contentobj = $contentops->LoadContentFromId($id,true);
	//print_r($contentobj);
	//print_r(get_class_methods('content'));
	
	$HasChildren = $contentobj->HasChildren();
	
	if ($HasChildren){
		
		// http://pinus.w4.texus.lt/uploads/images/catalog_src/restoranas-pomodoro_src_1.jpg 
		
		$catmod = new Cataloger();
		
		if ($catmod == null) {
			echo "Error! Cannot access Cataloger module.";
			exit;
		}
		$rr_path = $catmod->getAssetPath('s');
		
		$query = "SELECT * FROM ".cms_db_prefix()."content WHERE parent_id = ?";
		$res = $db->GetArray($query, array($contentobj->Id()));
		
		//print_r($res);
		
		if (is_array($res) && count($res) > 0) {
			$ret = array();
			foreach ($res as $kk => $val) {
				$contentobj_x = $contentops->LoadContentFromId($val['content_id'],true);
				$file = $config['uploads_path'].$rr_path.'/'.$contentobj_x->Alias().'_src_1.jpg';
				
				if (file_exists($file) ) {
					$ret[] = $config['uploads_url'].$rr_path.'/'.$contentobj_x->Alias().'_src_1.jpg';
				}
			}
			
			return $ret;
		}
	}

}


?>