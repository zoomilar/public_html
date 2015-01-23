<?php
#-------------------------------------------------------------------------------
#
# Module : GBFilePicker (c) 2010-2012 by Georg Busch (georg.busch@gmx.net)
#          a file picker tool for CMS Made Simple
#          The projects homepage is: dev.cmsmadesimple.org/projects/gbfilepicker
#          CMS Made Simple is (c) 2004-2012 by Ted Kulp
#          The projects homepage is: http://www.cmsmadesimple.org
# Version: 1.3.3
# File   : method.uninstall.php
# Purpose: uninstalls the module, removes tables, preferences, permissions...
# License: GPL
#
#-------------------------------------------------------------------------------

if(!function_exists('cmsms') || !is_object(cmsms())) exit;
$config = cmsms()->GetConfig();

// remove permissions
$this->RemovePermission('Manage GBFilePicker');
$this->RemovePermission('Use GBFilePicker');

$this->RemovePermission('Add GBFilePicker Templates');
$this->RemovePermission('Delete GBFilePicker Templates');
$this->RemovePermission('Edit GBFilePicker Templates');

// remove preferences
$this->RemovePreference();
$this->DeleteTemplate();

$this->Audit( 0, 'GBFilePicker',
	$this->Lang('uninstalled',$this->GetVersion()));

?>
