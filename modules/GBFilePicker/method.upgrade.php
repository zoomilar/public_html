<?php
#-------------------------------------------------------------------------------
#
# Module : GBFilePicker (c) 2010-2012 by Georg Busch (georg.busch@gmx.net)
#          a file picker tool for CMS Made Simple
#          The projects homepage is: dev.cmsmadesimple.org/projects/gbfilepicker
#          CMS Made Simple is (c) 2004-2012 by Ted Kulp
#          The projects homepage is: http://www.cmsmadesimple.org
# Version: 1.3.3
# File   : method.upgrade.php
# Purpose: performs a module upgrade
# License: GPL
#
#-------------------------------------------------------------------------------

if(!function_exists('cmsms') || !is_object(cmsms())) exit;

$current_version = $oldversion;

switch($current_version) {
	case '1':
		$this->SetPreference('restrict_users_diraccess', false);
		$this->SetPreference('show_filemanagement', true);
		$this->SetPreference('show_thumbfiles', false);
		$this->SetPreference('allow_scaling', true);
		$this->SetPreference('scaling_width', '');
		$this->SetPreference('scaling_height', '');
		$this->SetPreference('create_thumbs', true);
		$this->SetPreference('allow_upscaling', false);
		$this->SetPreference('use_mimetype', false);
		$this->SetPreference('feu_access','');
		
		$current_version = '1.1';
		
	case '1.1':
		$config = cmsms()->GetConfig();
		@mkdir(cms_join_path($config['previews_path'] , 'GBFilePickerThumbs'), 0755);
		
		$current_version = '1.2';
	
	case '1.2':
		$current_version = '1.3';
		
	case '1.3':
		$current_version = '1.3.1';
	
	case '1.3.1':
		if($this->GetPreference('default_admin_theme','Default-AJAX') == 'Default (AJAX)')
			$this->SetPreference('default_admin_theme','Default-AJAX');
		$current_version = '1.3.2';
}

$oldversion = $current_version;

?>
