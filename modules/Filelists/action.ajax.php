<?php
if (!isset($gCms)) exit;
$config = $gCms->GetConfig();
$filelists = $gCms->GetModuleInstance('Filelists');

switch ($action_x) {
	case "FilelistGetFile":
		$filelists->GetFile($_GET['id'], $_GET['file']);
		die('error');
	break;
	case "FilelistGetRegList":
		$filelists->GetRegList($_GET['id']);
		die('error');
	break;
	case "GetFilelistFileList":
		$ret = $filelists->GetFiles($_POST['filelist_id']);
		if ($ret == false) {
			echo json_encode(array('status' => false));
		} else {
			echo json_encode(array('status' => true, 'files' => $ret));
		}
	break;
	case "FilelistSortImages":
		echo $filelists->FilelistSortImages($_GET['ser'], $_GET['filelist_id']);
	break;
	case "DellFilelistFile":
		echo $filelists->DellFilelistFile($_POST['file'], $_POST['filelist_id']);
	break;
	case "FilelistUpload":
		echo $filelists->uploadImage($_GET['filelist_id']);
	break;
	case "GetFilelistFileList2":
		$ret = $filelists->GetFiles2($_POST['filelist_id']);
		if ($ret == false) {
			echo json_encode(array('status' => false));
		} else {
			echo json_encode(array('status' => true, 'files' => $ret));
		}
	break;
	case "FilelistSortImages2":
		echo $filelists->FilelistSortImages2($_GET['ser'], $_GET['filelist_id']);
	break;
	case "DellFilelistFile2":
		echo $filelists->DellFilelistFile2($_POST['file'], $_POST['filelist_id']);
	break;
	case "FilelistUpload2":
		echo $filelists->uploadImage2($_GET['filelist_id']);
	break;
	case "FilelistsUnSubScribe":
		$r = $filelists->UnSubScribe($_POST['cat_id']);
		if ($r !== false) {
			echo json_encode(array('status' => true, 'button' => $r));
		} else {
			echo json_encode(array('status' => false));
		}
	break;
	
}

?>