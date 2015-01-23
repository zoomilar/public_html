<?php
#-------------------------------------------------------------------------------
#
# Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
#          a content management tool for CMS Made Simple
#          The projects homepage is http://dev.cmsmadesimple.org/projects/content2/
#          CMS Made Simple is (c) 2004-2013 by Ted Kulp (wishy@cmsmadesimple.org)
#          The projects homepage is: http://www.cmsmadesimple.org
# Version: 0.9.4
# File   : method.install.php
# Purpose: installs the module, creates tables and set preferences
# License: GPL
#
#-------------------------------------------------------------------------------

if(!is_object(cmsms())) exit;

$db =& $this->GetDb();

$taboptarray = array('mysql' => 'TYPE=MyISAM');
$dict        = NewDataDictionary($db);

# User Settings block display
$flds = "user_id I, content_id I, template_id I, item_id X, item_display I";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_AdvancedContent_blockdisplay",
	$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

# User Settings message display
$flds = "user_id I, content_id I, template_id I, item_id X, item_display I";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_AdvancedContent_messagedisplay",
	$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

# User Settings goup display
$flds = "user_id I, content_id I, template_id I, item_id X, item_display I";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_AdvancedContent_groupdisplay",
	$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

# multiple inputs
$flds = "input_id C(64) KEY, input_fields X";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_AdvancedContent_multi_inputs",
	$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

# multiple input tpl assocs
$flds = "input_id C(64), tpl_name X";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_AdvancedContent_multi_input_tpl_assocs",
	$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$this->CreatePermission('Manage AdvancedContent Preferences', 'Manage AdvancedContent Preferences');
$this->CreatePermission('Manage All AdvancedContent Blocks', 'Manage All AdvancedContent Blocks');
$this->CreatePermission('Manage AdvancedContent Options', 'Manage AdvancedContent Options');
$this->CreatePermission('Manage AdvancedContent MultiInputs', 'Manage AdvancedContent MultiInputs');
$this->CreatePermission('Manage AdvancedContent MultiInput Templates', 'Manage AdvancedContent MultiInput Templates');
$this->SetTemplate('multi_input_SampleTemplate',
'<div class="pageoverflow">
<p>
{foreach from=$inputs item=elm}
	{$elm->GetProperty(\'label\')}:&nbsp;{$elm->GetInput()}&nbsp;
{/foreach}
</p>
</div>');
ac_admin_ops::AddMultiInput('SampleInput','
{content block="module_select" label="Select a module" block_type="dropdown" items="|News|Menu" values="|News|MenuManager"}
{content block="module_params" label="Enter module parameters here" block_type="text" oneline=true size="56"}');
ac_admin_ops::AddTplAssoc('multi_input', 'SampleInput', 'multi_input_SampleTemplate');
$this->SetPreference('default_multi_input_tpl', 'multi_input_SampleTemplate');

$this->AddEventHandler( 'Core', 'ContentEditPost', false );

$this->Audit( 0, $this->Lang('AdvancedContent'),
	$this->Lang('installed',$this->GetVersion()));

?>
