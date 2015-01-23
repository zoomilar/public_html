<?php
#-------------------------------------------------------------------------------
#
# Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
#          a content management tool for CMS Made Simple
#          The projects homepage is http://dev.cmsmadesimple.org/projects/content2/
#          CMS Made Simple is (c) 2004-2013 by Ted Kulp (wishy@cmsmadesimple.org)
#          The projects homepage is: http://www.cmsmadesimple.org
# Version: 0.9.4
# File   : method.uninstall.php
# Purpose: uninstalls the module, removes tables, preferences, permissions...
# License: GPL
#
#-------------------------------------------------------------------------------

if(!is_object(cmsms())) exit;

$db       =& $this->GetDb();
$dict     = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_AdvancedContent_blockdisplay" );
$dict->ExecuteSQLArray($sqlarray);
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_AdvancedContent_messagedisplay" );
$dict->ExecuteSQLArray($sqlarray);
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_AdvancedContent_groupdisplay" );
$dict->ExecuteSQLArray($sqlarray);
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_AdvancedContent_multi_inputs" );
$dict->ExecuteSQLArray($sqlarray);
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_AdvancedContent_multi_input_tpl_assocs" );
$dict->ExecuteSQLArray($sqlarray);

# remove permissions
$this->RemovePermission('Manage AdvancedContent');
$this->RemovePermission('Manage AdvancedContent Preferences');
$this->RemovePermission('Manage All AdvancedContent Blocks');
$this->RemovePermission('Manage AdvancedContent Options');
$this->RemovePermission('Manage AdvancedContent MultiInputs');
$this->RemovePermission('Manage AdvancedContent MultiInput Templates');

$this->RemoveEventHandler( 'Core', 'ContentPostRender');
$this->RemoveEventHandler( 'Core', 'ContentEditPost');

$this->DeleteTemplate();

# remove preferences
$this->RemovePreference();

# restore default content type
$default_contenttype = get_site_preference('default_contenttype','content');
if($default_contenttype == 'content2' || $default_contenttype == 'advanced_content')
	set_site_preference('default_contenttype','content');

$this->Audit( 0, $this->Lang('AdvancedContent'),
	$this->Lang('uninstalled',$this->GetVersion()));

?>
