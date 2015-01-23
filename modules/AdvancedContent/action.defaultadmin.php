<?php
#-------------------------------------------------------------------------------
#
# Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
#          a content management tool for CMS Made Simple
#          The projects homepage is dev.cmsmadesimple.org/projects/content2/
#          CMS Made Simple is (c) 2004-2013 by Ted Kulp
#          The projects homepage is: cmsmadesimple.org
# Version: 0.9.4
# File   : action.defaultadmin.php
# Purpose: performs the default backend action if "Extensions->AdvancedContent"
#          is selected
# License: GPL
#
#-------------------------------------------------------------------------------

if(!is_object(cmsms())) exit;

if(!$this->CheckPermission('Manage AdvancedContent Preferences') 
	&& !$this->CheckPermission('Manage AdvancedContent MultiInputs') 
	&& !$this->CheckPermission('Manage AdvancedContent MultiInput Templates'))
{
	return $this->DisplayErrorPage($id,$returnid, $this->Lang('error_permissions'));
}
$active_tab = 'prefs';
if(isset($params['active_tab']))
	$active_tab = $params['active_tab'];

$errormessage = '';
if(isset($params['errormessage']))
	$errormessage .= $params['errormessage'].'<br />';

$message = '';
if(isset($params['message']))
	$message .= $params['message'].'<br />';

$tabs = array();

