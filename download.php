<?php

include_once('include.php');
global $gCms;
global $langfile;
$db = $gCms->GetDb();

if (isset($_POST['action'])) {
	$action_x = $_POST['action'];
} else {
	$action_x = $_GET['action'];
}

switch ($action_x) {
	case "FilelistGetFile":
		include('modules/Filelists/action.ajax.php');
	break;
}
?>