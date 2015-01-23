<?php

if (!isset($gCms)) exit;

$filelist_id = intval($params['filelist_id']);
if ($filelist_id > 0) {
	$this->DeleteFilelistAdmin($filelist_id);
}

$this->Redirect($id, 'defaultadmin', $returnid);

?>