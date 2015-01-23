<?php

function smarty_modifier_get_content_fp($id) {
	
	global $contentops;
	global $smarty;
	
	$contentobj = $contentops->LoadContentFromId($id,true);
	if ($contentobj) {
		//print_r($contentobj);
		//echo '<pre>';
		//print_r(get_class_methods('content'));
		//echo '</pre>';
		
		$h_ids = $contentobj->IdHierarchy();
		
		$tt = explode('.', $h_ids);
		//print_r($tt);
		
		
		$contentobj = $contentops->LoadContentFromId($tt[0],true);
		
		$ret['alias'] = $contentobj->Alias();
		$ret['active'] = $contentobj->Active();
		if ($ret['active']){
			
			
			$ret['tab1_header'] = $smarty->fetch("string:{$contentobj->GetPropertyValue('tab1_header')}");
			$ret['tab1'] = $smarty->fetch("string:{$contentobj->GetPropertyValue('content_en')}");
			
			$ret['tab2_header'] = $smarty->fetch("string:{$contentobj->GetPropertyValue('tab2_header')}");
			$ret['tab2'] = $smarty->fetch("string:{$contentobj->GetPropertyValue('tab2_cont')}");
			
			$ret['tab3_header'] = $smarty->fetch("string:{$contentobj->GetPropertyValue('tab3_header')}");
			$ret['tab3'] = $smarty->fetch("string:{$contentobj->GetPropertyValue('tab3_cont')}");
			
			$ret['tab4_header'] = $smarty->fetch("string:{$contentobj->GetPropertyValue('tab4_header')}");
			$ret['tab4'] = $smarty->fetch("string:{$contentobj->GetPropertyValue('tab4_cont')}");


			$ret['title'] = $contentobj->Name();
			$ret['menutext'] = $contentobj->MenuText();

			$ret['url'] = $contentobj->Alias().".html";
			$ret['alias'] = $contentobj->Alias();
			return $ret;
		}
	}
}


?>