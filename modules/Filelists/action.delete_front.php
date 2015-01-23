<?php

if (!isset($gCms)) exit;

global $contentobj;

$filelist_id = intval($params['filelist_id']);
if ($filelist_id > 0) {
	$this->DeleteFilelistFront($filelist_id);
}

header("Location: ".$contentobj->GetURL());
exit();

?>