if($this->CheckPermission('Manage AdvancedContent Preferences'))
{
	$tabs['prefs']['tabheader'] = $this->SetTabHeader('prefs',
		$this->lang('prefs'),
		($active_tab=='prefs'?true:''));
	
	$this->smarty->assign('startform', $this->CreateFormStart($id,
		'savePrefs', $returnid,'post','multipart/form-data'));
	$this->smarty->assign('endform', $this->CreateFormEnd());
	
	#$this->smarty->assign('set_content_type_input1',
	#	$this->CreateLink($id, 'set_content_type', $returnid,
	#		cmsms()->variables['admintheme']->DisplayImage('icons/system/import.gif', '','','','systemicon') .
	#		'&nbsp;' . $this->lang('set_content_type', lang('content'),$this->lang('AdvancedContent')),
	#		array('old_type'=>'content','new_type'=>'advanced_content'),
	#		'',
	#		false,
	#		false,
	#		'class="AdvancedContent_AJAX" onclick="if(confirm(\''.
	#			$this->lang('confirm_setcontenttype',lang('content'),$this->lang('AdvancedContent')) .
	#			'\')) {AdvancedContent.setContentType(this.href);} return false;"'));
	#
	#$this->smarty->assign('set_content_type_input2',
	#	$this->CreateLink($id, 'set_content_type', '',
	#		cmsms()->variables['admintheme']->DisplayImage('icons/system/import.gif', '','','','systemicon') .
	#		'&nbsp;' . $this->lang('set_content_type', $this->lang('AdvancedContent'),lang('content')),
	#		array('old_type'=>'advanced_content','new_type'=>'content'),
	#		'',
	#		false,
	#		false,
	#		'class="AdvancedContent_AJAX" onclick="if(confirm(\''.
	#			$this->lang('confirm_setcontenttype',$this->lang('AdvancedContent'),lang('content')) .
	#			'\')) {AdvancedContent.setContentType(this.href);} return false;"'));
	#
	#$this->smarty->assign('uninstallaction_text', $this->lang('uninstallaction'));
	#
	#$this->smarty->assign('uninstallaction_input',
	#	$this->CreateInputHidden($id,'uninstall_action', 0) .
	#	$this->CreateInputCheckbox($id, 'uninstall_action', 1,
	#		$this->GetPreference('uninstall_action', 0)) . 
	#	$this->lang('setcontent1'));
	
	$this->smarty->assign('hide_deprecated_text',
		$this->lang('hide_deprecated'));
	$this->smarty->assign('hide_deprecated_input',
		$this->CreateInputHidden($id,'hide_deprecated',0) .
		$this->CreateInputCheckbox($id, 'hide_deprecated', 1,
			$this->GetPreference('hide_deprecated',0)));
	
	$actions = array($this->lang('per_page')=>'content',
		$this->lang('per_template')=>'template',
		$this->lang('both1')=>'both1',
		$this->lang('both2')=>'both2');
	
	$this->smarty->assign('block_display_settings_text',
		$this->lang('save_collapse_status', $this->lang('content_blocks')));
	$this->smarty->assign('block_display_settings_input',
		$this->CreateInputDropdown($id, 'block_display_settings', $actions, '',
			$this->GetPreference('block_display_settings')));
	
	$this->smarty->assign('collapse_block_default_text',
		$this->lang('collapse_default',$this->lang('content_blocks')));
	$this->smarty->assign('collapse_block_default_input',
		$this->CreateInputHidden($id,'collapse_block_default',0) .
		$this->CreateInputCheckbox($id, 'collapse_block_default', 1,
			$this->GetPreference('collapse_block_default',1)));
	
	$this->smarty->assign('message_display_settings_text',
		$this->lang('save_collapse_status', $this->lang('block_message')));
	$this->smarty->assign('message_display_settings_input',
		$this->CreateInputDropdown($id, 'message_display_settings', $actions, '',
			$this->GetPreference('message_display_settings')));
	
	$this->smarty->assign('group_display_settings_text',
		$this->lang('save_collapse_status', $this->lang('block_groups')));
	$this->smarty->assign('group_display_settings_input',
		$this->CreateInputDropdown($id, 'group_display_settings', $actions, '',
			$this->GetPreference('group_display_settings')));
	
	$this->smarty->assign('collapse_group_default_text',
		$this->lang('collapse_default',$this->lang('block_groups')));
	$this->smarty->assign('collapse_group_default_input',
		$this->CreateInputHidden($id,'collapse_group_default',0) .
		$this->CreateInputCheckbox($id, 'collapse_group_default', 1,
			$this->GetPreference('collapse_group_default',1)));
	
	$this->smarty->assign('use_advanced_pageoptions_text',
		$this->lang('show_advancedcontent_options'));
	$this->smarty->assign('use_advanced_pageoptions_input',
		$this->CreateInputHidden($id,'use_advanced_pageoptions',0) .
		$this->CreateInputCheckbox($id, 'use_advanced_pageoptions', 1,
			$this->GetPreference('use_advanced_pageoptions',0),
			'id="ac_use_advanced_pageoptions"'));
	
	$this->smarty->assign('use_advanced_pageoptions', $this->GetPreference('use_advanced_pageoptions',0));
	# default advanced pageoptions
	
	$this->smarty->assign('contentsettings_text', $this->lang('contentsettings'));
	
	$this->smarty->assign('use_expire_date_text', $this->lang('useexpiredate'));
	$useExp = $this->GetPreference('use_expire_date');
	$this->smarty->assign('use_expire_date_input',
		$this->CreateInputDropdown($id,'use_expire_date',
			array($this->lang('yes')=>1,
				$this->lang('no')=>0,
				$this->lang('inherit_from_parent')=>-1),
			0,$useExp));
	
	$times = array();
	$times[$this->lang('minutes')] = 'minute';
	$times[$this->lang('hours')]   = 'hour';
	$times[$this->lang('days')]    = 'day';
	$times[$this->lang('weeks')]   = 'week';
	$times[$this->lang('months')]  = 'month';
	$times[$this->lang('years')]   = 'year'; 
	
	$start_date = explode(' ', $this->GetPreference("start_date", '1 week'));
	$end_date   = explode(' ', $this->GetPreference("end_date", '1 week'));
	$this->smarty->assign('start_date_text', $this->lang('startdate'));
	$this->smarty->assign('start_date_input',
		$this->CreateInputText($id, 'AdvancedContentStartDate', $start_date[0], 3, 5) .
		$this->CreateInputDropdown($id, 'AdvancedContentStartTime', $times,'', $start_date[1]) . 
		'&nbsp;' . $this->lang('aftercurrdate'));
	
	$this->smarty->assign('end_date_text', $this->lang('enddate'));
	$this->smarty->assign('end_date_input',
		$this->CreateInputText($id, 'AdvancedContentEndDate', $end_date[0], 3, 5) . 
		$this->CreateInputDropdown($id, 'AdvancedContentEndTime', $times, '', $end_date[1]) . 
		'&nbsp;' . $this->lang('afterstartdate'));
	
	if( $feusers =& $this->GetModuleInstance('FrontEndUsers' ))
	{
		$this->smarty->assign('feuaccess_text', $this->lang('frontendaccess'));
		$feuAccess      = array($this->lang('inherit_from_parent')=>-1);
		$feuAccess      = array_merge($feuAccess,$feusers->GetGroupList());
		$selectedGroups = $this->GetPreference('feu_access');
		$delim          = strpos($selectedGroups,',') === FALSE ? ';' : ',';
		$selectedGroups = ac_utils::CleanArray(explode($delim,$selectedGroups));
		
		$this->smarty->assign('feuaccess_input',
			$this->CreateInputHidden($id,'feu_access','').
			$this->CreateInputSelectList($id,'feu_access[]',$feuAccess,
				$selectedGroups, count($feuAccess),!$this->GetPreference('use_advanced_pageoptions',0) ? 'disabled="disabled"' : '',1));
		
		$this->smarty->assign('redirectpage_text', $this->lang('redirectpage'));
		$this->smarty->assign('redirectpage_input',
			ac_admin_ops::CreateRedirectDropdown($id,'redirect_page',
				$this->GetPreference('redirect_page')));
		
		$this->smarty->assign('inherit_text', $this->lang('inherit_from_parent'));
		$this->smarty->assign('redirectparams_text', $this->lang('redirectparams'));
		$this->smarty->assign('evaluatesmarty_text', $this->lang('evaluatesmarty'));
		
		$inheritParams = $this->GetPreference('inherit_feu_params',0);
		$this->smarty->assign('inherit_feu_params_input',
			$this->CreateInputHidden($id,'inherit_feu_params',0) .
			$this->CreateInputCheckbox($id, 'inherit_feu_params', 1,
				$inheritParams, !$this->GetPreference('use_advanced_pageoptions',0) ? 'disabled="disabled"' : ''));
		
		$this->smarty->assign('feu_params_text', $this->lang('feu_params'));
		$this->smarty->assign('feu_params_input',
			$this->CreateInputText($id, 'feu_params', 
				$this->GetPreference('feu_params'), 32, 128,!$this->GetPreference('use_advanced_pageoptions',0) ? 'disabled="disabled"' : ''));
		
		$this->smarty->assign('feu_params_smarty_text', $this->lang('feu_params_smarty'));
		$this->smarty->assign('feu_params_smarty_input',
			$this->CreateInputHidden($id,'feu_params_smarty',0) .
			$this->CreateInputCheckbox($id, 'feu_params_smarty', 1,
				$this->GetPreference('feu_params_smarty'),!$this->GetPreference('use_advanced_pageoptions',0) ? 'disabled="disabled"' : ''));
		
		$inheritParams = $this->GetPreference('inherit_custom_params',0);
		$this->smarty->assign('inherit_custom_params_input',
			$this->CreateInputHidden($id,'inherit_custom_params',0) .
			$this->CreateInputCheckbox($id, 'inherit_custom_params', 1,
				$inheritParams, !$this->GetPreference('use_advanced_pageoptions',0) ? 'disabled="disabled"' : ''));
		
		$this->smarty->assign('custom_params_text', $this->lang('custom_params'));
		$this->smarty->assign('custom_params_input',
			$this->CreateInputText($id, 'custom_params', 
				$this->GetPreference('custom_params'), 32, 128,!$this->GetPreference('use_advanced_pageoptions',0) ? 'disabled="disabled"' : ''));
		
		$this->smarty->assign('custom_params_smarty_text', $this->lang('custom_params_smarty'));
		$this->smarty->assign('custom_params_smarty_input',
			$this->CreateInputHidden($id,'custom_params_smarty',0) .
			$this->CreateInputCheckbox($id, 'custom_params_smarty', 1,
				$this->GetPreference('custom_params_smarty'),!$this->GetPreference('use_advanced_pageoptions',0) ? 'disabled="disabled"' : ''));
		
		$this->smarty->assign('feuaction_text', $this->lang('showloginform'));
		$this->smarty->assign('feuaction_input',
			$this->CreateInputDropdown($id,'feu_action',
				array($this->lang('yes')=>1,
					$this->lang('no')=>0,
					$this->lang('inherit_from_parent')=>-1),
				0,$this->GetPreference('feu_action',1),!$this->GetPreference('use_advanced_pageoptions',0) ? 'disabled="disabled"' : ''));
		
		$this->smarty->assign('hide_menu_item_text',
			$this->lang('hide_menu_item'));
		$this->smarty->assign('hide_menu_item_input',
			$this->CreateInputDropdown($id,'hide_menu_item',
				array($this->lang('no')=>0,
					$this->lang('loggedout')=>1,
					$this->lang('loggedin')=>2,
					$this->lang('inherit_from_parent')=>-1),
				0,$this->GetPreference('hide_menu_item',0),!$this->GetPreference('use_advanced_pageoptions',0) ? 'disabled="disabled"' : ''));
	}
	#---
	$this->smarty->assign('submit_prefs', $this->CreateInputSubmit($id, 'submit_prefs',
		lang('submit'),'onclick="return AdvancedContent.submitForm(this,\'AdvancedContentResult\')"'));
	
	$tabs['prefs']['tabcontent'] = $this->StartTab('prefs') .
		$this->ProcessTemplate('prefsTab.tpl') .
		$this->EndTab();
}

