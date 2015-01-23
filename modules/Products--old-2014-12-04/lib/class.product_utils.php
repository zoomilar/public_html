<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Products (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow users to create, manage
#  and display products in a variety of ways.
# 
# Version: 1.1.5
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin 
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE

final class product_utils
{
  protected function __construct() {}
  private static $_category_cache;
  static private $_flddef_cache;

  static public function get_field_types($selectone = false)
  {
    $mod = cge_utils::get_module('Products');
    $items = array();
    if( $selectone )
      {
	$items[$mod->Lang('select_one')] = '';
      }
    $items[$mod->Lang('textbox')] = 'textbox';
    $items[$mod->Lang('checkbox')] = 'checkbox';
    $items[$mod->Lang('textarea')] = 'textarea';
    $items[$mod->Lang('textarea_multi')] = 'textarea_multi';
    $items[$mod->Lang('dropdown')] = 'dropdown';
	$items[$mod->Lang('checkboxgroup')] = 'checkboxgroup';
    $items[$mod->Lang('imagetext')] = 'image';
    $items[$mod->Lang('file')] = 'file';
    $items[$mod->Lang('dimensions')] = 'dimensions';
    $items[$mod->Lang('subscription')] = 'subscription';
    $items[$mod->Lang('quantity_on_hand')] = 'quantity';
    return array_flip($items);
  }


  public static function get_displayable_fieldval($fieldname,$fieldval)
  {
    $mod = cge_utils::get_module('Products');
    $fields = product_ops::get_fields();
    $fields = cge_array::to_hash($fields,'name');
    $fieldtype = $fields[$fieldname]['type'];
    $res = $fieldval;
    switch( $fieldtype )
      {
      case 'checkbox':
	if( !is_null($res) )
	  $res = $mod->Lang('prompt_'.$res);
	break;
      case 'textarea':
	$res = '';
	break;
      case 'dropdown':
      case 'image':
      case 'file':
	break;
      case 'dimensions':
	{
	  if( is_array($res) && $res['length'] > 0 && $res['width'] > 0 && $res['height'] > 0 )
	    {
	      $res = sprintf('%s: %d, %s: %d, %s: %d',
			     $mod->Lang('abbr_length'),$res['length'],
			     $mod->Lang('abbr_width'),$res['width'],
			     $mod->Lang('abbr_height'),$res['height']);
	    }
	  else
	    {
	      $res = $mod->Lang('none');
	    }
	}
	break;
      case 'subscription':
	{
	  if( is_array($res) && $res['payperiod'] != -1 && $res['delperiod'] != -1 )
	    {
	      $subscribe_opts = array();
	      $subscribe_opts[-1] = $mod->Lang('none');
	      $subscribe_opts['monthly'] = $mod->Lang('subscr_monthly');
	      $subscribe_opts['quarterly'] = $mod->Lang('subscr_quarterly');
	      $subscribe_opts['semianually'] = $mod->Lang('subscr_semianually');
	      $subscribe_opts['yearly'] = $mod->Lang('subscr_yearly');

	      $expire_opts = array();
	      $expire_opts[$mod->Lang('none')] = -1;
	      $expire_opts[$mod->Lang('expire_six_month')] = '6';
	      $expire_opts[$mod->Lang('expire_one_year')] = '12';
	      $expire_opts[$mod->Lang('expire_two_year')] = '24';
	      $expire_opts = array_flip($expire_opts);

	      $expiry = 'none';
	      if( $fieldval['expire'] != -1 )
		{
		  $expiry = $fieldval['expire'];
		}
	      $res = sprintf('%s: %s, %s: %s, %s: %s',
			     $mod->Lang('subscr_payperiod2'),$fieldval['payperiod'],
			     $mod->Lang('subscr_delperiod2'),$fieldval['delperiod'],
			     $mod->Lang('subscr_expiry2'),$expiry);
	    }
	  else
	    {
	      $res = $mod->Lang('none');
	    }
	}
	break;
      }

    return $res;
  }


  static public function hierarchy_get_tree($parent_id = -1,$showall = 0,$callback_fn = '')
  {
	//echo '<pre>';
    $hierarchy_map = hierarchy_ops::get_all_hierarchy_info(TRUE,$showall);
    if( !is_array($hierarchy_map) || count($hierarchy_map) == 0 ) return FALSE;
	//print_r($hierarchy_map);
    $out = array();
    foreach( $hierarchy_map as $onehier ) {
		//echo $onehier['parent_id'].' '.$parent_id.'<br/>';
      if( $onehier['parent_id'] != $parent_id ) continue;
      if( $callback_fn != '' && function_exists($callback_fn) ) {
			$callback_fn($onehier);
			
      }
	  
      $tmp = self::hierarchy_get_tree($onehier['id'],$showall,$callback_fn);
      if( is_array($tmp) && count($tmp) ) {
			$onehier['children'] = $tmp;
      }
	  //print_r($onehier);
	  if (@unserialize($onehier['name'])) {
		$onehier['name'] = unserialize($onehier['name']);
	  }
		 //print_r($onehier);
	  if (@unserialize($onehier['long_name'])) {
		$onehier['long_name'] = unserialize($onehier['long_name']);
		//print_r( $onehier['long_name']); 
	  }
	  
	  if (@unserialize($onehier['description'])) {
		$onehier['description'] = unserialize($onehier['description']);
	  }
	  
	  if (@unserialize($onehier['name2'])) {
		$onehier['name2'] = unserialize($onehier['name2']);
	  }
	  
	  if (@unserialize($onehier['description2'])) {
		$onehier['description2'] = unserialize($onehier['description2']);
	  }
	  
      $out[] = $onehier;
    }
    return $out;
  }


  public static function update_hierarchy_positions($langs = false)
  {
    $db = cmsms()->GetDb();
	
    $query = "SELECT id, item_order, name FROM ".cms_db_prefix()."module_products_hierarchy";
    $dbresult = $db->Execute($query);
    if( !$dbresult ) { echo $db->sql.'<br/>'; die( $db->ErrorMsg() ); }
    while ($dbresult && $row = $dbresult->FetchRow())
      {
	$current_hierarchy_position = "";
	$current_long_name = "";
	$content_id = $row['id'];
	$current_parent_id = $row['id'];
	$count = 0;
	if ($langs != false && is_array($langs)) {
		$do_langs = true;
		$current_long_name_lang_arr = array();
	} else {
		$do_langs = false;
	}
	while ($current_parent_id > -1)
	  {
	    $query = "SELECT id, item_order, name, parent_id FROM ".cms_db_prefix()."module_products_hierarchy 
                     WHERE id = ?";
	    $row2 = $db->GetRow($query, array($current_parent_id));
	    if ($row2)
	      {
		$current_hierarchy_position = str_pad($row2['item_order'], 5, '0', STR_PAD_LEFT) . "." . $current_hierarchy_position;
		if (@unserialize($row2['name'])) {
			$row2['name'] = unserialize($row2['name']);
			if ($do_langs) {
				foreach ($langs as $kalba) {
					$current_long_name_lang_arr[$kalba][] = $row2['name'][$kalba];
				}
			}
			
			$row2['name'] = $row2['name']['lt'];
		}
		$current_long_name = $row2['name'] . ' | ' . $current_long_name;
		$current_parent_id = $row2['parent_id'];
		$count++;
	      }
	    else
	      {
		$current_parent_id = 0;
	      }

	  }
	
	if (strlen($current_hierarchy_position) > 0)
	  {
	    $current_hierarchy_position = substr($current_hierarchy_position, 0, strlen($current_hierarchy_position) - 1);
	  }
		  
	if (strlen($current_long_name) > 0)
	  {
	    $current_long_name = substr($current_long_name, 0, strlen($current_long_name) - 3);
	  }
	  
	$query = "UPDATE ".cms_db_prefix()."module_products_hierarchy 
                  SET hierarchy = ?, long_name = ? WHERE id = ?";
	$db->Execute($query, array($current_hierarchy_position, $current_long_name, $content_id));
	
		///dadedam_linkus
		
		if ($do_langs) {
			foreach ($langs as $kalba) {
				$query = "SELECT id FROM ".cms_db_prefix()."module_products_hierarchy_linknames WHERE hier_id = ? AND lang = ?";
				$t_id = $db->GetOne($query, array($content_id, $kalba));
				
				$tmp = array();
				//print_r($current_long_name_lang_arr); die;
				foreach ($current_long_name_lang_arr[$kalba] as $val) {
					$tmp[] = munge_string_to_url($val, true);
				}
				$tmp = array_reverse($tmp);
				$path = implode('/',$tmp);
				
				if ($t_id > 0) {
					$query = "UPDATE ".cms_db_prefix()."module_products_hierarchy_linknames SET alias = ? WHERE id = ?";
					$db->Execute($query, array($path, $t_id));
				} else {
					$query = "INSERT INTO ".cms_db_prefix()."module_products_hierarchy_linknames SET hier_id = ?, lang = ?, alias = ?";
					$db->Execute($query, array($content_id, $kalba, $path));
				}
			}
		}
      }
  }


  public static function hierarchy_save_tree($tree,$depth = 0,$update_hierarchy = TRUE)
  {
    $query = 'UPDATE '.cms_db_prefix().'module_products_hierarchy 
              SET parent_id = ?, item_order = ? WHERE id = ?';
    $db = cmsms()->GetDb();
    foreach( $tree as &$node )
      {
	$dbr = $db->Execute($query,array($node['parent_id'],$node['item_order'],$node['id']));
	if( isset($node['children']) )
	  {
	    self::hierarchy_save_tree($node['children'],$depth+1);
	  }
      }

    if( $depth == 0 && $update_hierarchy )
      {
	self::update_hierarchy_positions();
      }
  }


  public static function get_categories($by_name = FALSE)
  {
    if( is_null(self::$_category_cache) ) {
      $db = cmsms()->GetDb();
      $query = 'SELECT * FROM '.cms_db_prefix().'module_products_categories ORDER BY name ASC';
      $tmp = $db->GetArray($query);
      self::$_category_cache = FALSE;
      if( is_array($tmp) && count($tmp) ) {
	self::$_category_cache = array();
	foreach( $tmp as $row ) {
	  $row = cge_array::to_object($row);
	  self::$_category_cache[$row->id] = $row;
	}
      }
    }

    if( !$by_name ) {
      return self::$_category_cache;
    }

    if( is_array(self::$_category_cache) ) {
      $out = array();
      foreach( self::$_category_cache as $row ) {
	$out[$row->name] = $row;
      }
      return $out;
    }
  }

  public static function get_full_categories($by_name = FALSE)
  {
    $categories = self::get_categories();
    if( !is_array($categories) || count($categories) == 0 ) {
      return;
    }
    
    $keys = array_keys($categories);
    $fid = $keys[0]; // first field.
    if( !isset(self::$_category_cache[$fid]->data) ) {
      // we're gonna use the same cache again...
      $db = cmsms()->GetDb();
      $query = 'SELECT * FROM '.cms_db_prefix().'module_products_category_fields ORDER BY category_id,field_order';
      $dbr = $db->GetArray($query);
      foreach( $keys as $one ) {
	$cat =& self::$_category_cache[$one];
	if( !isset($cat->data) ) $cat->data = array();
	for( $i = 0; $i < count($dbr); $i++ ) {
	  $catid = $dbr[$i]['category_id'];
	  $cat->data[] = $dbr[$i];
	}
      }
    }

    if( !$by_name ) {
      return self::$_category_cache;
    }

    if( is_array(self::$_category_cache) ) {
      $out = array();
      foreach( self::$_category_cache as $row ) {
	$out[$row->name] = $row;
      }
      return $out;
    }
  }

  static public function get_fielddefs($admin = false,$public = true)
  {
    if( !is_array(self::$_flddef_cache) ) {
      $entryarray = array();
      $db = cmsms()->GetDB();
		
      if( $admin == true && $public == true ) {
	$query = 'SELECT * FROM '.cms_db_prefix().'module_products_fielddefs ORDER BY item_order';
      }
      else if( $public == true ) {
	$query = 'SELECT * FROM '.cms_db_prefix().'module_products_fielddefs WHERE public > 0 ORDER BY item_order';
      }
      else {
	$query = 'SELECT * FROM '.cms_db_prefix().'module_products_fielddefs WHERE admin_only <= 0 ORDER BY item_order';
      }
      $dbresult = $db->GetArray($query);
		
      if( is_array($dbresult) ) {
	foreach( $dbresult as $row ) {
	  $onerow = new stdClass();
				
	  $onerow->id = $row['id'];
	  $onerow->name = $row['name'];
	  $onerow->prompt = $row['prompt'];
	  $onerow->prompts = unserialize($row['prompts']);
	  $onerow->type = $row['type'];
	  $onerow->group = $row['group'];
	  $tmp = explode("\n",$row['options']);
	  $tmp2 = array();
	  foreach( $tmp as $one ) {
	    $one = trim($one);
	    $tmp2[$one] = $one;
	  }
	  $onerow->options = $tmp2;
	  $onerow->optionslng = unserialize($row['optionslng']);
	  $onerow->max_length = $row['max_length'];
	  $onerow->requ_lang = $row['requ_lang'];
	  $entryarray[] = $onerow;
	}
      }
      self::$_flddef_cache = $entryarray;
    }
		
    return self::$_flddef_cache;
  }

  public static function can_do_pretty($action,$params) {
    if( !isset($params['notpretty']) ) return TRUE;

    if( strpos($params['notpretty'],'all') !== FALSE || strpos($params['notpretty'],$action) !== FALSE ) {
      return FALSE;
    }

    return TRUE;
  }
} // product utils

#
# EOF
#
?>