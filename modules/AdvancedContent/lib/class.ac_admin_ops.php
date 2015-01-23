<?php
/**
 * @package AdvancedContent
 * @category CMSModuleContentType
 * @license GPL
 * @author Georg Busch (NaN)
 * @copyright 2010-2013 Georg Busch (NaN)
 * @since 0.9.3
 * @internal
 * @access private
 */
final class ac_admin_ops
{
	private static $_variables = array(
		'display_settings' => array(),
		'tab_ids'          => array(),
		'page_tabs'        => array(),
		'block_tabs'       => array(),
		'block_groups'     => array(),
		'block_types'      => array(),
		'admin_groups'     => null,
		'all_admin_users'  => null,
		'all_admin_groups' => null 
	);
	
	# ToDo: is this needed?
	private static $_attribs = array(
		'feu_access',
		'redirect_page',
		'feu_action',
		'start_date',
		'end_date',
		'use_expire_date',
		'hide_menu_item',
		'inherit_redirect_params',
		'feu_params',
		'inherit_feu_params',
		'feu_params_smarty',
		'custom_params',
		'inherit_custom_params',
		'custom_params_smarty'
	);
	
	private function __construct() {}
	private function __clone() {}
	
	public static function GetPages()
	{
		$db =& cmsms()->GetDb();
		$query = "SELECT C.active, C.type, C.content_id, C.parent_id, C.hierarchy, C.menu_text, CP.content FROM " . cms_db_prefix() . "content C
			LEFT JOIN " . cms_db_prefix() . "content_props CP ON CP.content_id = C.content_id AND CP.prop_name = ?
			ORDER BY hierarchy";
		$dbresult = $db->Execute($query, array('redirect_page'));
		if(!$pages = $dbresult->GetArray())
			return array();
		return $pages;
	}
	
	public static function CreateRedirectDropdown($id = '', $name = 'redirect_page', $selectedPage = '', $currentPage = '', $add_txt = '')
	{
		$AC         =& ac_utils::get_module('AdvancedContent');
		$pages      = self::GetPages();
		$dropdown   = '<select class="cms_dropdown" name="'.$id.$name.'" '.($add_txt != '' ? $add_txt: '').(!$AC->GetPreference('use_advanced_pageoptions',0) ? ' disabled="disabled"' : '') .'>';
		$dropdown  .= '<option value=""' . ($selectedPage == ''?' selected="selected"':'') . '>' . $AC->lang('hide_content') . '</option>';
		$dropdown  .= '<option value="-1"' . ($selectedPage == -1?' selected="selected"':'') . '>' . $AC->lang('inherit_from_parent') . '</option>';
		if(count($pages))
		{
			$dropdown  .= '<optgroup label="------------------------------------">';
			$contentops =& cmsms()->GetContentOperations();
			foreach($pages as $page)
			{
				$page['content'] = ($page['content'] < 0 ? ac_utils::InheritParentProp($page['content_id'], $page['parent_id'], 'redirect_page') : $page['content']);
				$disabled = '';
				$indent   = '';
				foreach(explode('.',$page['hierarchy']) as $v)
				{
					$indent .= '&nbsp;&nbsp;&nbsp;';
				}
				# don't redirect to pages with no public access, invalid content type, inactive or same content id
				if($page['active'] != 1 || $page['content']<>0 || $page['content_id'] == $currentPage || ($page['type'] != 'content' && $page['type'] != 'advanced_content'))
				{
					$disabled = ' disabled="disabled"';
				}
				$dropdown .= '<option'. $disabled .' value="' . $page['content_id'] . '" ' .
					($selectedPage == $page['content_id'] && $disabled == ''?'selected="selected"':'') . '>' . $indent . 
					$contentops->CreateFriendlyHierarchyPosition($page['hierarchy']) .
					' - ' . $page['menu_text'] . ($disabled != ''?' (' . $AC->lang('invalid') . ')':'') . '</option>';
			}
			$dropdown  .= '</optgroup>';
		}
		$dropdown .= '</select>';
		return $dropdown;
	}
	
	public static function SetVisibility($item_type, $item_id, $content_id, $template_id, $display)
	{
		$AC    =& ac_utils::get_module('AdvancedContent');
		$db    =& cmsms()->GetDb();
		$query =  "SELECT item_display FROM ". cms_db_prefix() . "module_AdvancedContent_".$item_type."display
			WHERE user_id = ? AND item_id = ? AND ";
		
		$q = array();
		$p = array(get_userid(), $item_id);
		
		if($content_id
		&& ($AC->GetPreference($item_type.'_display_settings','content') == 'content'
		|| $AC->GetPreference($item_type.'_display_settings','content') == 'both1'
		|| $AC->GetPreference($item_type.'_display_settings','content') == 'both2'))
		{
			$q[] = "content_id = ?";
			$p[] = $content_id;
		}
		
		if($template_id > 0
		&& ($AC->GetPreference($item_type.'_display_settings','content') == 'template'
		|| $AC->GetPreference($item_type.'_display_settings','content') == 'both1'
		|| $AC->GetPreference($item_type.'_display_settings','content') == 'both2'))
		{
			$q[] = "template_id = ?";
			$p[] = $template_id;
		}
		
		if(!count($q)) {
			return;
		}
		
		if($AC->GetPreference($item_type.'_display_settings','content') == 'both1')
		{
			$query .= "(" . implode(" OR ",$q) . ")";
		}
		else if($AC->GetPreference($item_type.'_display_settings','content') == 'both2')
		{
			$query .= "(" . implode(" AND ",$q) . ")";
		}
		else
		{
			$query .= $q[0];
		}
		
		$dbresult = $db->Execute($query, $p);
		if($dbresult && $row = $dbresult->FetchRow()) {
			#echo $display;
			array_unshift($p,$display);
			$query = "UPDATE ". cms_db_prefix() . "module_AdvancedContent_".$item_type."display
				SET item_display = ? WHERE user_id = ? AND item_id = ? AND ".implode(' AND ',$q);
			$dbresult = $db->Execute($query, $p);
		}
		else
		{
			$query = "INSERT INTO ". cms_db_prefix() ."module_AdvancedContent_".$item_type."display
				(user_id, content_id, template_id, item_id, item_display) VALUES (?,?,?,?,?)";
			$dbresult = $db->Execute($query, array(get_userid(), $content_id, $template_id, $item_id, $display));
		}
		self::$_variables['display_settings'][$item_type][implode('_',array($content_id,$template_id))][$item_id] = $display;
	}
	
