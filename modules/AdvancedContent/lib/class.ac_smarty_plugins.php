<?php

final class ac_smarty_plugins
{
	/**
	 * Smarty Plugin : {get_global_contents}
	 * Purpose       : This plugin displays properties of global content blocks of CMSms 
	 *                 divided by a separator
	 * Author        : Georg Busch (NaN)
	 * Copyright     : 2010 - 2012 Georg Busch (NaN)
	 * Version       : 1.0
	 * License       : GPL
	 */
	public static function get_global_contents($params, &$obj) 
	{
		if(version_compare(CMS_VERSION, '1.11') < 0)
			$smarty = &$obj; # backward compatibility
		else
			$smarty = &$obj->smarty;
		
		$gcbs = cmsms()->GetGlobalContentOperations()->LoadHtmlBlobs();
		
		$delimiter = "<hr />";
		if(isset($params['delimiter']) && trim($params['delimiter']) != '')
			$delimiter = trim($params['delimiter']);
		
		$excl_prefix = array();
		$incl_prefix = array();
		$excl_sufix  = array();
		$incl_sufix  = array();
		
		if(isset($params['excl_prefix']))
			$excl_prefix = ac_utils::CleanArray(explode(',',$params['excl_prefix']));
		
		if(isset($params['excl_sufix']))
			$excl_sufix = ac_utils::CleanArray(explode(',',$params['excl_sufix']));
		
		if(isset($params['incl_prefix']))
			$incl_prefix = ac_utils::CleanArray(explode(',',$params['incl_prefix']));
		
		if(isset($params['incl_sufix']))
			$incl_sufix = ac_utils::CleanArray(explode(',',$params['incl_sufix']));
		
		$assign_as = 'string';
		if(isset($params['assign_as']))
			$assign_as = $params['assign_as'];
		
		$output = 'content'; // name, id, owner, modified_date, full_object
		if(isset($params['output']))
			$output = $params['output'];
		
		$sort_by = 'id';
		if(isset($params['sort_by']))
			$sort_by = $params['sort_by'];
		
		$sort_order = 'asc';
		if(isset($params['sort_order']))
			$sort_order = $params['sort_order'];
		
		$gcb_array = array();
		foreach($gcbs as $gcb)
		{
			$skip = false;
			foreach($excl_prefix as $str) 
			{
				if(startswith($gcb->name,$str)) 
				{
					$skip = true;
					break;
				}
			}
			if($skip) continue;
			
			foreach($incl_prefix as $str)
			{
				if(!startswith($gcb->name,$str)) 
				{
					$skip = true;
					break;
				}
			}
			if($skip) continue;
			
			foreach($excl_sufix as $str)
			{
				if(endswith($gcb->name,$str)) 
				{
					$skip = true;
					break;
				}
			}
			if($skip) continue;
			
			foreach($incl_sufix as $str)
			{
				if(!endswith($gcb->name,$str)) 
				{
					$skip = true;
					break;
				}
			}
			if($skip) continue;
			
			switch($sort_by)
			{
				case 'name':
					if($output == 'full_object')
					{
						$gcb_array[$gcb->name] = $gcb;
						break;
					}
					$gcb_array[$gcb->name] = $gcb->$output;
					break;
				
				case 'modified_date':
					if($output == 'full_object')
					{
						$gcb_array[$gcb->modified_date] = $gcb;
						break;
					}
					$gcb_array[$gcb->modified_date] = $gcb->$output;
					break;
					
				case 'owner':
				case 'owner+create_date':
				case 'owner+id':
					if($output == 'full_object')
					{
						$gcb_array[$gcb->owner . '_' . $gcb->id] = $gcb;
						break;
					}
					$gcb_array[$gcb->owner . '_' . $gcb->id] = $gcb->$output;
					break;
					
				case 'owner+name':
					if($output == 'full_object')
					{
						$gcb_array[$gcb->owner . '_' . $gcb->name] = $gcb;
						break;
					}
					$gcb_array[$gcb->owner . '_' . $gcb->name] = $gcb->$output;
					break;
					
				case 'owner+modified_date':
					if($output == 'full_object')
					{
						$gcb_array[$gcb->owner . '_' . $gcb->modified_date] = $gcb;
						break;
					}
					$gcb_array[$gcb->owner . '_' . $gcb->modified_date] = $gcb->$output;
					break;
				
				case 'id':
				case 'create_date':
				default:
					if($output == 'full_object')
					{
						$gcb_array[$gcb->id] = $gcb;
						break;
					}
					$gcb_array[$gcb->id] = $gcb->$output;
					break;
			}
		}
		
		if($sort_order == 'desc')
			krsort($gcb_array);
		else
			ksort($gcb_array);
		
		if(isset($params['assign']))
		{
			if($assign_as == "array") {
				$smarty->assign($params['assign'],$gcb_array);
				return;
			}
			$smarty->assign($params['assign'],implode($delimiter, $gcb_array));
			return;
		}
		return implode($delimiter, $gcb_array);
	}
	
	public static function get_gcb_list($params, &$obj)
	{
		$config = cmsms()->GetConfig();
		if($config['debug'])
			trigger_error("Usage of AdvancedContent plugin 'get_gcb_list' is deprecated. Use 'get_global_contents' instead.", E_USER_WARNING);
		return self::get_global_contents($params, $obj);
	}
}

?>
