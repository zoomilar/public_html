<?php
if (!isset($gCms)) exit;

global $contentobj;

$kalba = $smarty->get_template_vars('kalba');

$show_filelists = $this->IsDestination($kalba);


if ($show_filelists == 1) {
	
	$filelists = $this->GetFilelistsFrontEnd($contentobj->mId);
	//print_r($filelists);
	
	$filter1 = array();
	$filter2 = array();
	
	
	if ($filelists !== false) {
		
		foreach ($filelists as $key => $val) {
			/*if ($this->isOwner($val['id'])) {
				$prettyurl = $this->GetFilelistPrettyUrl('add_edit_front', array('returnid' => $returnid, 'filelist_id' => $val['id']));
				$filelists[$key]['url'] = $this->CreateLink($id, 'add_edit_front', $returnid, '', array(), '', true, false, '', false, $prettyurl);
			}*/
			$prettyurl = $this->GetFilelistPrettyUrl('view_front', array('returnid' => $returnid, 'filelist_id' => $val['id']));
			$filelists[$key]['link'] = $this->CreateLink($id, 'view_front', $returnid, '', array(), '', true, false, '', false, $prettyurl);
			
			if (isset($filelists[$key]['files2'][0]['full']) && !empty($filelists[$key]['files2'][0]['full'])) {
				$filelists[$key]['is_download'] = 1;
			} else {
				$filelists[$key]['is_download'] = 0;
			}
			
			
			
			$dt = explode('-', $val['date']);
			if (!isset($filter1[$dt[0]])) {
				$filter1[$dt[0]] = $dt[0];
			}
			if (!isset($filter2[$dt[1]])) {
				$filter2[$dt[1]] = $dt[1];
			}	
			
		}
		
		if (!isset($filter1[date('Y')])) {
			$filter1[date('Y')] = date('Y');
		}
		
		if (!isset($filter2[date('m')])) {
			$filter2[date('m')] = date('m');
		}
		
		asort($filter1);
		asort($filter2);
		
		$file_groups = $this->GetFileTypes();
		
		
		$this->smarty->assign('file_groups', $file_groups);
		$this->smarty->assign('filter1', $filter1);
		$this->smarty->assign('filter2', $filter2);
		$this->smarty->assign('count_filelists', count($filelists));
		$this->smarty->assign('filelists', $filelists);
	} else {
		$this->smarty->assign('count_filelists', 0);
	}
	
	//if ($this->_FEU->LoggedInId() > 0) {
		//$this->smarty->assign('is_subscribed', $this->IsSubscribed($returnid));
		
		$prettyurl = $this->GetFilelistPrettyUrl('add_edit_front', array('returnid' => $returnid));
		$this->smarty->assign('add_edit', $this->CreateLink($id, 'add_edit_front', $returnid, '', array(), '', true, false, '', false, $prettyurl));
	//}
}

$this->smarty->assign('show_filelists', $show_filelists);

echo $this->ProcessTemplate('filelists_main.tpl');

?>