<?php
/**
 * @package AdvancedContent
 * @category CMSModuleContentType
 * @license GPL
 * @author Georg Busch (NaN)
 * @copyright 2010-2013 Georg Busch (NaN)
 * @since 0.9.3
 */
final class ac_utils
{
	private static $_feuGroups;
	
	private static $_variables = array(
		'inheritables' => array( 
			0 => array(
				'feu_access'           => -1,
				'redirect_page'        => -1,
				'custom_params'        => -1,
				'custom_params_smarty' => -1,
				'feu_params'           => -1,
				'feu_params_smarty'    => -1,
				'feu_action'           => -1,
				'start_date'           => -1,
				'end_date'             => -1,
				'hide_menu_item'       => -1,
				'use_expire_date'      => -1
			)
		)
	);
	
	private function __construct() {}
	private function __clone() {}
	
	/**
	 * function IsVarEmpty($var, $trim, $unsetEmptyIndexes)
	 * not part of the module api
	 * checks if a var is empty. if var is an array it recursivley checks all elements
	 *
	 * @param mixed $var - the var to check for empty value(s)
	 * @param boolean $trim - true to trim off spaces
	 * @param boolean $unsetEmptyIndexes - true to delete empty elements from array
	 * @return boolean - true if empty, false if not
	 */
	public static function IsVarEmpty(&$var, $trim = true, $unsetEmptyIndexes = false)
	{
		if (is_array($var))
		{
			foreach ($var as $k=>$v)
			{
				if (!self::IsVarEmpty($v))
					return false;
				else
				{
					if($unsetEmptyIndexes)
						unset($var[$k]);
					return true;
				}
			}
		}
		else if($trim && trim($var) == '')
			return true;
		else if($var == '')
			return true;
		return false;
	}
	
	
	/**
	 * function CleanArray($array)
	 * not part of the module api
	 * removes empty elements from an array
	 * (can be useful when using function explode to create the array from csv)
	 *
	 * @param array $array - the array to clean up
	 * @return array - an array without empty elements or an empty array
	 */
	public static function CleanArray($array)
	{
		if (is_array($array))
		{
			foreach ($array as $k=>$v)
			{
				if (self::IsVarEmpty($v,true,true))
					unset($array[$k]);
				else
				{
					if(is_array($v))
					{
						$v = self::CleanArray($v);
						if(self::IsVarEmpty($v,true,true))
							unset($array[$k]);
						else
							$array[$k] = $v;
					}
				}
			}
			return $array;
		}
		return array();
	}
	
	/**
	 * function IsTrue($value)
	 * not part of the module api
	 * checks if a value is literally "true"
	 * can be usefull when checking smarty params for the value true
	 *
	 * @param mixed $value - the value to check
	 * @return bool
	 */
	public static function IsTrue($value)
	{
		return (strtolower($value) === 'true' || $value === 1 || $value === '1' || $value === true);
	}
	
	
	/**
	 * function IsFalse($value)
	 * not part of the module api
	 * checks if a value is literally "false"
	 * can be usefull when checking smarty params for the value false
	 *
	 * @param mixed $value - the value to check
	 * @return bool
	 */
	public static function IsFalse($value)
	{
		return (strtolower($value) === 'false' || $value === '0' || $value === 0 || $value === false || $value === '');
	}
	
	/**
	 * This is just a wrapper to process a template from data
	 * @param string $data - The template content to process
	 * @return string - The processed template data
	 */
	public static function DoSmarty(&$content_obj, $data)
	{
		if(is_array($data))
		{
			foreach($data as $k => $v)
				$data[$k] = self::DoSmarty($content_obj, $v);
		}
		if(!is_array($data) && !is_object($data) && preg_match_all('/:::([^:]+):::/', $data, $matches))
		{
			$AC =& self::get_module('AdvancedContent');
			$AC->smarty->assign_by_ref('content_obj', $content_obj);
			$AC->smarty->assign('content_id', $content_obj->Id());
			$AC->smarty->assign('content_alias', $content_obj->Alias());
			$AC->smarty->assign('page', $content_obj->Alias());
			$AC->smarty->assign('page_id', $content_obj->Alias());
			$AC->smarty->assign('page_alias', $content_obj->Alias());
			$AC->smarty->assign('page_name', $content_obj->Alias());
			$AC->smarty->assign('position', $content_obj->Hierarchy());
			$AC->smarty->assign('friendly_position', cmsms()->GetContentOperations()->CreateFriendlyHierarchyPosition($content_obj->Hierarchy()));
			$data = $AC->smarty->fetch('string:' . preg_replace('/:::([^:]+):::/', '{$1}', $data)); # fix by Jonathan Schmid (aka Foaly*)
		}
		return $data;
	}
	
