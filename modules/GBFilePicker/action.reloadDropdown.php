<?php
#-------------------------------------------------------------------------------
#
# Module : GBFilePicker (c) 2010-2012 by Georg Busch (georg.busch@gmx.net) 
#          a file picker tool for CMS Made Simple
#          The projects homepage is: dev.cmsmadesimple.org/projects/gbfilepicker
#          CMS Made Simple is (c) 2004-2012 by Ted Kulp
#          The projects homepage is: cmsmadesimple.org
# Version: 1.3.3
# File   : action.reloadDropdown.php
# Purpose: update dropdown
# License: GPL
#
#-------------------------------------------------------------------------------

if(!function_exists('cmsms') || !is_object(cmsms())) exit;

global $CMS_ADMIN_PAGE;
$config = cmsms()->GetConfig();

//input name
if(!isset($params['name']) || $params['name']=='')
{
	return;
}
else
{
	$name = htmlentities(trim($params['name']));
}
if($id == 'cntnt01' && isset($_SESSION['GBFP_id_'.$name]))
{
	$id = $_SESSION['GBFP_id_'.$name];
}

if(!$session_params =& $this->GetInputParams($id,$name))
{
	return;
}

$params = array_merge($params, $session_params);

if($params['mode'] != 'dropdown' || $params['name'] != $name)
{
	return;
}

// check permission
if(isset($CMS_ADMIN_PAGE) && $CMS_ADMIN_PAGE == 1)
{
	check_login();
	if(!$this->CheckPermission('Use GBFilePicker'))
		return;
	$username = $this->_username;
}
else
{
	if( !$feusers =& $this->GetModuleInstance('FrontEndUsers' ) )
	{
		return;
	}
	if(!$userid = $feusers->LoggedInId())
	{
		return;
	}
	if(!$groups = $feusers->GetMemberGroupsArray($userid))
	{
		return;
	}
	$access = false;
	foreach($groups as $_group)
	{
		if(in_array($_group['groupid'],$params['feu_access']))
		{
			$access = true;
			break;
		}
	}
	if(!$access)
	{
		return;
	}
	$username = $feusers->GetUserName($userid);
}

// module id
$_id = $id;
if($params['id'] == '')
{
	$_id = '';
}

$ajax = isset($params['ajax']) && $this->IsTrue($params['ajax']);
$xml  = $ajax && isset($params['xml']) && $this->IsTrue($params['xml']);

if($ajax)
{
	@ob_end_clean();
	@ob_start();
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	if($xml)
	{
		header('Content-Type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<result><![CDATA[';
	}
	else
	{
		header('Content-type: text/html; charset=utf-8');
	}
}

echo $this->CreateFileDropdown($_id, $name,
	$params['start_dir'],
	isset($params['value']) ? $params['value'] : '',
	$params['exclude_prefix'],
	$params['include_prefix'],
	$params['exclude_sufix'],
	$params['include_sufix'],
	$params['file_extensions'],
	$params['media_type'],
	$params['allow_none'],
	$params['add_txt']);

if($ajax)
{
	if($xml)
	{
		echo ']]></result>';
	}
	@ob_end_flush();
	exit;
}
?>