	public static function GetVisibility($item_type, $item_id, $content_id, $template_id, $default_value = 1)
	{
		$ids =  array();
		$AC  =& ac_utils::get_module('AdvancedContent');
		
		if($content_id
		&& ($AC->GetPreference($item_type.'_display_settings','content') == 'content'
		|| $AC->GetPreference($item_type.'_display_settings','content') == 'both1'
		|| $AC->GetPreference($item_type.'_display_settings','content') == 'both2'))
		{
			$ids[] = $content_id;
		}
		
		if($template_id > 0
		&& ($AC->GetPreference($item_type.'_display_settings','content') == 'template'
		|| $AC->GetPreference($item_type.'_display_settings','content') == 'both1'
		|| $AC->GetPreference($item_type.'_display_settings','content') == 'both2'))
		{
			$ids[] = $template_id;
		}
		
		if(!count($ids))
		{
			return $default_value;
		}
		
		if(!isset(self::$_variables['display_settings'][$item_type][implode('_',$ids)]))
		{
			self::_load_visibilities($item_type, $content_id, $template_id);
		}
		if(!isset(self::$_variables['display_settings'][$item_type][implode('_',$ids)][$item_id]))
		{
			self::$_variables['display_settings'][$item_type][implode('_',$ids)][$item_id] = $default_value;
		}
		return self::$_variables['display_settings'][$item_type][implode('_',$ids)][$item_id];
	}
	
	private static function _load_visibilities($item_type, $content_id, $template_id)
	{
		$AC =& ac_utils::get_module('AdvancedContent');
		$db =& cmsms()->GetDb();
		$query = "SELECT * FROM ". cms_db_prefix() . "module_AdvancedContent_".$item_type."display
			WHERE user_id = ? AND ";
		
		$q = array();
		$p = array(get_userid());
		
		if($content_id
		&& ($AC->GetPreference($item_type.'_display_settings','content') == 'content'
		|| $AC->GetPreference($item_type.'_display_settings','content') == 'both1'
		|| $AC->GetPreference($item_type.'_display_settings','content') == 'both2'))
		{
			$q[] = "content_id = ?";
			$p[] = $content_id;
		}
		
		if($template_id > 0
		&& ($AC->GetPreference($item_type.'_display_settings','content') == 'template'
		|| $AC->GetPreference($item_type.'_display_settings','content') == 'both1'
		|| $AC->GetPreference($item_type.'_display_settings','content') == 'both2'))
		{
			$q[] = "template_id = ?";
			$p[] = $template_id;
		}
		
		if(!count($q))
		{
			return;
		}
		
		if($AC->GetPreference($item_type.'_display_settings','content') == 'both1')
		{
			$query .= "(" . implode(" OR ",$q) . ")";
		}
		else if($AC->GetPreference($item_type.'_display_settings','content') == 'both2')
		{
			$query .= "(" . implode(" AND ",$q) . ")";
		}
		else
		{
			$query .= $q[0];
		}
		$dbresult = $db->Execute($query, $p);
		while($dbresult && $row = $dbresult->FetchRow())
		{
			if($AC->GetPreference($item_type.'_display_settings','content') == 'both1'
			|| $AC->GetPreference($item_type.'_display_settings','content') == 'both2')
			{
				self::$_variables['display_settings'][$item_type][$row['content_id'] . '_' . $row['template_id']][$row['item_id']] = $row['item_display'];
			}
			else
			{
				self::$_variables['display_settings'][$item_type][$row[$AC->GetPreference($item_type.'_display_settings','content').'_id']][$row['item_id']] = $row['item_display'];
			}
		}
	}
	
	public static function GetMultiInputFull($inputs = array())
	{
		if(!is_array($inputs))
		{
			$inputs = ac_utils::CleanArray(explode(",",$inputs));
		}
		$db    =& cmsms()->GetDb();
		$query = "SELECT MULTI_INPUT.*, TPL_ASSOCS.tpl_name FROM ". cms_db_prefix() . "module_AdvancedContent_multi_inputs MULTI_INPUT
			LEFT OUTER JOIN ".cms_db_prefix()."module_AdvancedContent_multi_input_tpl_assocs TPL_ASSOCS
			ON MULTI_INPUT.input_id = TPL_ASSOCS.input_id";
		
		$q     = array();
		$p     = array();
		$return_array = array();
		foreach($inputs as $input_id)
		{
			$q[$input_id] = "MULTI_INPUT.input_id = ?";
			$p[$input_id] = $input_id;
		}
		if(count($p))
		{
			$query .= " WHERE " . implode(" OR ", $q);
		}
		$dbresult = $db->Execute($query, $p);
		while($dbresult && $row = $dbresult->FetchRow())
		{
			$return_array[$row['input_id']] = $row;
		}
		return $return_array;
	}
	
	public static function GetMultiInput($input_id)
	{
		$db       =& cmsms()->GetDb();
		$query    = "SELECT input_fields FROM ". cms_db_prefix() . "module_AdvancedContent_multi_inputs WHERE input_id = ? LIMIT 1";
		$dbresult = $db->Execute($query, array($input_id));
		if($dbresult && $row = $dbresult->FetchRow())
		{
			return $row['input_fields'];
		}
	}
	
	public static function GetMultiInputList()
	{
		$db       =& cmsms()->GetDb();
		$query    = "SELECT A.input_id, B.tpl_name FROM ". cms_db_prefix() . "module_AdvancedContent_multi_inputs A
			LEFT JOIN ". cms_db_prefix() . "module_AdvancedContent_multi_input_tpl_assocs B
			ON A.input_id = B.input_id";
		$dbresult = $db->Execute($query);
		$return_array = array();
		while($dbresult && $row = $dbresult->FetchRow())
		{
			$return_array[] = $row;
		}
		return $return_array;
	}
	
	public static function AddMultiInput($input_id, $input_fields)
	{
		$db    =& cmsms()->GetDb();
		$query = "SELECT input_id FROM ". cms_db_prefix() . "module_AdvancedContent_multi_inputs
			WHERE input_id = ? LIMIT 1";
		
		$dbresult = $db->Execute($query, array($input_id));
		if($dbresult && $row = $dbresult->FetchRow())
		{
			return false;
		}
		
		$query = "INSERT INTO ". cms_db_prefix() ."module_AdvancedContent_multi_inputs
			(input_id, input_fields) VALUES (?,?)";
		$dbresult = $db->Execute($query, array($input_id, $input_fields));
		return $dbresult;
	}
	
