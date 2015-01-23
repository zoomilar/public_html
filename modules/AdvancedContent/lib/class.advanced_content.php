<?php
#-------------------------------------------------------------------------------
#
# Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
#          a content management tool for CMS Made Simple
#          The projects homepage is http://dev.cmsmadesimple.org/projects/content2/
#          CMS Made Simple is (c) 2004-2013 by Ted Kulp
#          The projects homepage is: http://www.cmsmadesimple.org
# Version: 0.9.4
# File   : class.advanced_content.php
# Purpose: the content object
# License: GPL
#
#-------------------------------------------------------------------------------
/**
 * @package AdvancedContent
 * @category CMSModuleContentType
 * @license GPL
 * @author Georg Busch (NaN)
 * @copyright 2010-2013 Georg Busch (NaN)
 * @since 0.9.4
 */
class advanced_content extends CMSModuleContentType
{
	private $_stylesheet;
	private $_loaded;
	private $_feuAction;
	private $_feuAccess;
	private $_feuGroups;
	private $_inheritables;
	private $_advancedAttribs = array(
		'use_expire_date',
		'start_date',
		'end_date',
		'feu_access',
		'redirect_page',
		'feu_action',
		'hide_menu_item',
		'inherit_redirect_params',
		'feu_params',
		'inherit_feu_params',
		'feu_params_smarty',
		'custom_params',
		'inherit_custom_params',
		'custom_params_smarty'
	);
	
	function __construct()
	{
		parent::__construct();
		$this->_loaded    = false;
		$this->_feuAction = false;
		$this->_feuAccess = -1;
		$this->_feuGroups = false;
	}
	
	function SetProperties()
	{
		parent::SetProperties();
		$this->AddBaseProperty('template', 4, 0, 'int');
		$this->AddBaseProperty('pagemetadata', 20);
		
		$this->AddContentProperty('searchable', 8, 0, 'int');
		$this->AddContentProperty('pagedata', 25);
		$this->AddContentProperty('disable_wysiwyg', 60, 0, 'int');
		
		if(ac_utils::get_module('AdvancedContent')->GetPreference('use_advanced_pageoptions', 0))
		{
			$this->AddContentProperty('use_expire_date', 99, 0, 'int');
			$this->AddContentProperty('start_date', 100, 0, 'int');
			$this->AddContentProperty('end_date', 101, 0, 'int');
			
			if($feusers =& ac_utils::get_module('FrontEndUsers'))
			{
				$this->AddContentProperty('feu_access', 102);
				$this->AddContentProperty('redirect_page', 103, 0, 'int');
				
				$this->AddContentProperty('inherit_feu_params', 104, 0,'int');
				$this->AddContentProperty('feu_params', 105, 0);
				$this->AddContentProperty('feu_params_smarty', 106, 0, 'int');
				
				$this->AddContentProperty('inherit_custom_params', 107, 0,'int');
				$this->AddContentProperty('custom_params', 108, 0);
				$this->AddContentProperty('custom_params_smarty', 109, 0, 'int');
				
				$this->AddContentProperty('feu_action', 110, 0, 'int');
				$this->AddContentProperty('hide_menu_item', 111, 0, 'int');
			}
		}
		
		# Backward compatibility (deprecated)
		$this->mPreview = true; # ToDo: remove this
	}
	
	function FriendlyName()
	{
		return ac_admin_ops::FriendlyName($this);
	}
	
	function ModuleName()
	{
		return 'AdvancedContent';
	}
	
	function IsDefaultPossible()
	{
		return TRUE;
	}
	
	function IsCopyable()
	{
		return TRUE;
	}
	
	function HasPreview()
	{
		return true;
	}
	