if($this->CheckPermission('Manage AdvancedContent MultiInputs'))
{
	$tabs['multi_input']['tabheader'] = $this->SetTabHeader('multi_input',
		$this->lang('multi_input'),
		($active_tab=='multi_input'?true:''));
	
	$multi_inputs = array();
	foreach(ac_admin_ops::GetMultiInputList() as $multi_input)
	{
		$multi_inputs[$multi_input['input_id']]['edit_link'] = $this->CreateLink($id, 'editMultiInput', $returnid,
			cmsms()->variables['admintheme']->DisplayImage('icons/system/edit.gif', '','','','systemicon'), array('input_id'=>$multi_input['input_id']));
		
		$multi_inputs[$multi_input['input_id']]['name_link'] = $this->CreateLink($id, 'editMultiInput', $returnid, $multi_input['input_id'], array('input_id'=>$multi_input['input_id']));
		
		$multi_inputs[$multi_input['input_id']]['template'] = substr($multi_input['tpl_name'],strlen('multi_input_'));
		
		$multi_inputs[$multi_input['input_id']]['delete_link'] = $this->CreateLink($id, 'deleteMultiInput', $returnid,
			cmsms()->variables['admintheme']->DisplayImage('icons/system/delete.gif', '','','','systemicon'),
			array('input_id'=>$multi_input['input_id']),$this->lang('confirm_delete'));
		
		$multi_inputs[$multi_input['input_id']]['checkbox'] = $this->CreateInputCheckbox($id,
			"multi_input-".$multi_input['input_id'], $multi_input['input_id'], '');
	}
	$this->smarty->assign('selectall',
		$this->CreateInputCheckbox($id,'multi_input',true,false, 'id="'.$id.'multi_input" onclick="AdvancedContent.selectAll(this)"'));
	
	$this->smarty->assign_by_ref('multi_input_array',$multi_inputs);
	$this->smarty->assign('add_multi_input',
		$this->CreateLink($id, 'addMultiInput', $returnid,
			cmsms()->variables['admintheme']->DisplayImage('icons/system/newobject.gif', '','','','systemicon') .
			'&nbsp;' . $this->lang('add_multi_input')));
	$this->smarty->assign('start_form', $this->CreateFormStart($id,
		'deleteMultiInput', $returnid,'post','multipart/form-data'));
	$this->smarty->assign('end_form', $this->CreateFormEnd());
	$this->smarty->assign('submit_bulkaction', $this->CreateInputSubmit($id, 'submit_bulkaction',$this->lang('delete_selected'),'','',$this->lang('confirm_delete_selected')));
	$this->smarty->assign('input_id_text', $this->lang('input_id'));
	$this->smarty->assign('template_text', lang('template'));
	$tabs['multi_input']['tabcontent'] = $this->StartTab('multi_input') .
		$this->ProcessTemplate('multiInputTab.tpl') .
		$this->EndTab();
}

