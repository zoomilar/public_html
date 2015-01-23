<?php
#-------------------------------------------------------------------------------
#
# Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
#          a content management tool for CMS Made Simple
#          The projects homepage is dev.cmsmadesimple.org/projects/content2/
#          CMS Made Simple is (c) 2004-2013 by Ted Kulp
#          The projects homepage is: cmsmadesimple.org
# Version: 0.9.4
# File   : action.default.php
#          This file is a modification of the default plugin {content}
# Purpose: performs the default frontend action if {AdvancedContent} is used.
# License: GPL
# deprecated
#-------------------------------------------------------------------------------

if(!is_object(cmsms())) exit;

if(isset($params['active']) && ac_utils::IsFalse($params['active'])) return; # don't process inactive blocks

if(!$content_obj = cms_utils::get_current_content()) return;
$config = cmsms()->GetConfig();
$type   = isset($params['block_type']) ? $params['block_type'] : '';
if($content_obj->Type() != 'advanced_content' && $content_obj->Type() != 'content2')
{
	if($type == 'image')
	{
		if(!function_exists('smarty_cms_function_content_image') && !function_exists('smarty_function_content_image'))
			require_once($config['root_path'] . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'function.content_image.php');
		
		$method = function_exists('smarty_cms_function_content_image') ? 'smarty_cms_function_content_image' : 'smarty_function_content_image';
		$output = trim($method($params, cmsms()->GetSmarty()));
	}
	else if($type == 'module')
	{
		if(!function_exists('smarty_cms_function_content_module') && !function_exists('smarty_function_content_module'))
			require_once($config['root_path'] . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'function.content_module.php');
		
		$method = function_exists('smarty_cms_function_content_module') ? 'smarty_cms_function_content_module' : 'smarty_function_content_module';
		$output = trim($method($params, cmsms()->GetSmarty()));
	}
	else
	{
		if(!function_exists('smarty_cms_function_content') && !function_exists('smarty_function_content'))
			require_once($config['root_path'] . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'function.content.php');
		
		$method = function_exists('smarty_cms_function_content') ? 'smarty_cms_function_content' : 'smarty_function_content';
		$output = trim($method($params, cmsms()->GetSmarty()));
	}
	if(!isset($params['no_output']) || ac_utils::IsFalse($params['no_output']))
		echo $output;
	return;
}

$output = '';
$block  = isset($params['block']) ? preg_replace('/-+/', '_', munge_string_to_url($params['block'])) : 'content_en';

$id         = '';
$modulename = '';
$action     = '';
$inline     = false;
if (isset($_REQUEST['module']))
	$modulename = $_REQUEST['module'];

if (isset($_REQUEST['id']))
	$id = $_REQUEST['id'];
elseif (isset($_REQUEST['mact']))
{
	$ary        = explode(',', cms_htmlentities($_REQUEST['mact']), 4);
	$modulename = (isset($ary[0])?$ary[0]:'');
	$id         = (isset($ary[1])?$ary[1]:'');
	$action     = (isset($ary[2])?$ary[2]:'');
	$inline     = (isset($ary[3]) && $ary[3] == 1?true:false);
}

if (isset($_REQUEST[$id.'action']))
	$action = $_REQUEST[$id.'action'];
else if (isset($_REQUEST['action']))
	$action = $_REQUEST['action'];

if ($block == 'content_en' && ($id == 'cntnt01' || $id == '_preview_' || ($id != '' && $inline == false)))
{
	$module =& ac_utils::get_module($modulename);
	if(is_object($module) && $module->IsPluginModule())
	{
		@ob_start();
		
		$params   = GetModuleParameters($id);
		$returnid = isset($params['returnid']) ? $params['returnid'] : $content_obj->Id();
		$output   = $module->DoActionBase($action, $id, $params, $returnid);
		if ($output !== FALSE && (!isset($params['no_output']) || ac_utils::IsFalse($params['no_output'])))
			echo $output;
		
		$output = @ob_get_contents();
		@ob_end_clean();
	}
}
else
{
	$oldvalue                     = cmsms()->GetSmarty()->caching;
	cmsms()->GetSmarty()->caching = false;
	$contentId                    = $content_obj->Id();
	$output = cmsms()->GetSmarty()->fetch(str_replace(' ', '_', 'content:' . $block), '|'.$block, $contentId.$block);
	cmsms()->GetSmarty()->caching = $oldvalue;
	
	$defaultValue = isset($params['default']) ? trim($params['default']) : '';
	$doSmarty     = (isset($params['smarty']) && ac_utils::IsTrue($params['smarty']));
	if($doSmarty)
		$defaultValue = ac_utils::DoSmarty($content_obj, $defaultValue);
	
	$allowNone = (!isset($params['allow_none']) || ac_utils::IsFalse($params['allow_none']));
	
	if($output == '' && !$allowNone)
		$output = $defaultValue;
}
if(!isset($params['no_output']) || ac_utils::IsFalse($params['no_output']))
	echo trim($output);
?>