	function ShowInMenu()
	{
		$AC = &ac_utils::get_module('AdvancedContent');
		if($AC->GetPreference('use_advanced_pageoptions', 0))
		{
			if($this->GetProperty('use_expire_date'))
			{
				$start_date = $this->GetProperty('start_date');
				$end_date   = $this->GetProperty('end_date');
				if(($start_date > time() || $end_date < time()) && $this->Active())
				{
					$this->SetActive(false);
					$this->SetShowInMenu(false);
				}
				else if($start_date < time() && $end_date > time() && !$this->Active())
					$this->SetActive(true);
			}
			if(ac_utils::is_frontend_request() && $feusers =& ac_utils::get_module('FrontEndUsers'))
			{
				if($this->GetProperty('hide_menu_item'))
				{
					if($this->GetProperty('hide_menu_item') == 1)
						$this->SetShowInMenu($this->_check_frontend_page_access());
					else if($this->GetProperty('hide_menu_item') == 2)
						$this->SetShowInMenu(!$feusers->LoggedIn());
				}
			}
		}
		return parent::ShowInMenu();
	}
	
	function Active()
	{
		$AC = &ac_utils::get_module('AdvancedContent');
		if($AC->GetPreference('use_advanced_pageoptions', 0))
		{
			if($this->GetProperty('use_expire_date'))
			{
				$start_date = $this->GetProperty('start_date');
				$end_date   = $this->GetProperty('end_date');
				if(($start_date > time() || $end_date < time()) && parent::Active())
				{
					$this->SetActive(false);
					$this->SetShowInMenu(false);
				}
				else if($start_date < time() && $end_date > time() && !parent::Active())
					$this->SetActive(true);
			}
		}
		return parent::Active();
	}
	
	function Cachable()
	{
		$AC = &ac_utils::get_module('AdvancedContent');
		if($AC->GetPreference('use_advanced_pageoptions', 0) 
			&& ac_utils::is_frontend_request() 
			&& $feusers =& ac_utils::get_module('FrontEndUsers')
			&& $this->GetProperty('feu_access'))
		{
			$this->SetCachable(false);
		}
		return parent::Cachable();
	}
	
	function ReadyForEdit() {/*???*/}
	
	function Show($param = 'content_en')
	{
		$AC = &ac_utils::get_module('AdvancedContent');
		
		# check page access
		if($AC->GetPreference('use_advanced_pageoptions', 0) 
			&& ac_utils::is_frontend_request() 
			&& !$this->_check_frontend_page_access())
		{
			if($param == 'content_en') # fix by Jonathan Schmid (aka Foaly*)
				return $this->_do_feu_action();
			return;
		}
		$param = str_replace(array('-','+'), '_', munge_string_to_url($param));
		return $this->GetPropertyValue($param);
	}
	
	function TabNames()
	{
		$this->GetContentBlocks();
		return acTabManager::GetTabNames();
	}
	
	function FillParams($params, $editing = false)
	{
		$AC = &ac_utils::get_module('AdvancedContent');
		
		$this->_loaded = false;
		if(isset($params['parent_id']) && $params['parent_id'] != $this->ParentId())
			$this->SetItemOrder(-1);
		$this->SetTemplateId(isset($params['template_id']) ? $params['template_id'] : $this->TemplateId());
		$this->SetParentId(isset($params['parent_id'])     ? $params['parent_id']   : $this->ParentId());
		$this->GetContentBlocks();
		ac_admin_ops::FillParams($this, $params, $editing); # <- ToDo: this causes issues on import in TMS (contentblocks are empty or do not exist anymore)
		parent::FillParams($params, $editing);
	}
	
	function EditAsArray($adding = false, $tab = 0, $showadmin = false)
	{
		$this->GetContentBlocks();
		return ac_admin_ops::EditAsArray($this, $adding, $tab, $showadmin);
	}
	
	function ValidateData()
	{
		return ac_admin_ops::ValidateData($this, parent::ValidateData());
	}
	
	function display_single_element($one, $adding)
	{
		if(in_array($one, $this->_advancedAttribs))
			return;
		if(!$ret = ac_admin_ops::DisplayAttributes($this, $one, $adding))
			$ret = parent::display_single_element($one, $adding);
		return $ret;
	}
	