	public static function UpdateMultiInput($input_id, $input_fields)
	{
		$db    =& cmsms()->GetDb();
		$query = "UPDATE ". cms_db_prefix() . "module_AdvancedContent_multi_inputs
			SET input_fields = ? WHERE input_id = ? ";
		$dbresult = $db->Execute($query, array($input_fields, $input_id));
		return $dbresult;
	}
	
	public static function UpdateTplAssoc($tpl_type, $input_id, $tpl_name)
	{
		$db    =& cmsms()->GetDb();
		$query = "UPDATE ". cms_db_prefix() . "module_AdvancedContent_".$tpl_type."_tpl_assocs
			SET tpl_name = ? WHERE input_id = ? ";
		$dbresult = $db->Execute($query, array($tpl_name, $input_id));
		return $dbresult;
	}
	
	public static function AddTplAssoc($tpl_type, $input_id, $tpl_name)
	{
		$db    =& cmsms()->GetDb();
		$query = "INSERT INTO ". cms_db_prefix() ."module_AdvancedContent_".$tpl_type."_tpl_assocs
			(input_id, tpl_name) VALUES (?,?)";
		$dbresult = $db->Execute($query, array($input_id, $tpl_name));
		return $dbresult;
	}
	
	public static function DeleteTplAssoc($tpl_type,$input_ids = array())
	{
		$db =& cmsms()->GetDb();
		if(!is_array($input_ids))
		{
			$input_ids = ac_utils::CleanArray(explode(",",$input_ids));
		}
		if(!count($input_ids))
		{
			return false;
		}
		$query = "DELETE FROM ". cms_db_prefix() . "module_AdvancedContent_".$tpl_type."_tpl_assocs WHERE ";
		$q = array();
		foreach($input_ids as $_id)
		{
			$q[] = "input_id = ?";
		}
		$query   .=  implode(" OR ", $q);
		$dbresult = $db->Execute($query, $input_ids);
		return $dbresult;
	}
	
	public static function DeleteMultiInput($input_ids = array())
	{
		$db =& cmsms()->GetDb();
		if(!is_array($input_ids))
		{
			$input_ids = ac_utils::CleanArray(explode(",",$input_ids));
		}
		if(!count($input_ids))
		{
			return false;
		}
		$query = "DELETE FROM ". cms_db_prefix() . "module_AdvancedContent_multi_inputs WHERE ";
		$q = array();
		foreach($input_ids as $_id)
		{
			$q[] = "input_id = ?";
		}
		
		$query   .=  implode(" OR ", $q);
		$dbresult = $db->Execute($query, $input_ids);
		return $dbresult;
	}
	
	public static function GetTemplates($prefix)
	{
		$db     =& cmsms()->GetDb();
		$query  = "SELECT TPL.template_name, TPL_ASSOCS.* FROM ". cms_db_prefix() . "module_templates TPL
			LEFT OUTER JOIN ".cms_db_prefix()."module_AdvancedContent_".$prefix."_tpl_assocs TPL_ASSOCS
			ON TPL.template_name = TPL_ASSOCS.tpl_name
			WHERE TPL.module_name = ? AND TPL.template_name LIKE ? ";
		$return_array = array();
		$dbresult     = $db->Execute($query, array('AdvancedContent',$prefix.'_%'));
		while($dbresult && $row = $dbresult->FetchRow())
		{
			if(!isset($return_array[$row['template_name']]))
			{
				$return_array[$row['template_name']] = array();
			}
			$return_array[$row['template_name']]['tpl_name'] = substr($row['template_name'],strlen($prefix.'_'));
			$return_array[$row['template_name']]['tpl_id']   = $row['template_name'];
			if(!isset($return_array[$row['template_name']]['tpl_assocs']))
			{
				$return_array[$row['template_name']]['tpl_assocs'] = array();
				$return_array[$row['template_name']]['is_used'] = false;
			}
			if($row['input_id'])
			{
				$return_array[$row['template_name']]['tpl_assocs'][] = $row['input_id'];
				$return_array[$row['template_name']]['is_used'] = true;
			}
		}
		return $return_array;
	}
	
	public static function GetTplList($prefix)
	{
		$prefix = trim($prefix,'_') . '_';
		$db     =& cmsms()->GetDb();
		$query  = "SELECT template_name FROM ". cms_db_prefix() . "module_templates
			WHERE module_name = ? AND template_name LIKE ? ";
		$return_array = array();
		$dbresult = $db->Execute($query, array('AdvancedContent',$prefix.'%'));
		while($dbresult && $row = $dbresult->FetchRow())
		{
			$tpl_name = substr($row['template_name'],strlen($prefix));
			$return_array[$tpl_name] = $row['template_name'];
		}
		return $return_array;
	}
	
	public static function IsTplUsed($tpl_name, $assoc_type)
	{
		$db     =& cmsms()->GetDb();
		$query  = "SELECT tpl_name FROM ". cms_db_prefix() . "module_AdvancedContent_".$assoc_type."_tpl_assocs
			WHERE template_name = ? ";
		$dbresult = $db->Execute($query, array($tpl_name));
		if(!$dbresult || !$row = $dbresult->FetchRow())
		{
			return false;
		}
		return true;
	}
	
	public static function &GetCustomBlockTypes()
	{
		$config     = cmsms()->GetConfig();
		$dir        = cms_join_path($config['root_path'], 'module_custom', 'AdvancedContent', 'lib');
		$blockTypes = array();
		
		if(is_dir($dir))
		{
			$contentops =& cmsms()->GetContentOperations();
			$contentobj = $contentops->CreateNewContent('advanced_content');
			$classnames = array();
			
			$d = @dir($dir);
			while($entry = $d->read())
			{
				if(preg_match('/class\.(acBlockType_\w+)\.php/', $entry, $matches))
				{
					$blockTypes[] = new $matches[1]($contentobj, $params);
				}
			}
		}
		return $blockTypes;
	}
	
	public static function &GetCoreBlockTypes()
	{
		$config     = cmsms()->GetConfig();
		$dir        = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib';
		$blockTypes = array();
		
		$contentops =& cmsms()->GetContentOperations();
		$contentobj = $contentops->CreateNewContent('advanced_content');
		$classnames = array();
		
		$d = @dir($dir);
		while($entry = $d->read())
		{
			if(preg_match('/class\.(acBlockType_\w+)\.php/', $entry, $matches))
			{
				$blockTypes[] = new $matches[1]($contentobj, $params);
			}
		}
		return $blockTypes;
	}
	
	
	
