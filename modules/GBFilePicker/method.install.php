<?php
#-------------------------------------------------------------------------------
#
# Module : GBFilePicker (c) 2010-2012 by Georg Busch (georg.busch@gmx.net)
#          a file picker tool for CMS Made Simple
#          The projects homepage is dev.cmsmadesimple.org/projects/gbfilepicker
#          CMS Made Simple is (c) 2004-2012 by Ted Kulp
#          The projects homepage is: http://www.cmsmadesimple.org
# Version: 1.3.3
# File   : method.install.php
# Purpose: installs the module, creates tables and set preferences
# License: GPL
#
#-------------------------------------------------------------------------------

if(!function_exists('cmsms') || !is_object(cmsms())) exit;
$config = cmsms()->GetConfig();

$this->CreatePermission('Manage GBFilePicker', 'Manage GBFilePicker');
$this->CreatePermission('Use GBFilePicker', 'Use GBFilePicker');

#$this->AddEventHandler( 'Core', 'ContentPostRender', false ); // for frontend usage

$this->SetPreference('restrict_users_diraccess', false);
$this->SetPreference('show_filemanagement', false);
$this->SetPreference('show_thumbfiles', false);
$this->SetPreference('allow_scaling', true);
$this->SetPreference('scaling_width', '');
$this->SetPreference('scaling_height', '');
$this->SetPreference('create_thumbs', true);
$this->SetPreference('allow_upscaling', false);
$this->SetPreference('use_mimetype', false);
$this->SetPreference('feu_access','');

@mkdir(cms_join_path($config['previews_path'] , 'GBFilePickerThumbs'), 0755);

$this->Audit( 0, 'GBFilePicker',
	$this->Lang('installed',$this->GetVersion()));

?>