	# compatibility to the core
	public function get_content_blocks()
	{
		return $this->GetContentBlocks();
	}

/**
 * -----------------------------------------------------------------------------
 * Custom functions
 * -----------------------------------------------------------------------------
 */

	public function DisplayAttributes($adding, $tab)
	{
		return parent::display_attributes($adding, $tab);
	}
	
	public function GetStylesheet()
	{
		return $this->_stylesheet;
	}
	
	public function GetProperty($propName)
	{
		$propValue = $this->GetPropertyValue($propName);
		if(ac_utils::get_module('AdvancedContent')->GetPreference('use_advanced_pageoptions', 0))
		{
			if(!$this->_inheritables)
				$this->_inheritables =& ac_utils::GetInheritables($this->Id());
			
			if(!isset($this->_inheritables[$propName]))
				return $propValue;
			
			$inherit = false;
			if($propName == 'feu_access')
			{
				$delim     = strpos($propValue,',') === FALSE ? ';' : ',';
				$propValue = ac_utils::CleanArray(explode($delim, $propValue));
				if(in_array(-1, $propValue))
					$inherit = true;
			}
			else if($propValue == -1)
				$inherit = true;
			
			if($inherit)
				$propValue = $this->InheritParentProp($propName, $propValue);
			
			if($propName == 'feu_params' || $propName == 'custom_params')
			{
				$matches = array();
				$result  = preg_match_all(AC_BLOCK_PARAM_PATTERN, $propValue, $matches);
				$params1 = array();
				$params2 = array();
				for ($i = 0; $i < count($matches[1]); $i++)
				{
					if(startswith($matches[2][$i],'\''))
						$matches[2][$i] = trim($matches[2][$i],'\'');
					else if(startswith($matches[2][$i],'"'))
						$matches[2][$i] = trim($matches[2][$i],'"');
					
					$params1[$matches[1][$i]] = $matches[2][$i];
					$params2[]                = $matches[1][$i] . '=' . $matches[2][$i];
				}
				$propValue = array($params1, $params2);
			}
		}
		return $propValue;
	}
	
	public function &GetContentBlocks()
	{
		if(!$this->_loaded)
		{
			$AC = &ac_utils::get_module('AdvancedContent');
			if(ac_utils::is_frontend_request() && $AC->GetPreference('use_advanced_pageoptions', 0) && !$this->_check_frontend_page_access())
				return;
			
			# we don't need this in frontend
			if(!ac_utils::is_frontend_request())
			{
				#ToDo: is this still needed???
				$this->_stylesheet = '../stylesheet.php?templateid=' . $this->TemplateId();
				
				# ToDo: This might violate the forge rules :(
				# but is required to extend {content} blocks by module functions
				# anyway this only happens when editing a page of type advanced_content
				# so it might be trivial?
				$smarty =& cmsms()->get_template_parser();
				
				$smarty->unregisterPlugin('compiler', 'content');
				$smarty->unregisterPlugin('compiler', 'content_image');
				$smarty->unregisterPlugin('compiler', 'content_module');
				
				$smarty->registerPlugin('compiler', 'content',        array(&$this, 'smarty_compiler_contentblock'), false);
				$smarty->registerPlugin('compiler', 'content_image',  array(&$this, 'smarty_compiler_imageblock'),   false);
				$smarty->registerPlugin('compiler', 'content_module', array(&$this, 'smarty_compiler_moduleblock'),  false);
				#---
				
				# This might be the valid way but will ignore {content} blocks :(
				#$smarty =& cmsms()->GetSmarty();
				#$smarty->registerPlugin('compiler', 'advanced_content', array(&$this, 'smarty_compiler_contentblock'), false);
				
				$smarty->assign_by_ref('content_obj', $this);
				$smarty->fetch('template:' . $this->TemplateId());
				
				# restore core functionality - yeah, forge rules ... i know :( 
				$smarty->unregisterPlugin('compiler', 'content');
				$smarty->unregisterPlugin('compiler', 'content_image');
				$smarty->unregisterPlugin('compiler', 'content_module');
				
				$smarty->registerPlugin('compiler', 'content',        'CMS_Content_Block::smarty_compiler_contentblock', false);
				$smarty->registerPlugin('compiler', 'content_image',  'CMS_Content_Block::smarty_compiler_imageblock',   false);
				$smarty->registerPlugin('compiler', 'content_module', 'CMS_Content_Block::smarty_compiler_moduleblock',  false);
			}
		}
		
		return acContentBlockManager::GetContentBlocks($this);
	}
	
