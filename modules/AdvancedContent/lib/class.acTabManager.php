<?php
/**
 * @package AdvancedContent
 * @category CMSModuleContentType
 * @license GPL
 * @author Georg Busch (NaN)
 * @copyright 2010-2013 Georg Busch (NaN)
 * @since 0.9.4
 * @internal
 * @access private
 */
final class acTabManager
{
	private static $_tabs;
	private static $_tab_ids;
	private static $_tab_names;
	private static $_init;
	
	private function __construct() {}
	private function __clone() {}
	
	private static function _init()
	{
		$AC = &ac_utils::get_module('AdvancedContent');
		self::$_tabs = array(
			'main' => array(
				'tab_id'         => 'main',
				'tab_name'       => lang('main'),
				'block_tabs'     => array(),
				'block_groups'   => array(),
				'content_blocks' => array()
			)
		);
		if( check_permission(get_userid(), 'Manage All Content') )
		{
			self::$_tabs['options'] = array(
				'tab_id'         => 'options',
				'tab_name'       => lang('options'),
				'block_tabs'     => array(),
				'block_groups'   => array(),
				'content_blocks' => array()
			);
		}
		if( check_permission(get_userid(), 'Manage AdvancedContent Options') 
			&& $AC->GetPreference('use_advanced_pageoptions', 0) )
		{
			self::$_tabs['AdvancedContent'] = array(
				'tab_id'         => 'AdvancedContent',
				'tab_name'       => $AC->lang('advancedcontent_tabname'),
				'block_tabs'     => array(),
				'block_groups'   => array(),
				'content_blocks' => array()
			);
		}
		self::$_init = true;
	}
	
	public static function SetTabs(&$content_obj, &$contentBlock)
	{
		if(!self::$_init)
			self::_init();
		self::_set_page_tab($contentBlock);
		self::_set_block_tab($contentBlock);
		self::_set_block_group($content_obj, $contentBlock);
	}
	
	public static function GetTabs()
	{
		if(!self::$_init)
			self::_init();
		return self::$_tabs;
	}
	
	public static function GetTab($tab_id)
	{
		if(!self::$_init)
			self::_init();
		return isset(self::$_tabs[$tab_id]) ? self::$_tabs[$tab_id] : NULL;
	}
	
	public static function GetTabIds()
	{
		if(!self::$_init)
			self::_init();
		if(!self::$_tab_ids)
			self::$_tab_ids = array_keys(self::$_tabs);
		return self::$_tab_ids;
	}
	
	public static function GetTabId($nr)
	{
		if(!self::$_init)
			self::_init();
		if(!self::$_tab_ids)
			self::$_tab_ids = array_keys(self::$_tabs);
		
		return isset(self::$_tab_ids[$nr]) ? self::$_tab_ids[$nr] : NULL;
	}
	
	public static function GetTabNames()
	{
		if(!self::$_init)
			self::_init();
		if(!self::$_tab_names)
		{
			self::$_tab_names = array();
			foreach(self::$_tabs as $tab)
				self::$_tab_names[] = $tab['tab_name'];
		}
		return self::$_tab_names;
	}
	
	private static function _set_page_tab(&$contentBlock)
	{
		$tab_name = $contentBlock->GetProperty('page_tab');
		$tab_id   = ac_utils::CleanStrId($tab_name);
		if(!isset(self::$_tabs[$tab_id]))
		{
			self::$_tabs[$tab_id] = array(
				'tab_id'         => $tab_id,
				'tab_name'       => $tab_name,
				'block_tabs'     => array(),
				'block_groups'   => array(),
				'content_blocks' => array()
			);
		}
		$block_id = $contentBlock->GetProperty('id');
		self::$_tabs[$tab_id]['content_blocks'][$block_id] = $block_id;
		$contentBlock->SetProperty('page_tab', $tab_id);
	}
	
	private static function _set_block_tab(&$contentBlock)
	{
		if($contentBlock->GetProperty('block_tab') == '')
			return;
		
		$page_tab_id    = $contentBlock->GetProperty('page_tab');
		$block_tab_name = $contentBlock->GetProperty('block_tab');
		$block_tab_id   = $page_tab_id . '_' . ac_utils::CleanStrId($block_tab_name);
		
		$block_tabs = &self::$_tabs[$page_tab_id]['block_tabs'];
		
		if(!isset($block_tabs[$block_tab_id]))
		{
			$block_tabs[$block_tab_id] = array(
				'tab_id'         => $block_tab_id,
				'tab_name'       => $block_tab_name,
				'block_groups'   => array(),
				'content_blocks' => array()
			);
		}
		$block_id = $contentBlock->GetProperty('id');
		$block_tabs[$block_tab_id]['content_blocks'][$block_id] = $block_id;
		unset(self::$_tabs[$page_tab_id]['content_blocks'][$block_id]);
		$contentBlock->SetProperty('block_tab', $block_tab_id);
	}
	
	private static function _set_block_group($content_obj, &$contentBlock)
	{
		if($contentBlock->GetProperty('block_group') == '')
			return;
		
		$AC           = &ac_utils::get_module('AdvancedContent');
		$page_tab_id  = $contentBlock->GetProperty('page_tab');
		$block_tab_id = $contentBlock->GetProperty('block_tab');
		$group_name   = $contentBlock->GetProperty('block_group');
		$group_id     = ($block_tab_id ? $block_tab_id : $page_tab_id) . '_' . ac_utils::CleanStrId($group_name);
		$tab_array    = $block_tab_id ? self::$_tabs[$page_tab_id]['block_tabs'][$block_tab_id]['block_groups'] : self::$_tabs[$page_tab_id]['block_groups'];
		
		if(!isset($tab_array[$group_id]))
		{
			$collapsible   = $contentBlock->GetProperty('collapsible');
			$group_display = $collapsible ? ac_admin_ops::GetVisibility(
				'group', $group_id, $content_obj->Id(), 
				$content_obj->TemplateId(), 
				!$AC->GetPreference('collapse_group_default', 1)
			) : true;
			$pref_url = $collapsible ? str_replace(
				'&amp;','&',
				$AC->CreateLink(
					'm1_', 'savePrefs', '', $AC->lang('toggle_group'),
					array(
						'item_type'     => 'group',
						'disable_theme' => true,
						'edit_content'  => true,
						'content_id'    => $content_obj->Id(),
						'template_id'   => $content_obj->TemplateId(),
						'item_id'       => $group_id,
						'item_display'  => !$group_display
					),
					'', true
				)
			) : '#';
			$tab_array[$group_id] = array(
				'group_id'    => $group_id,
				'group_name'  => $group_name,
				'collapsible' => $collapsible,
				'display'     => $group_display,
				'pref_url'    => $pref_url
			);
			
		}
		
		$block_id = $contentBlock->GetProperty('id');
		$tab_array[$group_id]['content_blocks'][$block_id] = $block_id;
		if($block_tab_id) 
		{
			self::$_tabs[$page_tab_id]['block_tabs'][$block_tab_id]['block_groups'] = $tab_array;
			unset(self::$_tabs[$page_tab_id]['block_tabs'][$block_tab_id]['content_blocks'][$block_id]);
		}
		else
			self::$_tabs[$page_tab_id]['block_groups'] = $tab_array;
		
		unset(self::$_tabs[$page_tab_id]['content_blocks'][$block_id]);
	}
}
?>
