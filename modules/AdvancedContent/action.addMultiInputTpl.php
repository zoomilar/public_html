<?php
#-------------------------------------------------------------------------------
#
# Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
#          a content management tool for CMS Made Simple
#          The projects homepage is http://dev.cmsmadesimple.org/projects/content2/
#          CMS Made Simple is (c) 2004-2013 by Ted Kulp (wishy@cmsmadesimple.org)
#          The projects homepage is: http://www.cmsmadesimple.org
# Version: 0.9.4
# File   : action.addMultiInputTpl.php
# Purpose: adds a template for multi input blocktype
# License: GPL
#
#-------------------------------------------------------------------------------

if(!is_object(cmsms())) exit;

if(!$this->CheckPermission('Manage AdvancedContent MultiInput Templates'))
	return $this->DisplayErrorPage($id,$returnid, $this->Lang('error_permissions'));

if(isset($params['cancel']))
	$this->Redirect($id, 'defaultadmin', $returnid, array('active_tab'=>'multi_input_tpl'));

$error = false;
$errormessage = '';

$tpl_name = '';
if(isset($params['tpl_name']) && !empty($params['tpl_name']))
	$tpl_name = preg_replace('/-+/','_',munge_string_to_url(trim($params['tpl_name'])));

$template = '';
if(isset($params['template']))
	$template = trim($params['template']);

### do action ##################################################################

if(isset($params['submit']))
{
	if($tpl_name == '')
	{
		$error = true;
		$errormessage .= $this->lang('error_tpl_name').'<br />';
	}
	if($template == '')
	{
		$error = true;
		$errormessage .= $this->lang('error_template').'<br />';
	}
	if($error==false)
	{
		$this->SetTemplate('multi_input_'.$tpl_name, $template);
		$this->Redirect($id, 'defaultadmin', $returnid, array('message'=>'multi_input_tpl_added',
			'active_tab'=>'multi_input_tpl','submit'=>true));
	}
}

################################################################################

# smarty stuff
$this->smarty->assign('start_form', $this->CreateFormStart($id,
	'addMultiInputTpl', $returnid,'post','multipart/form-data'));
	$this->smarty->assign('end_form', $this->CreateFormEnd());$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit',
	lang('submit')));
$this->smarty->assign('cancel',
	$this->CreateInputSubmit($id,'cancel',lang('cancel')));

$this->smarty->assign('tpl_name_text',$this->lang('tpl_name'));
$this->smarty->assign('tpl_name_input',
	$this->CreateInputText($id,'tpl_name',$tpl_name,64,128));

$this->smarty->assign('template_text',lang('template'));
$this->smarty->assign('template_input',
	$this->CreateTextArea(false,$id,$template,'template','','template'));

$this->smarty->assign('help_text',$this->lang('help_tpl_vars'));

if($error)
	echo $this->ShowErrors($errormessage);

# Display the populated template
echo $this->_pp().$this->ProcessTemplate('addMultiInputTpl.tpl');
?>