	/**
	 * Inherits a property of a parent page (recursivley)
	 *
	 * @param int $currentId - The id of the current page
	 * @param int $parentId - The id of the parent page
	 * @param string $propName - The name of the property to inherit
	 * @param array $currentProp (optional) - If prop is an array this will be the items of the current page; So return array will contain all items of the current page and parent pages; otherwise only the parents items will be returned (feu_access only)
	 *
	 * @return array|string - The prop of the last found parent that has no inheritance or an array of items of all parents that have inheritance
	 */
	public static function InheritParentProp($currentId, $parentId, $propName, $currentProp = array())
	{
		$currentId = intval($currentId);
		self::GetInheritables($currentId);
		if(!isset(self::$_variables['inheritables'][$currentId][$propName]))
			return; // should never happen
		
		if(isset(self::$_variables['inheritables'][$parentId]) && self::$_variables['inheritables'][$parentId][$propName] > -1)
			self::$_variables['inheritables'][$currentId][$propName] = self::$_variables['inheritables'][$parentId][$propName];
		
		if(self::$_variables['inheritables'][$currentId][$propName] == -1)
		{
			if($propName == 'feu_access')
			{
				self::$_variables['inheritables'][$currentId][$propName] = array();
				foreach($currentProp as $k=>$v)
				{
					if($v != -1)
						self::$_variables['inheritables'][$currentId][$propName][] = $v;
				}
			}
			else
				self::$_variables['inheritables'][$currentId][$propName] = '';
			
			$inherit = true;
			while( $parentId > 0 && $inherit && $content = self::LoadContent($parentId, $propName, 'parent_id','advanced_content',1))
			{
				$propValue = $content[$parentId][$propName];
				$parentId  = $content[$parentId]['parent_id'];
				if($propName == 'feu_access')
				{
					$delim = strpos($propValue,',') === FALSE ? ';' : ',';
					$propValue = self::CleanArray(explode($delim,$propValue));
					foreach($propValue as $_p)
					{
						if(!in_array($_p, self::$_variables['inheritables'][$currentId][$propName]) && $_p != -1 && $_p != '')
							self::$_variables['inheritables'][$currentId][$propName][] = $_p;
					}
					if(!in_array(-1, $propValue))
						$inherit = false;
						#return self::$_variables['inheritables'][$currentId][$propName];
				}
				else if($propValue != -1)
				{
					self::$_variables['inheritables'][$currentId][$propName] = $propValue;
					$inherit = false;
				}
			}
			if(isset(self::$_variables['inheritables'][$parentId]) && self::$_variables['inheritables'][$parentId] == -1)
				self::$_variables['inheritables'][$parentId][$propName] = self::$_variables['inheritables'][$currentId][$propName];
		}
		return self::$_variables['inheritables'][$currentId][$propName];
	}
	
	/**
	 * Loads properties and/or attribs of one or more content pages from DB 
	 * Caution! If no ids, properties or atributes are specified it will load ALL content of ALL pages.
	 *
	 * @param string|array $contentIds - The ids of the content to get the property from
	 * @param string|array $props - The name of the property to get the value from
	 * @param string|array $attribs - The name of the property to get the value from
	 * @param string|array $contentTypes (optional) - The type of the content
	 * @return array
	 */
	public static function LoadContent($contentIds = array(), $props = array(), $attribs = array(), $contentTypes = array(), $limit = '')
	{
		$db  = &cmsms()->GetDb();
		$ret = array();
		if(!is_array($contentIds))
			$contentIds = self::CleanArray(explode(',',$contentIds));
		
		if(!is_array($props))
			$props = self::CleanArray(explode(',',$props));
		
		if(!is_array($attribs))
			$attribs = self::CleanArray(explode(',',$attribs));
		
		if(!is_array($contentTypes))
			$contentTypes = self::CleanArray(explode(',',$contentTypes));
		
		$where_ids          = array();
		$where_props        = array();
		$where_contentTypes = array();
		$params             = array();
		$select             = array();
		foreach($contentIds as $cId)
		{
			$where_ids[] = " C.content_id = ? ";
			$params[]    = $cId;
		}
		if(count($props)) 
		{
			$select[] = " CP.content ";
			$select[] = " CP.prop_name ";
			foreach($props as $p)
			{
				$where_props[] = " CP.prop_name = ? ";
				$params[]      = $p;
			}
		}
		foreach($attribs as $a)
			$select[] = " C.$a ";
		
		foreach($contentTypes as $t)
		{
			$where_contentTypes[] = " C.type = ? ";
			$params[]             = $t;
		}
		$query = "SELECT ";
		if(count($select))
			$query .= 'C.content_id,'.implode(',',$select);
		else
			$query .= " * ";
		
		$query .= " FROM " . cms_db_prefix() . "content_props CP
			LEFT JOIN " . cms_db_prefix() . "content C ON C.content_id = CP.content_id ";
		
		$where = array();
		if(count($where_ids))
			$where[] = ' ( ' . implode(' OR ',$where_ids) . ' ) ';
		
		if(count($where_props))
			$where[] = ' ( ' . implode(' OR ',$where_props) . ' ) ';
		
		if(count($where_contentTypes))
			$where[] = ' ( ' . implode(' OR ',$where_contentTypes) . ' ) ';
		
		if(count($where))
			$query .= " WHERE " . implode(' AND ', $where);
		
		if($limit)
			$query .= " LIMIT $limit";
		
		$dbresult = $db->Execute($query, $params);
		while($dbresult && $row = $dbresult->FetchRow())
		{
			$cId       = $row['content_id'];
			$ret[$cId] = array();
			unset($row['content_id']);
			if(count($props))
			{
				$ret[$cId][$row['prop_name']] = $row['content'];
				unset($row['prop_name']);
				unset($row['content']);
			}
			if(count($attribs))
				$ret[$cId] = array_merge($ret[$cId], $row);
		}
		return $ret;
	}
	
