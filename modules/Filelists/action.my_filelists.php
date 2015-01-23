<?php

if (!isset($gCms)) exit;

$filelists = $this->GetMyEvents();

if ($filelists !== false) {
	
	foreach ($filelists as $key => $val) {
		if ($this->isOwner($val['id'])) {
			$prettyurl = $this->GetFilelistPrettyUrl('add_edit_front', array('returnid' => $returnid, 'filelist_id' => $val['id']));
			$filelists[$key]['url'] = $this->CreateLink($id, 'add_edit_front', $returnid, '', array(), '', true, false, '', false, $prettyurl);
		}
		$prettyurl = $this->GetFilelistPrettyUrl('view_front', array('returnid' => $returnid, 'filelist_id' => $val['id']));
		$filelists[$key]['link'] = $this->CreateLink($id, 'view_front', $returnid, '', array(), '', true, false, '', false, $prettyurl);
	}
	
	$this->smarty->assign('count_filelists', count($filelists));
	$this->smarty->assign('filelists', $filelists);
} else {
	$this->smarty->assign('count_filelists', 0);
}

if ($this->_FEU->LoggedInId() > 0) {
	$prettyurl = $this->GetFilelistPrettyUrl('add_edit_front', array('returnid' => $returnid));
	$this->smarty->assign('add_edit', $this->CreateLink($id, 'add_edit_front', $returnid, '', array(), '', true, false, '', false, $prettyurl));
}

echo $this->ProcessTemplate('filelists_my.tpl');

?>