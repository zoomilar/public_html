<?php
if (!isset($gCms)) exit;
$config = $gCms->GetConfig();
$FEU = $gCms->GetModuleInstance('FrontEndUsers');


switch ($action_x) {
	case "get_user_list":
		$user_list_temp = $FEU->GetUsersInGroup($_GET['gid']);
		$user_list = '';
		foreach ($user_list_temp as $key => $val) {
			$user_list .= '<option value="'.$val['id'].'">'.$val['username'].'</option>'."\n";
		}
		echo $user_list;
		exit;
	break;
}


?>