	public function smarty_compiler_imageblock($params, &$obj)
	{
		$params['block_type'] = 'image';
		return $this->smarty_compiler_contentblock($params, $obj);
	}
	
	public function smarty_compiler_moduleblock($params, &$obj)
	{
		$params['block_type'] = 'module';
		return $this->smarty_compiler_contentblock($params, $obj);
	}
	
	public function smarty_compiler_contentblock($params, &$obj)
	{
		$this->_loaded = true;
		
		foreach($params as $k=>$v)
			$params[$k] = trim($v, (startswith($v, "'") ? "'" : '"'));
		
		if(isset($params['active']) && ac_utils::IsFalse($params['active']))
			return; # don't process inactive blocks
		
    		if(!$contentBlock = acContentBlockManager::CreateContentBlock($this, $params))
			return;
		
		acContentBlockManager::_register_content_block($this, $contentBlock);
		
		if(ac_utils::is_frontend_request())
		{
			# check block access
			if($feusers = &ac_utils::get_module('FrontEndUsers'))
			{
				if($contentBlock->GetProperty('feu_access') && !ac_utils::FeuIsMemberOf($contentBlock->GetProperty('feu_access')))
				{
					if($contentBlock->GetProperty('feu_action') && !$this->_feuAction)
					{
						$this->_feuAction = true;
						$this->SetPropertyValueNoLoad($contentBlock->GetProperty('id'), $feusers->DoAction('default', 'cntnt01', array('form'=>'login'), $this->Id()));
					}
					else
						$this->SetPropertyValueNoLoad($contentBlock->GetProperty('id'),'');
				}
				else if($contentBlock->GetProperty('feu_hide') && $feusers->LoggedInId())
					$this->SetPropertyValueNoLoad($contentBlock->GetProperty('id'), '');
			}
			
			# set default value (if neccessary)
			if(!$contentBlock->GetProperty('allow_none') && $this->GetPropertyValue($contentBlock->GetProperty('id')) == '')
				$this->SetPropertyValueNoLoad($contentBlock->GetProperty('id'), $contentBlock->GetProperty('default'));
			
			return $contentBlock->GetCompiledContent($obj);
		}
	}
	
	public function &GetContentBlock($block_id)
	{
		return acContentBlockManager::GetContentBlock($this, $block_id, !$this->_loaded);
	}
	
	public function InheritParentProp($propName, $currentProp = array())
	{
		return ac_utils::InheritParentProp($this->Id(), $this->ParentId(), $propName, $currentProp);
	}
	
