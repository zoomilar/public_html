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
final class acContentBlockManager
{
	private static $_content_blocks = array();
	private static $_block_types    = array();
	private static $_instance;
	
	private function __construct() {}
	private function __clone() {}
	
	# deprecated (old template parser)
	private static function _parse_template(&$content_obj)
	{
		$templateops =& cmsms()->GetTemplateOperations();
		if ($content_obj->TemplateId() > 0)
			$template = $templateops->LoadTemplateByID($content_obj->TemplateId());
		else
		{
			# should not be needed since CMSms 1.11
			$template = $templateops->LoadDefaultTemplate();
			$content_obj->SetTemplateId($template->id);
		}
		
		$matches = array();
		$result  = preg_match_all(AC_BLOCK_PATTERN, $template->content, $matches);
		
		if (!$result || !count($matches[1]))
			return;
		
		$AC = &ac_utils::get_module('AdvancedContent');
		foreach ($matches[1] as $wholetag)
		{
			if(!$contentBlock = self::CreateContentBlock($content_obj, self::GetTagParams($wholetag)))
				continue;
			
			# do not process blocks with same id twice
			if(isset(self::$_content_blocks[$content_obj->Id()][$contentBlock->GetProperty('id')]))
			{
				self::$_content_blocks[$content_obj->Id()][$contentBlock->GetProperty('id')]->SetProperty('multiple', true);
				continue;
			}
			self::_register_content_block($content_obj, $contentBlock);
		}
	}
	
    # deprecated
    public static function GetTagParams($wholetag)
    {
    		$matches = array();
		$result  = preg_match_all(AC_BLOCK_PARAM_PATTERN, $wholetag, $matches);
		$params  = array();
		for ($i = 0; $i < count($matches[1]); $i++)
		{
			if(startswith($matches[2][$i],'\''))
				$matches[2][$i] = trim($matches[2][$i],'\'');
			else if(startswith($matches[2][$i],'"'))
				$matches[2][$i] = trim($matches[2][$i],'"');
			
			$params[strtolower($matches[1][$i])] = $matches[2][$i];
		}
		return $params;
    }
    
	public static function CreateContentBlock(&$content_obj, $params) 
	{
		$params['smarty'] = (isset($params['smarty'])
			&& (ac_utils::IsTrue($params['smarty']) 
			|| $params['smarty'] == 'both' 
			|| $params['smarty'] == ac_utils::cms_access())
		);
		
		# block active ?
		$params['active'] = isset($params['active']) ? $params['active'] : true;
		if($params['smarty'])
			$params['active'] = ac_utils::DoSmarty($content_obj, $params['active']);
		if(ac_utils::IsFalse($params['active']))
			return false; # do not process inactive blocks
		#---
		
		# additional editors
		$params['editor_groups'] = isset($params['editor_groups']) ? $params['editor_groups'] : NULL;
		$params['editor_users']  = isset($params['editor_users'])  ? $params['editor_users']  : NULL;
		if(!ac_utils::is_frontend_request()
			&& ($params['editor_groups'] || $params['editor_users'])
			&& !ac_admin_ops::CheckBlockPermission($params['editor_users'], $params['editor_groups']))
		{
			return false; # do not process blocks without permission to edit
		}
		#---
		
		# valid block type?
		$params['block_type'] = isset($params['block_type']) ? strtolower($params['block_type']) : 'text';
		
		$classname = 'acBlockType_' . $params['block_type'];
		if(!class_exists($classname))
		{
			if(!ac_utils::is_frontend_request())
				$classname = 'acBlockTypePlaceholder';
			else
				return false;
		}
		#---
		
		# valid block id?
		$params['block_id'] = isset($params['block']) ? preg_replace('/-+/','_', munge_string_to_url($params['block'])) : 'content_en';
		if(!$params['block_id'] || $content_obj->IsKnownProperty($params['block_id']))
		{
			if(!ac_utils::is_frontend_request())
			{
				$params['block_id'] = md5($params['block_id'] . '_' . @count(self::$_content_blocks[$content_obj->Id()])); # count shouldn't be needed since CMSms 1.11 (multiple blocks with same id are just not possible anymore)
				$classname = 'acBlockTypePlaceholder';
			}
			else
				return false;
		}
		#---
		
		return new $classname($content_obj, $params);
	}
	
