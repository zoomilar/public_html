<?php
#-------------------------------------------------------------------------------
#
# Module : GBFilePicker (c) 2010-2012 by Georg Busch (georg.busch@gmx.net)
#          a filepicker tool for CMS Made Simple
#          The projects homepage is: dev.cmsmadesimple.org/projects/gbfilepicker
#          CMS Made Simple is (c) 2004-2012 by Ted Kulp
#          The projects homepage is: cmsmadesimple.org
# Version: 1.3.3
# File   : action.savePrefs.php
# Purpose: saves the preferences in the database
# License: GPL
#
#-------------------------------------------------------------------------------

if(!function_exists('cmsms') || !is_object(cmsms())) exit;

if(isset($params['submit'])) {
	
	if(isset($params['thumb_upload_action']))
		$this->SetPreference('thumb_upload_action', $params['thumb_upload_action']);
	
	if(isset($params['thumb_prefix_replacement']))
		$this->SetPreference('thumb_prefix_replacement', $params['thumb_prefix_replacement']);
	
	if(isset($params['restrict_users_diraccess']))
		$this->SetPreference('restrict_users_diraccess', $params['restrict_users_diraccess']);
	
	if(isset($params['show_filemanagement']))
		$this->SetPreference('show_filemanagement', $params['show_filemanagement']);

	if(isset($params['show_thumbfiles']))
		$this->SetPreference('show_thumbfiles', $params['show_thumbfiles']);

	if(isset($params['allow_scaling']))
		$this->SetPreference('allow_scaling', $params['allow_scaling']);

	if(isset($params['scaling_width']))
		$this->SetPreference('scaling_width', $params['scaling_width']);

	if(isset($params['scaling_height']))
		$this->SetPreference('scaling_height', $params['scaling_height']);
	
	if(isset($params['create_thumbs']))
		$this->SetPreference('create_thumbs', $params['create_thumbs']);
	
	if(isset($params['allow_upscaling']))
		$this->SetPreference('force_scaling', $params['force_scaling']);
	
	if(isset($params['force_scaling']))
		$this->SetPreference('allow_upscaling', $params['allow_upscaling']);
	
	if(isset($params['default_admin_theme']))
		$this->SetPreference('default_admin_theme', $params['default_admin_theme']);
	
	if(isset($params['default_frontend_theme']))
		$this->SetPreference('default_frontend_theme', $params['default_frontend_theme']);
	
	if(isset($params['use_mimetype']))
		$this->SetPreference('use_mimetype', $params['use_mimetype']);
	
	if(isset($params['feu_access'])) {
		if(is_array($params['feu_access']))
			$params['feu_access'] = implode(',',$params['feu_access']);
		$this->SetPreference('feu_access', $params['feu_access']);
	}
	
}

if(isset($params['toggle']) && isset($params['display'])) {
	switch($params['toggle']) {
		
		case 'fileoperations':
			if(!$userid = get_userid(false)) {
				if(!session_id()) {
					@session_start();
				}
				$_SESSION['GPFP_fileoperations_display'] = $params['display'];
			}
			else {
				set_preference($userid, 'GBFP_fileoperations_display', intval($params['display']));
			}
			break;
			
		default: break;
	}
}

if(isset($params['ajax']) && $this->IsTrue($params['ajax']))
{
	@ob_end_clean();
	@ob_start();
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	if(isset($params['xml']) && $this->IsTrue($params['xml'])) 
	{
		header('Content-Type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<result><![CDATA[';
	}
	else
	{
		header('Content-type: text/html; charset=utf-8');
	}
	echo '<div class="pagemcontainer"><p class="pagemessage">'.$this->lang('prefs_updated').'</p></div>';
	if(isset($params['xml']) && $this->IsTrue($params['xml'])) 
	{
		echo ']]></result>';
	}
	@ob_end_flush();
	exit;
}
$this->Redirect($id, 'defaultadmin', $returnid, array('message' => 'prefs_updated', 'submit' => true));
?>