if($this->CheckPermission('Manage AdvancedContent MultiInput Templates'))
{
	$tabs['multi_input_tpl']['tabheader'] = $this->SetTabHeader('multi_input_tpl',
		$this->lang('multi_input_tpl'),
		($active_tab=='multi_input_tpl'?true:''));
	
	$multi_input_tpls = array();
	foreach(ac_admin_ops::GetTemplates('multi_input') as $tpl)
	{
		$multi_input_tpls[$tpl['tpl_id']]['edit_link'] = $this->CreateLink($id, 'editMultiInputTpl', $returnid,
			cmsms()->variables['admintheme']->DisplayImage('icons/system/edit.gif', '','','','systemicon'),
			array('tpl_id'=>$tpl['tpl_id']));
		
		$multi_input_tpls[$tpl['tpl_id']]['name_link'] = $this->CreateLink($id, 'editMultiInputTpl', $returnid,
			$tpl['tpl_name'],
			array('tpl_id'=>$tpl['tpl_id']));
		
		$multi_input_tpls[$tpl['tpl_id']]['delete_link'] = '&nbsp;';
		$multi_input_tpls[$tpl['tpl_id']]['checkbox'] = '&nbsp';
		if($this->GetPreference('default_multi_input_tpl','multi_input_SampleTemplate') != $tpl['tpl_id'] && !$tpl['is_used'])
		{
			$multi_input_tpls[$tpl['tpl_id']]['delete_link'] = $this->CreateLink($id,
				'deleteMultiInputTpl', $returnid, cmsms()->variables['admintheme']->DisplayImage('icons/system/delete.gif', '','','','systemicon'),
				array('tpl_id'=>$tpl['tpl_id']),$this->lang('confirm_delete'));
			$multi_input_tpls[$tpl['tpl_id']]['checkbox'] = $this->CreateInputCheckbox($id,
				"multi_input_tpl-".$tpl['tpl_id'], $tpl['tpl_id'], '');
		}
		
		if($this->GetPreference('default_multi_input_tpl','multi_input_SampleTemplate') != $tpl['tpl_id'])
		{
			$multi_input_tpls[$tpl['tpl_id']]['set_default_link'] = $this->CreateLink($id, 'savePrefs', $returnid,
				cmsms()->variables['admintheme']->DisplayImage('icons/system/false.gif', '','','','systemicon'),
				array('set_default'=>'multi_input','tpl_id'=>$tpl['tpl_id'],'active_tab'=>'multi_input_tpl'));
		}
		else
			$multi_input_tpls[$tpl['tpl_id']]['set_default_link'] = cmsms()->variables['admintheme']->DisplayImage('icons/system/true.gif', '','','','systemicon');
	}
	$this->smarty->assign('selectall',
		$this->CreateInputCheckbox($id,'multi_input_tpl',true,false, 'id="'.$id.'multi_input_tpl" onclick="AdvancedContent.selectAll(this)"'));
	
	$this->smarty->assign_by_ref('multi_input_tpl_array',$multi_input_tpls);
	$this->smarty->assign('add_multi_input_tpl',
		$this->CreateLink($id, 'addMultiInputTpl', $returnid,
			cmsms()->variables['admintheme']->DisplayImage('icons/system/newobject.gif', '','','','systemicon') .
			'&nbsp;' . $this->lang('add_multi_input_tpl')));
	
	$this->smarty->assign('submit_bulkaction', $this->CreateInputSubmit($id, 'submit_bulkaction',$this->lang('delete_selected'),'','',$this->lang('confirm_delete_selected')));
	$this->smarty->assign('template_name_text', lang('template'));
	
	$this->smarty->assign('start_form', $this->CreateFormStart($id,
		'deleteMultiInputTpl', $returnid,'post','multipart/form-data'));
	$this->smarty->assign('end_form', $this->CreateFormEnd());
	
	$tabs['multi_input_tpl']['tabcontent'] = $this->StartTab('multi_input_tpl') .
		$this->ProcessTemplate('multiInputTplTab.tpl') .
		$this->EndTab();
}