	/**
	 * Get the groups of the backend user
	 * @return array
	 * @internal
	 */
	private static function &_get_admin_groups()
	{
		if(!self::$_variables['admin_groups'])
		{
			$db =& cmsms()->GetDb();
			self::$_variables['admin_groups'] = array();
			$query = "SELECT group_id FROM ".cms_db_prefix()."user_groups WHERE user_id = ?";
			$dbresult = $db->Execute($query, array(get_userid()));
			while( $dbresult && $row = $dbresult->FetchRow() )
			{
				self::$_variables['admin_groups'][] = $row['group_id'] * -1;
			}
		}
		return self::$_variables['admin_groups'];
	}
	
	/**
	 * Get all backend groups
	 * @return array
	 * @access private
	 */
	private static function &_get_all_admin_groups()
	{
		if(!self::$_variables['all_admin_groups'])
		{
			$groupOps =& cmsms()->GetGroupOperations();
			self::$_variables['all_admin_groups'] = $groupOps->LoadGroups();
		}
		return self::$_variables['all_admin_groups'];
	}
	
	
	/**
	 * Get all backend users
	 * @return array
	 * @access private
	 */
	private static function &_get_all_admin_users()
	{
		if(!self::$_variables['all_admin_users'])
		{
			$userOps              =& cmsms()->GetUserOperations();
			self::$_variables['all_admin_users'] =& $userOps->LoadUsers();
		}
		return self::$_variables['all_admin_users'];
	}
	
	
	/**
	 * Checks if a backend user has sufficient permission to edit a block
	 * @return boolean
	 * @internal
	 */
	public static function CheckBlockPermission($editor_users, $editor_groups)
	{
		$addt_editors = array();
		if(($editor_users != '' || $editor_groups != '')
			&& !check_permission(get_userid(), 'Manage All AdvancedContent Blocks'))
		{
			$editorGroups =  ac_utils::CleanArray(explode(',',$editor_groups));
			$editorUsers  =  ac_utils::CleanArray(explode(',',$editor_users));
			foreach (self::_get_all_admin_groups() as $oneGroup)
			{
				if(in_array($oneGroup->name,$editorGroups))
				{
					$addt_editors[] = $oneGroup->id*-1;
				}
			}
			
			foreach (self::_get_all_admin_users() as $oneUser)
			{
				if(in_array($oneUser->username,$editorUsers))
				{
					$addt_editors[] = $oneUser->id;
				}
			}
			
			if(!in_array(get_userid(),$addt_editors)
				&& !count(array_intersect(self::_get_admin_groups(),$addt_editors)))
			{
				return false;
			}
		}
		return true;
	}
	