	/**
	 * Replaces all multiple slashes, dots and (multiple) backslashes with one single slash to make a clean secure url parameter
	 *
	 * @since 0.9.4
	 * @access public
	 *
	 * @param string $url - the url to clean
	 * @param string $full_url - true to prepend uploads url on return, false to return only the cleaned $url
	 *
	 * @return string - the clean url
	 */
	public static function CleanURL($url, $full_url = true)
	{
		$config = cmsms()->GetConfig();
		$url = trim(str_replace(array($config['uploads_path'],$config['uploads_url']), '', $url),'/'.DIRECTORY_SEPARATOR);
		$url = str_replace(DIRECTORY_SEPARATOR,'/',$url);
		$url = trim(preg_replace('/(\/\.)|(\.\/)|(\/?\.\.\/?)/','/',$url),'/');
		if($full_url)
		{
			$url = preg_replace('/\/+/','/', '/' . str_replace(array('http://', 'https://','www.'),'',$url) . '/');
			$url = $config['uploads_url'] . $url;
			return $url;
		}
		return trim(preg_replace('/\/+/','/',$url),'/');
	}
	
	/**
	 * @ignore
	 * @internal
	 * @access private
	 */
	public static function &GetInheritables($content_id = '')
	{
		$content_id = intval($content_id);
		if(!isset(self::$_variables['inheritables'][$content_id]))
			self::$_variables['inheritables'][$content_id] = self::$_variables['inheritables'][0];
		
		return self::$_variables['inheritables'][$content_id];
	}
	
	/**
	 * @ignore
	 * @internal
	 * @access private
	 */
	public static function cms_access()
	{
		if(self::is_frontend_request())
			return 'frontend';
		return 'backend';
	}
	
	/**
	 * @ignore
	 * @internal
	 * @access private
	 * @deprecated
	 */
	public static function is_frontend_request()
	{
		if(method_exists(cmsms(), 'is_frontend_request'))
			return cmsms()->is_frontend_request();
		
		global $CMS_ADMIN_PAGE;
		return isset($CMS_ADMIN_PAGE) && $CMS_ADMIN_PAGE === 1 ? false : true;
	}
	
	/**
	 * @ignore
	 * @internal
	 * @access private
	 */
	public static function CleanStrId($str)
	{
		return preg_replace('/-+/', '_', munge_string_to_url(strtolower(trim($str))));
	}
	
	/**
	 * @ignore
	 * @internal
	 * @access private
	 * @deprecated
	 */
	public static function &get_module($modulename)
	{
		return AdvancedContentModule::GetModuleInstance($modulename);
	}
	
	/**
	 * Checks if a frontend user is logged in and belongs to a certain group
	 * @param array|string $feu_groups - the allowed frontend user groups the user should belong to (array or csv)
	 * @return bool
	 */
	public static function FeuIsMemberOf($feu_groups)
	{
		$access = true;
		if(!is_array($feu_groups))
			$feu_groups = self::CleanArray(explode(',',$feu_groups));
		
		if( $feusers =& self::get_module('FrontEndUsers') && !empty($feu_groups))
		{
			$access = false;
			$userid = $feusers->LoggedInId();
			if($userid && $groups =& self::GetFeuGroups($userid))
			{
				foreach($groups as $onegroup)
				{
					#if(in_array($onegroup['groupid'],$feu_groups) || in_array($onegroup['groupname'],$feu_groups))
					if(in_array($onegroup['groupid'],$feu_groups))
					{
						$access = true;
						break;
					}
				}
			}
		}
		return $access;
	}
	
	/**
	 * Just gets all frontend user groups a frontend user belongs to
	 * and caches them in a member variable
	 * @param int $userid - the id of the user
	 * @return array
	 */
	private function GetFeuGroups($userid)
	{
		if(!$userid)
			return false;
		if( $feusers =& self::get_module('FrontEndUsers') && !self::$_feuGroups)
			self::$_feuGroups = $feusers->GetMemberGroupsArray($userid);
		return self::$_feuGroups;
	}
}
?>