	/**
	 * Checks if a frontend user has access to a page
	 * @return boolean
	 * @access private
     * @internal
	 */
	private function _check_frontend_page_access()
	{
		if($this->_feuAccess == -1 && $feu =& ac_utils::get_module('FrontEndUsers'))
			$this->_feuAccess = ($this->GetProperty('hide_menu_item') == 2 && $feu->LoggedInId()) ? false : ac_utils::FeuIsMemberOf($this->GetProperty('feu_access'));
		return $this->_feuAccess;
	}
	
	
	/**
	 * Perform the selected action if a page is accessed where the user has no access
	 * @access private
     * @internal
	 */
	private function _do_feu_action()
	{
		if( $feusers =& ac_utils::get_module('FrontEndUsers' ))
		{
			$AC = &ac_utils::get_module('AdvancedContent');
			
			$redirectPage = $this->GetProperty('redirect_page');
			if($redirectPage == $this->Id() || $redirectPage == $this->Alias())
				$redirectPage = '';
			
			# get feu_params
			if(!$this->GetPropertyValue('inherit_feu_params'))
			{
				$feu_params        = $this->GetPropertyValue('feu_params');
				$feu_params_smarty = $this->GetPropertyValue('feu_params_smarty');
			}
			else
			{
				$feu_params        = $this->InheritParentProp('feu_params');
				$feu_params_smarty = $this->InheritParentProp('feu_params_smarty');
			}
			if($feu_params_smarty)
				#$feu_params = $feusers->ProcessTemplateFromData($feu_params);
				$feu_params = $AC->smarty->fetch('string:' . $feu_params);
			
			$matches = array();
			$result  = preg_match_all(AC_BLOCK_PARAM_PATTERN, $feu_params, $matches);
			$feu_params1 = array(); # array(param_name => param_value)
			$feu_params2 = array(); # string "param_name=param_value"
			for ($i = 0; $i < count($matches[1]); $i++)
			{
				if(startswith($matches[2][$i],'\''))
					$matches[2][$i] = trim($matches[2][$i],'\'');
				else if(startswith($matches[2][$i],'"'))
					$matches[2][$i] = trim($matches[2][$i],'"');
				
				$feu_params1[$matches[1][$i]] = $matches[2][$i];
				$feu_params2[]                = $matches[1][$i] . '=' . $matches[2][$i];
			}
			#---
			
			# do feu_action
			$feuAction = $this->GetProperty('feu_action');
			if(!$redirectPage)
			{
				if($feuAction && !$this->_feuAction)
				{
					$this->_feuAction = true;
					# cannot pass custom_params when DoAction() is used
					return $feusers->DoAction('default', 'cntnt01', array_merge(array('form'=>'login'),$feu_params1), $this->Id());
				}
				return;
			}
			
			# get custom_params
			if(!$this->GetPropertyValue('inherit_custom_params'))
			{
				$custom_params        = $this->GetPropertyValue('custom_params');
				$custom_params_smarty = $this->GetPropertyValue('custom_params_smarty');
			}
			else
			{
				$custom_params        = $this->InheritParentProp('custom_params');
				$custom_params_smarty = $this->InheritParentProp('custom_params_smarty');
			}
			if($custom_params_smarty)
				#$custom_params = $feusers->ProcessTemplateFromData($custom_params);
				$custom_params = $AC->smarty->fetch('string:' . $custom_params);
			
			$matches = array();
			$result  = preg_match_all(AC_BLOCK_PARAM_PATTERN, $custom_params, $matches);
			$custom_params1 = array();
			$custom_params2 = array();
			for ($i = 0; $i < count($matches[1]); $i++)
			{
				if(startswith($matches[2][$i],'\''))
					$matches[2][$i] = trim($matches[2][$i],'\'');
				else if(startswith($matches[2][$i],'"'))
					$matches[2][$i] = trim($matches[2][$i],'"');
				
				$custom_params1[$matches[1][$i]] = $matches[2][$i];
				$custom_params2[]                = $matches[1][$i] . '=' . $matches[2][$i];
			}
			
			if($feuAction)
			{
				$url = $feusers->CreateFrontendLink('cntnt01', $redirectPage, 'default', '', $feu_params1, '', true, false, true) . (!empty($custom_params2) ? '&' . implode('&',$custom_params2) : ''); 
				#return $feusers->RedirectForFrontEnd('cntnt01', $redirectPage, 'default', $feu_params1, false);
			}
			else
			{
				$manager =& cmsms()->GetHierarchyManager();
				$node    = $manager->sureGetNodeByAlias($redirectPage);
				if(!is_object($node))
					return;
				$content =& $node->GetContent();
				if (!is_object($content) || !$url = $content->GetURL())
					return;
				
				if(!empty($custom_params1) && !empty($custom_params2))
				{
					$config = cmsms()->GetConfig();
					$url = trim(
						str_replace(
							array(
								$config['root_url'] . '/index.php',
								$config['ssl_url'] . '/index.php',
								$config['root_url'],
								$config['ssl_url']
							),
							'', 
							$url
						),
						'/?'
					);
					
					if($config['url_rewriting'] == 'none')
					{
						if($content->Secure())
							$url = $config['ssl_url'] . '/index.php?' . implode('&',$custom_params2) . '&' . $url;
						else
							$url = $config['root_url'] . '/index.php?' . implode('&',$custom_params2) . '&' . $url;
					}
					else if($config['url_rewriting'] == 'internal')
					{
						if($content->Secure())
							$url = $config['ssl_url'] . '/index.php/' . implode('/',$custom_params1) . '/' . $url;
						else
							$url = $config['root_url'] . '/index.php/' . implode('/',$custom_params1) . '/' . $url;
						
						if($content->DefaultContent())
							$url .= $content->Alias() . $config['page_extension'];
					}
					else if($config['url_rewriting'] == 'mod_rewrite')
					{
						if($content->Secure())
							$url = $config['ssl_url'] . '/' . implode('/',$custom_params1) . '/' . $url;
						else
							$url = $config['root_url'] . '/' . implode('/',$custom_params1) . '/' . $url;
						
						if($content->DefaultContent())
							$url .= $content->Alias() . $config['page_extension'];
					}
				}
			}
			return redirect($url);
		}
	}
	
	
	/**
	 * Just a wrapper to get a module instance in the template
	 *
	 * @param string $module_name - the exact name of the module (case sensitive)
	 * @param string $module_version (optional) - the minimum version of the module
	 * @return object
	 */
	public function &get_module($module_name,$module_version = '') 
	{
		return ac_utils::get_module($module_name, $module_version);
	}
	
