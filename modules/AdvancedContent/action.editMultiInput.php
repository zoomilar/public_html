<?php
#-------------------------------------------------------------------------------
#
# Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
#          a content management tool for CMS Made Simple
#          The projects homepage is http://dev.cmsmadesimple.org/projects/content2/
#          CMS Made Simple is (c) 2004-2013 by Ted Kulp (wishy@cmsmadesimple.org)
#          The projects homepage is: http://www.cmsmadesimple.org
# Version: 0.9.4
# File   : action.editMultiInput.php
# Purpose: edits a multi input blocktype
# License: GPL
#
#-------------------------------------------------------------------------------

if(!is_object(cmsms())) exit;

if(!$this->CheckPermission('Manage AdvancedContent MultiInputs'))
	return $this->DisplayErrorPage($id,$returnid, $this->Lang('error_permissions'));

if(isset($params['cancel']))
	$this->Redirect($id, 'defaultadmin', $returnid, array('active_tab'=>'multi_input'));

$error = false;
$errormessage = '';

$input_id = '';
if(isset($params['input_id']) && !empty($params['input_id']))
	$input_id = preg_replace('/-+/','_',munge_string_to_url(trim($params['input_id'])));

$multi_input = ac_admin_ops::GetMultiInputFull($input_id);

if(isset($params['input_fields']))
	$multi_input[$input_id]['input_fields'] = trim($params['input_fields']);
if(isset($params['input_tpl']))
	$multi_input[$input_id]['tpl_name'] = $params['input_tpl'];

### do action ##################################################################

if(isset($params['submit']))
{
	if($input_id == '')
	{
		$error = true;
		$errormessage .= $this->lang('error_input_id').'<br />';
	}
	if($multi_input[$input_id]['input_fields'] == '')
	{
		$error = true;
		$errormessage .= $this->lang('error_input_fields').'<br />';
	}

	if($error==false)
	{
		if(!ac_admin_ops::UpdateMultiInput($input_id,$multi_input[$input_id]['input_fields']))
		{
			$error = true;
			$errormessage .= $this->lang('error_updating_multi_input').'<br />';
		}
		else if(!ac_admin_ops::UpdateTplAssoc('multi_input',$input_id,$multi_input[$input_id]['tpl_name']))
		{
			$error = true;
			$errormessage .= $this->lang('error_updating_multi_input_assocs').'<br />';
		}
		else
		{
			$this->Redirect($id, 'defaultadmin', $returnid, array('message'=>'multi_input_updated',
				'active_tab'=>'multi_input','submit'=>true));
		}
	}

}

################################################################################

# smarty stuff
$this->smarty->assign('start_form', $this->CreateFormStart($id,
	'editMultiInput', $returnid,'post','multipart/form-data'));
	$this->smarty->assign('end_form', $this->CreateFormEnd());$this->smarty->assign('submit', $this->CreateInputSubmit($id, 'submit',
	lang('submit')));
$this->smarty->assign('cancel',
	$this->CreateInputSubmit($id,'cancel',lang('cancel')));

$this->smarty->assign('input_id_text',$this->lang('input_id'));
$this->smarty->assign('input_id_input',$input_id);

$this->smarty->assign('input_tpl_text',$this->lang('multi_input_tpl'));
$this->smarty->assign('input_tpl_input',
		$this->CreateInputDropdown($id, 'input_tpl', ac_admin_ops::GetTplList('multi_input'), '', $multi_input[$input_id]['tpl_name']));

$this->smarty->assign('input_fields_text',$this->lang('input_fields'));
$this->smarty->assign('input_fields_input',
	$this->CreateTextArea(false,$id,$multi_input[$input_id]['input_fields'],'input_fields','','input_fields').
	$this->CreateInputHidden($id, 'input_id',$input_id));

if($error)
	echo $this->ShowErrors($errormessage);

# Display the populated template
echo $this->_pp().$this->ProcessTemplate('addMultiInput.tpl');
?>