	/**
	 * @internal
	 * @access private
	 */
	public static function _register_content_block(&$content_obj, &$contentBlock)
	{
		# do not process blocks with same id twice
		if(isset(self::$_content_blocks[$content_obj->Id()][$contentBlock->GetProperty('id')]))
		{
			self::$_content_blocks[$content_obj->Id()][$contentBlock->GetProperty('id')]->SetProperty('multiple', true);
			return;
		}
		
		$AC = &ac_utils::get_module('AdvancedContent');
		
		$block_id = $contentBlock->GetProperty('id');
		
		# this block has been added to the template after page has been created?
		if(!$content_obj->HasProperty($block_id))
			$contentBlock->SetProperty('new_block', true);
		
		# ToDo: how remove the backend stuff from this class without need to loop through all content blocks again?
		if(!ac_utils::is_frontend_request())
		{
			$type = $contentBlock->Type();
			
			if(!isset(self::$_block_types[$type]))
				self::$_block_types[$type] = array(
					'content_blocks'     => array(),
					'header_html_called' => false,
					'props'              => array()
				);
			
			self::$_block_types[$type]['content_blocks'][$block_id] = $block_id;
			
			acTabManager::SetTabs($content_obj, $contentBlock);
			
			if($contentBlock->Type() != AC_INVALID_BLOCK_TYPE)
			{
				if($contentBlock->GetProperty('smarty'))
				{
					foreach($contentBlock->GetProperties() as $propName=>$propValue)
						$contentBlock->SetProperty($propName, ac_utils::DoSmarty($content_obj, $propValue));
				}
				
				$value = $contentBlock->GetContent();
				
				if(($content_obj->Id() < 0 && $value == '')
					|| ($value == '' && !$contentBlock->GetProperty('allow_none')) 
					|| $contentBlock->GetProperty('new_block'))
				{
					$value = $contentBlock->GetProperty('default');
				}
				$content_obj->SetPropertyValueNoLoad($block_id, $value);
				
				$block_display = true;
				if($contentBlock->GetProperty('collapsible'))
				{
					$block_display = ac_admin_ops::GetVisibility(
						'block', 
						$block_id, 
						$content_obj->Id(), 
						$content_obj->TemplateId(), 
						!$contentBlock->GetProperty('collapse')
					);
					$contentBlock->SetProperty(
						'pref_url', 
						str_replace('&amp);','&',
							$AC->CreateLink(
								'm1_', 
								'savePrefs', 
								'', 
								$AC->lang('toggle_block'),
								array(
									'item_type'     => 'block',
									'disable_theme' => true,
									'edit_content'  => true,
									'content_id'    => $content_obj->Id(), 
									'template_id'   => $content_obj->TemplateId(),
									'item_id'       => $block_id,
									'item_display'  => !$block_display
								),
								'', 
								true
							)
						)
					);
				}
				$contentBlock->SetProperty('display', $block_display);
			}
			
			if(strtolower($contentBlock->GetProperty('label')) == 'content_en')
				$contentBlock->SetProperty('label', lang('content'));
			
			if($contentBlock->GetProperty('translate_labels'))
				$contentBlock->SetProperty('label', 
					$AC->lang($contentBlock->GetProperty('label'))
				);
			
			# deprecated (should not be needed since CMSms 1.11)
			if($contentBlock->GetProperty('multiple') 
				&& ac_admin_ops::GetVisibility('message', $block_id, $content_obj->Id(), $content_obj->TemplateId()))
			{
				$hide_link = str_replace('&amp;','&',
					$AC->CreateLink('m1_', 'savePrefs', '', $AC->lang('toggle_message'),
						array(
							'item_type'     => 'message',
							'disable_theme' => true,
							'edit_content'  => true,
							'content_id'    => $content_obj->Id(),
							'template_id'   => $content_obj->TemplateId(),
							'item_id'       => $block_id,
							'item_display'  => 0
						),
						'', false,'',
						'onclick="jQuery.get(this.href); jQuery(\'#' . $block_id . '_message\').toggle(\'fast\',function(){jQuery(this).remove()}); return false;"'
					)
				);
				$contentBlock->SetProperty(
					'message', 
						$AC->lang('notice_duplicatecontent',
							$contentBlock->GetProperty('name')) . 
						' ('. $hide_link .')'
				);
			}
			#---
			
			$contentBlock->SetBlockTypeProperties();
		}
		if(($contentBlock->Type() != AC_INVALID_BLOCK_TYPE  && ac_utils::is_frontend_request()) || !ac_utils::is_frontend_request())
		{
			$content_obj->AddExtraProperty($block_id); # backward compatibility (deprecated)
			self::$_content_blocks[$content_obj->Id()][$block_id] = $contentBlock;
		}
	}
	
	public static function &GetContentBlocks(&$content_obj)
	{
		return self::$_content_blocks[$content_obj->Id()];
	}
	
	public static function &GetContentBlock(&$content_obj, $block_id)
	{
		if(isset(self::$_content_blocks[$content_obj->Id()][$block_id]))
			return self::$_content_blocks[$content_obj->Id()][$block_id];
		$ret = NULL;
		return $ret;
	}
	
	public static function SetBlockTypeProperty($blockType, $propName, $propValue)
	{
		self::$_block_types[$blockType]['props'][$propName] = $propValue;
	}
	
	public static function &GetBlockTypeProperty($blockType, $propName, $default = '')
	{
		if(isset(self::$_block_types[$blockType]['props'][$propName]))
			return self::$_block_types[$blockType]['props'][$propName];
		return $default;
	}
	
	public static function SetBlockTypeProperties($blockType, array $props)
	{
		self::$_block_types[$blockType]['props'] = $props;
	}
	
	public static function &GetBlockTypeProperties($blockType, $default = array())
	{
		if(isset(self::$_block_types[$blockType]['props']))
			return self::$_block_types[$blockType]['props'];
		return $default;
	}
	
	public static function &GetBlockTypes()
	{
		return self::$_block_types;
	}
	
	public static function &GetBlockType($type)
	{
		if(isset(self::$_block_types[$type]))
			return self::$_block_types[$type];
		$ret = NULL;
		return $ret;
	}
	
	public static function &GetBlocksByType($type)
	{
		if(isset(self::$_block_types[$type]))
			return self::$_block_types[$type]['content_blocks'];
		$ret = array();
		return $ret;
	}
	
	public static function ClearContentBlocks($content_id = NULL)
	{
		if($content_id)
		{
			self::$_content_blocks[$content_id] = NULL;
			unset(self::$_content_blocks[$content_id]);
		}
		else
			self::$_content_blocks = array();
	}
}
?>