	/**
	 * Display the advanced options
	 * @param boolean $adding - true if page is added, false if edited
	 * @return array - array(array(prompt,imput))
	 */
	public static function DisplayAdvancedOptions(&$content_obj, $adding)
	{
		$AC = &ac_utils::get_module('AdvancedContent');
		$ret = array();
		foreach( $content_obj->GetAdvancedAttribs() as $oneAttrib )
		{
			switch($oneAttrib)
			{
				case 'feu_access':
					if($feusers =& ac_utils::get_module('FrontEndUsers'))
					{
						if($adding)
							$selectedGroups = $AC->GetPreference('feu_access');
						else
							$selectedGroups = $content_obj->GetPropertyValue('feu_access');
						
						$delim          = strpos($selectedGroups,',') === FALSE ? ';' : ',';
						$selectedGroups = ac_utils::CleanArray(explode($delim,$selectedGroups));
						
						$feuAccess = array($AC->lang('inherit_from_parent')=>-1);
						$feuAccess = array_merge($feuAccess,$feusers->GetGroupList());
						$ret[] = array($AC->lang('frontendaccess').' : ',
							'<input type="hidden" value="" name="feu_access" />'.
							$AC->CreateInputSelectList('','feu_access[]',$feuAccess,$selectedGroups,count($feuAccess),'',1));
					}
					break;
				
				case 'redirect_page':
					if($feusers =& ac_utils::get_module('FrontEndUsers'))
					{
						if($adding)
						{
							$content_obj->SetPropertyValueNoLoad("redirect_page",$AC->GetPreference('redirect_page',''));
							$content_obj->SetPropertyValueNoLoad('inherit_custom_params',$AC->GetPreference('inherit_custom_params',''));
							$content_obj->SetPropertyValueNoLoad("custom_params",$AC->GetPreference('custom_params',''));
							$content_obj->SetPropertyValueNoLoad("custom_params_smarty",$AC->GetPreference('custom_params_smarty',''));
						}
						$redirectPage = $content_obj->GetPropertyValue('redirect_page');
						$inherit      = $content_obj->GetPropertyValue('inherit_custom_params');
						$params       = $content_obj->GetPropertyValue("custom_params");
						$do_smarty    = $content_obj->GetPropertyValue("custom_params_smarty");
						$ret[] = array($AC->lang('redirectpage').' : ',
							self::CreateRedirectDropdown('', 'redirect_page',$redirectPage, $content_obj->Id(), 'onchange="if(!this.value){jQuery(\'#AdvancedContent_custom_params input\').attr(\'disabled\',\'disabled\');if(jQuery(\'#AdvancedContent_custom_params\').css(\'display\') != \'none\'){jQuery(\'#AdvancedContent_custom_params\').slideUp();}}else{jQuery(\'#AdvancedContent_custom_params input\').removeAttr(\'disabled\');if(jQuery(\'#AdvancedContent_custom_params\').css(\'display\') == \'none\'){jQuery(\'#AdvancedContent_custom_params\').slideDown();}}"').
							'<br /><span id="AdvancedContent_custom_params" class="AdvancedContent_custom_params" style="overflow:hidden;white-space:nowrap;'.(!$content_obj->GetPropertyValue("redirect_page") ? 'display:none' :'').'"><br /><strong>' . $AC->lang('custom_params').' : </strong><br />
							<span class="AdvancedContent_custom_params" style="overflow:hidden;white-space:nowrap;">'.$AC->lang('inherit_from_parent') . ' : ' .
							'<input type="checkbox" name="inherit_custom_params" value="1" ' . ($inherit ? 'checked="checked"':'') . ' onchange="if(this.checked){jQuery(\'#AdvancedContent_custom_params_wrapper input\').attr(\'disabled\',\'disabled\');if(jQuery(\'#AdvancedContent_custom_params_wrapper\').css(\'display\') != \'none\'){jQuery(\'#AdvancedContent_custom_params_wrapper\').slideUp();}}else{jQuery(\'#AdvancedContent_custom_params_wrapper input\').removeAttr(\'disabled\');if(jQuery(\'#AdvancedContent_custom_params_wrapper\').css(\'display\') == \'none\'){jQuery(\'#AdvancedContent_custom_params_wrapper\').slideDown();}}"/><br /><br />
							<span id="AdvancedContent_custom_params_wrapper" style="overflow:hidden;white-space:nowrap;'.($inherit ? 'display:none' :'').'"><input class="AdvancedContent_custom_params" type="text" size="32" maxlength="128" name="custom_params" value="'.($inherit ? '' : $params).'" '.($inherit ? 'disabled="disabled" ' : '').'/>&nbsp;<em>(param1=value1 param2=value2 ...)</em><br /><br />'.
							$AC->lang('evaluatesmarty') . ' : '.
							'<input type="hidden" name="custom_params_smarty" value="0" '.($inherit ? 'disabled="disabled" ' : '').'/>
							<input type="checkbox" name="custom_params_smarty" value="1"  ' . ($do_smarty == 1 && !$inherit ? 'checked="checked" ':'') . ($inherit ? 'disabled="disabled" ' : '').'/></span></span></span>');
					}
					break;
				
				case 'feu_action':
					if($feusers =& ac_utils::get_module('FrontEndUsers'))
					{
						if($adding)
						{
							$content_obj->SetPropertyValueNoLoad('feu_action', $AC->GetPreference('feu_action',1));
							$content_obj->SetPropertyValueNoLoad('inherit_feu_params',$AC->GetPreference('inherit_feu_params',''));
							$content_obj->SetPropertyValueNoLoad("feu_params",$AC->GetPreference('feu_params',''));
							$content_obj->SetPropertyValueNoLoad("feu_params_smarty",$AC->GetPreference('feu_params_smarty',''));
						}
						$feu_action = $content_obj->GetPropertyValue('feu_action');
						$inherit    = $content_obj->GetPropertyValue('inherit_feu_params');
						$params     = $content_obj->GetPropertyValue("feu_params");
						$do_smarty  = $content_obj->GetPropertyValue("feu_params_smarty");
						
						$ret[] = array($AC->lang('showloginform').' : ',
							$AC->CreateInputDropdown('','feu_action',
								array($AC->lang('yes')=>1,
									$AC->lang('no')=>0,
									$AC->lang('inherit_from_parent')=>-1),
								0,$feu_action,
								'onchange="if(this.value == 0){jQuery(\'#AdvancedContent_feu_params input\').attr(\'disabled\',\'disabled\');if(jQuery(\'#AdvancedContent_feu_params\').css(\'display\') != \'none\'){jQuery(\'#AdvancedContent_feu_params\').slideUp();}}else{jQuery(\'#AdvancedContent_feu_params input\').removeAttr(\'disabled\');if(jQuery(\'#AdvancedContent_feu_params\').css(\'display\') == \'none\'){jQuery(\'#AdvancedContent_feu_params\').slideDown();}}"').
								'<br /><span id="AdvancedContent_feu_params" style="overflow:hidden;white-space:nowrap;'.(!$feu_action ? 'display:none' :'').'"><br /><strong>' . $AC->lang('feu_params').' : </strong><br />
								<span class="AdvancedContent_feu_params" style="overflow:hidden;white-space:nowrap;">'.$AC->lang('inherit_from_parent') . ' : ' .
								'<input type="checkbox" name="inherit_feu_params" value="1" ' . ($inherit ? 'checked="checked"':'') . ' onchange="if(this.checked){jQuery(\'#AdvancedContent_feu_params_wrapper input\').attr(\'disabled\',\'disabled\');if(jQuery(\'#AdvancedContent_feu_params_wrapper\').css(\'display\') != \'none\'){jQuery(\'#AdvancedContent_feu_params_wrapper\').slideUp();}}else{jQuery(\'#AdvancedContent_feu_params_wrapper input\').removeAttr(\'disabled\');if(jQuery(\'#AdvancedContent_feu_params_wrapper\').css(\'display\') == \'none\'){jQuery(\'#AdvancedContent_feu_params_wrapper\').slideDown();}}"/><br /><br />
								<span id="AdvancedContent_feu_params_wrapper" style="overflow:hidden;white-space:nowrap;'.($inherit ? 'display:none' :'').'"><input class="AdvancedContent_feu_params" type="text" size="32" maxlength="128" name="feu_params" value="'.($inherit ? '' : $params).'" '.($inherit ? 'disabled="disabled" ' : '').'/>&nbsp;<em>(param1=value1 param2=value2 ...)</em><br /><br />'.
								$AC->lang('evaluatesmarty') . ' : '.
								'<input type="hidden" name="feu_params_smarty" value="0" '.($inherit ? 'disabled="disabled" ' : '').'/>
								<input type="checkbox" name="feu_params_smarty" value="1"  ' . ($do_smarty == 1 && !$inherit ? 'checked="checked" ':'') . ($inherit ? 'disabled="disabled" ' : '').'/></span></span></span>');
					}
					break;
				
				case 'use_expire_date':
					if($adding)
					{
						$useExp    = $AC->GetPreference('use_expire_date',false);
						$startDate = strtotime('+' . $AC->GetPreference("start_date",'1 week'));
						$endDate   = strtotime('+' . $AC->GetPreference("end_date",'1 week'), $startDate);
					}
					else
					{
						$useExp    = $content_obj->GetPropertyValue('use_expire_date');
						$startDate = $content_obj->GetPropertyValue('start_date') ? $content_obj->GetPropertyValue('start_date') : strtotime('+' . $AC->GetPreference("start_date",'1 week'));
						$endDate   = $content_obj->GetPropertyValue('end_date') ? $content_obj->GetPropertyValue('end_date') : strtotime('+' . $AC->GetPreference("end_date",'1 week'), $startDate);
					}
					
					setlocale(LC_ALL, get_preference(get_userid(), 'default_cms_language'));
					
					$date        = strftime('%x', intval($startDate));
					$time        = strftime('%H:%M', intval($startDate));
					$_tmp        = ac_utils::CleanArray(explode(':',$time));
					$timeSeconds = (($_tmp[0] * 3600) + ($_tmp[1] * 60));
					$dateSeconds = $startDate - $timeSeconds;
					
					$dateInput = '<br /><br />
						<span id="AdvancedContent_expire_date_wrapper" style="overflow:hidden;white-space:nowrap;'.($useExp <= 0 ? 'display:none' : '').'"><strong>'.
						$AC->lang('startdate').' : </strong><br />
						<input type="text" id="AdvancedContentStartDatePickerDisplay" value="'.$date.'" />&nbsp;&nbsp;-&nbsp;&nbsp;
						<input id="AdvancedContentStartDate" type="hidden" '.($useExp <= 0 ? 'disabled="disabled"' : '').' name="start_date[date]" value="'.($dateSeconds * 1000).'" />
						<select name="start_date[time]" '.($useExp <= 0 ? 'disabled="disabled"' : '').'>';
						
					for($i=0; $i<=23; $i++)
					{
						for($j=0; $j<=59; $j++)
						{
							$value = ($i*3600) + ($j*60);
							$dateInput .= '<option value="'. $value .'"'. ($value == $timeSeconds && $useExp > 0 ? ' selected="selected" ':'') . '>'. ($i<10?'0'.$i:$i) .':'. ($j<10?'0'.$j:$j) .'</option>';
						}
						$j = 0;
					}
					$dateInput .= '</select><br /><br />';
					
					$date        = strftime('%x', intval($endDate));
					$time        = strftime('%H:%M', intval($endDate));
					$_tmp        = ac_utils::CleanArray(explode(':',$time));
					$timeSeconds = (($_tmp[0] * 3600) + ($_tmp[1] * 60));
					$dateSeconds = $endDate - $timeSeconds;
					
					$dateInput .= '<strong>' . $AC->lang('enddate').' : </strong><br />
						<input type="text" id="AdvancedContentEndDatePickerDisplay" value="'.$date.'" />&nbsp;&nbsp;-&nbsp;&nbsp;
						<input id="AdvancedContentEndDate" type="hidden" '.($useExp <= 0 ? 'disabled="disabled"' : '').' name="end_date[date]" value="'.($dateSeconds * 1000).'" />
						<select name="end_date[time]" '.($useExp <= 0 ? 'disabled="disabled"' : '').'>';
						
					for($i=0; $i<=23; $i++)
					{
						for($j=0; $j<=59; $j++)
						{
							$value = ($i*3600) + ($j*60);
							$dateInput .= '<option value="'. $value .'"'. ($value == $timeSeconds && $useExp > 0 ? ' selected="selected"':'') .'>'. ($i<10?'0'.$i:$i) .':'. ($j<10?'0'.$j:$j) .'</option>';
						}
						$j = 0;
					}
					$dateInput .= '</select></span>';
					
					$ret[] = array($AC->lang('useexpiredate') . ':',
						$AC->CreateInputDropdown('','use_expire_date',
								array($AC->lang('yes')=>1,
									$AC->lang('no')=>0,
									$AC->lang('inherit_from_parent')=>-1),
								-1,$useExp,'onchange="if(this.value != \'1\'){jQuery(\'#AdvancedContent_expire_date_wrapper input, #AdvancedContent_expire_date_wrapper select, #AdvancedContent_expire_date_wrapper textarea\').attr(\'disabled\',\'disabled\');if(jQuery(\'#AdvancedContent_expire_date_wrapper\').css(\'display\') != \'none\'){jQuery(\'#AdvancedContent_expire_date_wrapper\').slideUp();}}else{jQuery(\'#AdvancedContent_expire_date_wrapper input, #AdvancedContent_expire_date_wrapper select, #AdvancedContent_expire_date_wrapper textarea\').removeAttr(\'disabled\');if(jQuery(\'#AdvancedContent_expire_date_wrapper\').css(\'display\') == \'none\'){jQuery(\'#AdvancedContent_expire_date_wrapper\').slideDown();}}"') . $dateInput);
					
					break;
					
				case 'hide_menu_item':
					if($feusers =& ac_utils::get_module('FrontEndUsers'))
					{
						if($adding)
							$hide = $AC->GetPreference('hide_menu_item',0);
						else
							$hide = $content_obj->GetPropertyValue('hide_menu_item');
						
						$ret[] = array($AC->lang('hide_menu_item') . ':',
							$AC->CreateInputDropdown('','hide_menu_item',
								array($AC->lang('no')=>0,
									$AC->lang('loggedout')=>1,
									$AC->lang('loggedin')=>2,
									$AC->lang('inherit_from_parent')=>-1),
								0,$hide));
					}
					break;
				
				default:break;
			}
		}
		return $ret;
	}
	
	public static function FillParams(&$content_obj, &$params, $editing = false)
	{
		$AC = &ac_utils::get_module('AdvancedContent');
		
		$parameters = array_merge(array('pagedata', 'searchable', 'disable_wysiwyg'), $content_obj->GetAdvancedAttribs());
		if(check_permission(get_userid(), 'Manage AdvancedContent Options') && $AC->GetPreference('use_advanced_pageoptions', 0))
		{
			$params['feu_access'] = isset($params['feu_access']) && is_array($params['feu_access']) ? $params['feu_access'] : ($editing ? ac_utils::CleanArray(explode(',',$content_obj->GetPropertyValue('feu_access'))) : ac_utils::CleanArray(explode(',',$AC->GetPreference('feu_access'))));
			# if page has no parents but wants to inherit -> remove inheritance
			if($content_obj->ParentId() <= 0 && in_array(-1, $params['feu_access']))
			{
				foreach($params['feu_access'] as $k=>$v)
				{
					if($v == -1)
						unset($params['feu_access'][$k]);
				}
			}
			# if there is still inheritance -> check if there actually is any feu group selected by parents
			$_feuAccess = array();
			if(in_array(-1, $params['feu_access']))
			{
				# $_feuAccess contains all feu groups (of current page as well as of all parent pages)
				$_feuAccess = $content_obj->InheritParentProp('feu_access', $params['feu_access']);
			}
			
			# if we have selected any feu group -> disable caching and search
			if(count($_feuAccess) || (count($params['feu_access']) && !in_array(-1, $params['feu_access'])))
			{
				$params['cachable']   = false;
				$content_obj->SetCachable(false);
				$params['searchable'] = false;
			}
			$params['feu_access'] = implode(',', $params['feu_access']);
			
			$params['redirect_page'] = isset($params['redirect_page']) ? $params['redirect_page'] : ($editing ? $content_obj->GetPropertyValue('redirect_page') : $AC->GetPreference('redirect_page'));
			if($content_obj->ParentId() <= 0 && $params['redirect_page'] == -1)
				$params['redirect_page'] = '';
			
			$params['feu_action'] = isset($params['feu_action']) ? $params['feu_action'] : ($editing ? $content_obj->GetPropertyValue('feu_action') : $AC->GetPreference('feu_action',1));
			if($content_obj->ParentId() <= 0 && $params['feu_action'] == -1)
				$params['feu_action'] = 1;
			
			$params['hide_menu_item'] = isset($params['hide_menu_item']) ? $params['hide_menu_item'] : ($editing ? $content_obj->GetPropertyValue('hide_menu_item') : $AC->GetPreference('hide_menu_item',0));
			if($content_obj->ParentId() <= 0 && $params['hide_menu_item'] == -1)
				$params['hide_menu_item'] = 0;
			
			/*ToDo: do this on validation
			if($params['feu_access'] && $params['hide_menu_item'] == 2)
			{
				$params['hide_menu_item'] = $AC->GetPreference('hide_menu_item',0);
			}
			*/
			
			$params['inherit_feu_params'] = isset($params['inherit_feu_params']) ? true : ($editing ? $content_obj->GetPropertyValue('inherit_feu_params') : $AC->GetPreference('inherit_feu_params'));
			if($content_obj->ParentId() <= 0 && $params['inherit_feu_params'])
				$params['inherit_feu_params'] = false;
			
			if($params['inherit_feu_params']) 
			{
				$params['feu_params'] = -1;
				$params['feu_params_smarty'] = -1;
			}
			
			$params['inherit_custom_params'] = isset($params['inherit_custom_params']) ? true : ($editing ? $content_obj->GetPropertyValue('inherit_custom_params') : $AC->GetPreference('inherit_custom_params'));
			if($content_obj->ParentId() <= 0 && $params['inherit_custom_params'])
				$params['inherit_custom_params'] = false;
			
			if($params['inherit_custom_params']) 
			{
				$params['custom_params'] = -1;
				$params['custom_params_smarty'] = -1;
			}
			
			$params['use_expire_date'] = isset($params['use_expire_date']) ? $params['use_expire_date'] : ($editing ? $content_obj->GetPropertyValue('use_expire_date') : $AC->GetPreference('use_expire_date'));
			if($content_obj->ParentId() <= 0 && $params['use_expire_date'] == -1)
				$params['use_expire_date'] = 0;
			
			if($params['use_expire_date'] == -1)
			{
				$params['start_date'] = -1;
				$params['end_date']   = -1;
			}
			else if($params['use_expire_date'] == 0)
			{
				$params['start_date'] = '';
				$params['end_date']   = '';
			}
			else 
			{
				if(isset($params['start_date']))
					$params['start_date'] = $params['start_date']['time'] + ($params['start_date']['date'] / 1000);
				else
					$params['start_date'] = ($editing && $content_obj->GetPropertyValue('start_date') ? $content_obj->GetPropertyValue('start_date') : strtotime('+' . $AC->GetPreference("start_date",'1 week')));
				
				if(isset($params['end_date']))
					$params['end_date'] = $params['end_date']['time'] + ($params['end_date']['date'] / 1000);
				else
					$params['end_date'] = ($editing && $content_obj->GetPropertyValue('end_date') ? $content_obj->GetPropertyValue('end_date') : strtotime('+' . $AC->GetPreference("end_date",'1 week'), $params['start_date']));
			}
		}
		
		# do the content property parameters
		foreach ($parameters as $oneparam)
		{
			if (isset($params[$oneparam]))
				$content_obj->SetPropertyValueNoLoad($oneparam, $params[$oneparam]);
		}
		if(check_permission(get_userid(), 'Manage AdvancedContent Options') 
			&& $AC->GetPreference('use_advanced_pageoptions', 0) 
			&& $content_obj->GetPropertyValue('use_expire_date') 
			&& ($content_obj->GetProperty('start_date') > time() 
				|| $content_obj->GetProperty('end_date') < time())
			)
		{
			$params['active'] = false;
			$content_obj->SetActive(false);
		}
		
		# metadata
		$content_obj->SetMetadata(isset($params['metadata']) ? $params['metadata'] : $content_obj->Metadata());
		
		# contentblocks 
		# ToDo: this causes issues on import in TMS
		# (maybe caused by $contentBlock->FillParams())
		foreach($content_obj->GetContentBlocks() as $blockId => $contentBlock)
		{
			$value = $contentBlock->FillParams($params, $editing);
			if($value == '' && !$contentBlock->GetProperty('allow_none'))
			{
				$value = $contentBlock->GetProperty('default');
				if($contentBlock->GetProperty('smarty'))
					$value = ac_utils::DoSmarty($content_obj, $value);
			}
			$content_obj->SetPropertyValueNoLoad($blockId, $value);
		}
	}
	
	public static function DisplayAttributes(&$content_obj, $one, $adding)
	{
		switch($one)
		{
			case 'template':
				$templateops =& cmsms()->GetTemplateOperations();
				return array(lang('template') . ':', $templateops->TemplateDropdown('template_id', $content_obj->TemplateId(), 'onchange="document.Edit_Content.submit()"'));
			
			case 'pagemetadata':
				return array(lang('page_metadata') . ':', create_textarea(false, $content_obj->Metadata(), 'metadata', 'pagesmalltextarea', 'metadata', '', '', '80', '6'));
			
			case 'pagedata':
				return array(lang('pagedata_codeblock') . ':', create_textarea(false, $content_obj->GetPropertyValue('pagedata'), 'pagedata', 'pagesmalltextarea', 'pagedata', '', '', '80', '6'));
			
			case 'searchable':
				$searchable = $content_obj->GetPropertyValue('searchable');
				if( $searchable == '' )
					$searchable = 1;
				return array(lang('searchable') . ':',
					'<div class="hidden" ><input type="hidden" name="searchable" value="0" /></div>
					<input type="checkbox" name="searchable" value="1" ' . ($searchable == 1?'checked="checked"':'') . ' />');
			
			case 'disable_wysiwyg':
				$disableWysiwyg = $content_obj->GetPropertyValue('disable_wysiwyg');
				if( $disableWysiwyg == '' )
					$disableWysiwyg = 0;
				return array(lang('disable_wysiwyg') . ':',
					'<div class="hidden" ><input type="hidden" name="disable_wysiwyg" value="0" /></div>
					<input type="checkbox" name="disable_wysiwyg" value="1"  ' . ($disableWysiwyg == 1?'checked="checked"':'') . ' onclick="this.form.submit()" />');
			
			default:
				return false;
		}
	}
	
	public static function ValidateData(&$content_obj, $errors = array())
	{
		if( $errors === FALSE )
			$errors = array();
		
		if ($content_obj->TemplateId() <= 0 )
			$errors[] = lang('nofieldgiven', array(lang('template')));
		
		foreach($content_obj->GetContentBlocks() as $contentBlock)
		{
			if($contentBlock->GetProperty('required') && $content_obj->GetProperty($contentBlock->GetProperty('id')) == '')
				$errors[] = lang('nofieldgiven', array($contentBlock->GetProperty('name')));
		}
		if($content_obj->GetPropertyValue('use_expire_date') && check_permission(get_userid(), 'Manage AdvancedContent Options') && $content_obj->GetProperty('end_date') <= $content_obj->GetProperty('start_date'))
		{
			$AC = &ac_utils::get_module('AdvancedContent');
			$errors[] = $AC->lang('error_expiredate');
		}
		if(check_permission(get_userid(), 'Manage AdvancedContent Options') && $content_obj->GetProperty('feu_access') && $content_obj->GetProperty('hide_menu_item') == 2)
		{
			$AC = &ac_utils::get_module('AdvancedContent');
			$errors[] = $AC->lang('error_pageaccess');
		}
		return (count($errors) > 0 ? $errors : FALSE);
	}
	
	public static function FriendlyName(&$content_obj)
	{
		$AC = &ac_utils::get_module('AdvancedContent');
		if(basename($_SERVER['PHP_SELF']) == 'listcontent.php')
		{
			$addTxt = array();
			$addTxt[] = '-&nbsp;' . ($content_obj->Cachable() ? lang('cachable') : lang('noncachable')) . '<br />';
			if($content_obj->Secure())
				$addTxt[] = '-&nbsp;SSL'.'<br />';
			$addTxt[] = '-&nbsp;' . (!$content_obj->ShowInMenu() ? lang('hidefrommenu') : lang('showinmenu')) . '<br />';
			if($AC->GetPreference('use_advanced_pageoptions', 0))
			{
				if($feusers =& ac_utils::get_module('FrontEndUsers'))
				{
					$selectedGroups = $content_obj->GetProperty('feu_access');
					if(count($selectedGroups))
					{
						$addTxt[] = '-&nbsp;'.$AC->lang('frontendaccess').': <ul><li>' . implode('</li><li>',array_keys(array_intersect($feusers->GetGroupList(), $selectedGroups))).'</li></ul>';
						$redirectPage = $content_obj->GetProperty('redirect_page');
						if($redirectPage)
							$addTxt[] = '-&nbsp;' . $AC->lang('redirectpage') . ': '.$redirectPage.'<br />';
						$params = $content_obj->GetProperty('feu_params');
						if(count($params[1]))
							$addTxt[] = '-&nbsp;' . $AC->lang('feu_params') . ': <ul><li>' . implode('</li><li>',$params[1]).'</li></ul>';
						$params = $content_obj->GetProperty('custom_params');
						if(count($params[1]))
							$addTxt[] = '-&nbsp;' . $AC->lang('custom_params') . ': <ul><li>' . implode('</li><li>',$params[1]).'</li></ul>';
					}
					$hide_menu_item = $content_obj->GetProperty('hide_menu_item');
					if($hide_menu_item == 2 || ($hide_menu_item == 1 && count($selectedGroups)))
						$addTxt[] = '-&nbsp;' . $AC->lang('hide_menu_item') . ': '. ($hide_menu_item == 1 ? $AC->lang('loggedout') : $AC->lang('loggedin')).'<br />';
				}
				if($content_obj->GetProperty('use_expire_date'))
				{
					setlocale(LC_ALL, get_preference(get_userid(), 'default_cms_language'));
					$addTxt[]   = '-&nbsp;'.$AC->lang('startdate').': '.strftime('%x %H:%M',$content_obj->GetProperty('start_date')).'<br />';
					$addTxt[]   = '-&nbsp;'.$AC->lang('enddate').': '.strftime('%x %H:%M',$content_obj->GetProperty('end_date')).'<br />';
				}
			}
			if(count($addTxt))
				return '<span style="position:relative;text-decoration:underline;cursor:pointer;display:block" onmouseover="document.getElementById(\''.$content_obj->Id().'_ac_info\').style.display = \'block\';" onmouseout="document.getElementById(\''.$content_obj->Id().'_ac_info\').style.display = \'none\';">' . $AC->lang('AdvancedContent') . '<span id="'.$content_obj->Id().'_ac_info" style="text-decoration:none;background-color:#FFF;border:1px solid #000;position:absolute;padding:5px;display:none;-moz-box-shadow:1px 1px 10px #666666;-webkit-box-shadow:1px 1px 10px #666666;box-shadow:1px 1px 10px #666666;z-index:999;white-space:nowrap">' . implode('',$addTxt) . '</span></span>';
		}
		return $AC->lang('AdvancedContent');
	}
	
	public static function EditAsArray(&$content_obj, $adding = false, $tab = 0, $showadmin = false)
	{
		if(!$tab_id = acTabManager::GetTabId($tab))
			return array();
		
		$AC   = &ac_utils::get_module('AdvancedContent');
		$ret  = array();
		$tmp  = array();
		
		if($tab_id == 'main' || ($tab_id == 'options' && check_permission(get_userid(), 'Manage All Content')))
			$tmp  = ac_utils::CleanArray($content_obj->DisplayAttributes($adding, $tab));
		else if($tab_id == 'AdvancedContent')
			$tmp = self::DisplayAdvancedOptions($content_obj, $adding);
		
		foreach($tmp as $one)
			$ret[] = $one;
		
		$AC->smarty->assign_by_ref('content_obj', $content_obj);
		$AC->smarty->assign('tab', acTabManager::GetTab($tab_id));
		$AC->smarty->assign('locale', substr(get_preference(get_userid(),'default_cms_language'), 0, 2));
		
		if($tab == 0)
		{
			$html        = $AC->GetHeaderHTML() . '<!-- start ac blocktypes head -->';
			$blockTypes  = &acContentBlockManager::GetBlockTypes();
			
			foreach($blockTypes as &$btype)
			{
				if($btype['header_html_called'])
					continue;
				
				$btype['header_html_called'] = true;
				
				$blocks       = $btype['content_blocks'];
				$block_id     = array_shift($blocks);
				$contentBlock = &$content_obj->GetContentBlock($block_id);
				if($contentBlock->Type() == AC_INVALID_BLOCK_TYPE)
					continue;
				$html .= $contentBlock->GetHeaderHTML();
			}
			echo $html . '<!-- end ac blocktypes head -->';
		}
		
		$ret[] = array('', $AC->ProcessTemplate('editcontent.tpl'));
		return $ret;
	}
}
?>