$this->smarty->assign_by_ref('tabs',$tabs);
$this->smarty->assign('start_tabheaders',$this->StartTabHeaders());
$this->smarty->assign('end_tabheaders',$this->EndTabHeaders());
$this->smarty->assign('start_tabcontent',$this->StartTabContent());
$this->smarty->assign('end_tabcontent',$this->EndTabContent());
$this->smarty->assign('end_tab',$this->EndTab());
$this->smarty->assign('moduleId', $id);

$this->smarty->assign('locale', substr(get_preference(get_userid(),'default_cms_language'), 0, 2));


if(isset($params['message']))
	echo $this->ShowMessage($this->lang($params['message'], (isset($params['old_type']) && isset($params['new_type']) ? $this->lang($params['old_type']) . ',' . $this->lang($params['new_type']) : '')));
	#$this->smarty->assign('message', $this->lang($params['message'], (isset($params['old_type']) && isset($params['new_type']) ? $this->lang($params['old_type']) . ',' . $this->lang($params['new_type']) : '')));

if(isset($params['errormessage']))
	echo $this->ShowErrors($this->lang($params['errormessage'], (isset($params['old_type']) && isset($params['new_type']) ? $this->lang($params['old_type']) . ',' . $this->lang($params['new_type']) : '')));
	#$this->smarty->assign('errormessage', $this->lang($params['errormessage'], (isset($params['old_type']) && isset($params['new_type']) ? $this->lang($params['old_type']) . ',' . $this->lang($params['new_type']) : '')));

echo $this->_pp().$this->ProcessTemplate('defaultadmin.tpl');

?>