	public function IsKnownProperty($name)
	{
		return $this->is_known_property($name);
	}
	
	public function GetAdvancedAttribs()
	{
		return $this->_advancedAttribs;
	}

	/**
	 * @ignore
	 */
	public function __wakeup()
	{
		$this->_loaded = false;
		$smarty = &cmsms()->get_template_parser();
		$smarty->unregisterPlugin('compiler', 'content');
		$smarty->unregisterPlugin('compiler', 'content_image');
		$smarty->unregisterPlugin('compiler', 'content_module');
		$smarty->registerPlugin('compiler', 'content',        array(&$this, 'smarty_compiler_contentblock'), false);
		$smarty->registerPlugin('compiler', 'content_image',  array(&$this, 'smarty_compiler_imageblock'),   false);
		$smarty->registerPlugin('compiler', 'content_module', array(&$this, 'smarty_compiler_moduleblock'),  false);
	}
	
	/**
	 * @ignore
	 */
	public function ClearContentBlocks()
	{
		acContentBlockManager::ClearContentBlocks($this->Id());
	}

/**
 * -----------------------------------------------------------------------------
 * backward compatibility (deprecated stuff)
 * -----------------------------------------------------------------------------
 */

	public function AddExtraProperty($name, $type = 'string')
	{
		if(method_exists(get_parent_class('advanced_content'), 'AddExtraProperty'))
			parent::AddExtraProperty($name, $type);
	}
	
	public function SetPropertyValueNoLoad($propname, $propvalue)
	{
		if(method_exists(get_parent_class('advanced_content'), 'SetPropertyValueNoLoad'))
			return parent::SetPropertyValueNoLoad($propname, $propvalue);
		return parent::SetPropertyValue($propname, $propvalue);
	}
	
	public function __call($name, $arguments)
	{
		$args = '';
		foreach($arguments as $i => $arg)
		{
			$args .= '$arguments[$i],';
		}
		$args .= '\'dummy\'';
		
		$config = cmsms()->GetConfig();
		if($config['debug'])
			trigger_error('AdvancedContent method "' . $name . '()" is deprecated!', E_USER_WARNING);
		
		if(method_exists('acContentBlockManager', $name))
			return eval('return acContentBlockManager::' . $name . '('.$args.');');
	}
}

?>
