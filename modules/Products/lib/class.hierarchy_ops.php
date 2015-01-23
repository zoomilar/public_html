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

class hierarchy_ops
{
  private static $_allhierarchy;

  private static function _update_hierarchy_counts(&$data,$parent_id = -1)
  {
    $n = 0;
    foreach( $data as &$rec ) {
      if( !isset($rec['count']) ) continue;
      if( $rec['parent_id'] != $parent_id ) continue;
      if( $rec['count'] == 0 ) {
	$rec['count'] = self::_update_hierarchy_counts($data,$rec['id']);
      }
      $n += (int)$rec['count'];
    }
    return $n;
  }

  public static function get_all_hierarchy_info($count = FALSE, $all = TRUE)
  {
    if( !is_array(self::$_allhierarchy) ) self::$_allhierarchy = array();

    $db = cmsms()->GetDb();
    if( !$count ) {
      $key = 'nocount';

      if( !isset(self::$_allhierarchy[$key]) ) {
	$query = 'SELECT * FROM '.cms_db_prefix().'module_products_hierarchy';
	$tmp = $db->GetArray($query);
	if( is_array($tmp) && count($tmp) ) {
		foreach ($tmp as $key_h => $val_h) {
			$tmp[$key_h]['name'] = unserialize($tmp[$key_h]['name']);
			$tmp[$key_h]['description'] = unserialize($tmp[$key_h]['description']);
			$tmp[$key_h]['name2'] = unserialize($tmp[$key_h]['name2']);
			$tmp[$key_h]['description2'] = unserialize($tmp[$key_h]['description2']);
		}
	  $tmp = cge_array::to_hash($tmp,'id');
	}
	self::$_allhierarchy[$key] = $tmp;
      }
    }
    else {
      // all is only applicable here.
      $key = 'count';
      if( !isset(self::$_allhierarchy[$key]) ) {
	$db = cmsms()->GetDb();
	$query = 'SELECT ph.*,count(pr.id) AS count FROM '.cms_db_prefix().'module_products_hierarchy ph
                  LEFT OUTER JOIN '.cms_db_prefix().'module_products_prodtohier pth
                  ON ph.id = pth.hierarchy_id
                  LEFT OUTER JOIN '.cms_db_prefix().'module_products pr
                  ON pth.product_id = pr.id';
	if( !$all ) $query .' AND pr.status = '.$db->qstr('published');
	$query .= ' GROUP BY ph.id
                   ORDER BY ph.hierarchy';
	$tmp = $db->GetAll($query);
	if( is_array($tmp) && count($tmp) ) {
		foreach ($tmp as $key_h => $val_h) {
			$tmp[$key_h]['name'] = unserialize($tmp[$key_h]['name']);
			$tmp[$key_h]['description'] = unserialize($tmp[$key_h]['description']);
			$tmp[$key_h]['name2'] = unserialize($tmp[$key_h]['name2']);
			$tmp[$key_h]['description2'] = unserialize($tmp[$key_h]['description2']);
		}
	  $tmp = cge_array::to_hash($tmp,'id');
	}
	self::_update_hierarchy_counts($tmp);
	self::$_allhierarchy[$key] = $tmp;
      }
    }
    return self::$_allhierarchy[$key];
  }


  public static function get_hierarchy_info($hierarchy_id)
  {
    $allinfo = self::get_all_hierarchy_info();
    if( is_array($allinfo) && count($allinfo) && isset($allinfo[$hierarchy_id]) ) {
      return $allinfo[$hierarchy_id];
    }
  }


  public static function get_hierarchy_path($hier_id)
  {
    $out = array();
    while( $hier_id > 0 )
      {
	$out[] = $hier_id;

	$hier_info = self::get_hierarchy_info($hier_id);
	if( !$hier_info ) break;

	$hier_id = $hier_info['parent_id'];
	if( $hier_id < 0 ) break;
      }

    return array_reverse($out);
  }


  public static function get_breadcrumb($id,$hier_id,$hierpage,$delim = ' &gt; ', $params = array())
  {
    $hierarchy_path = self::get_hierarchy_path($hier_id);
    if( !$hierarchy_path ) return FALSE;

    $module = cms_utils::get_module('Products');
    $tmp = array();
	
	//print_r($hierarchy_path);
	if ($params['last_no_link'] == 1) {
		$end = array_pop($hierarchy_path);
		$end = hierarchy_ops::get_hierarchy_info($end);
		if (isset($params['kalba']) && @unserialize($end['name'])) {
			$tmp_ame = unserialize($end['name']);
			$end['name'] = $tmp_ame[$params['kalba']];
		} else if (isset($params['kalba']) && is_array($end['name'])) {
			$end['name'] = $end['name'][$params['kalba']];
		}
	}
	if (count($hierarchy_path) > 0) {
		foreach( $hierarchy_path as $one ) {
		  $info = hierarchy_ops::get_hierarchy_info($one);
			
		  if (isset($params['kalba']) && is_array($info['name'])) {
			$info['name'] = $info['name'][$params['kalba']];
		  }
		  
		  $link = $module->CreatePrettyLink($id,'default',$hierpage,
						$info['name'],array('hierarchyid' => $info['id']));
		
		  $tmp[] = $link;
		}
	}
	
	$prod_id = $module->GetCurrentProductId();
	if ($prod_id > 0) {
		$product_info = $module->GetFieldDefsForProduct($prod_id, true, true);
		if (is_array($product_info) && count($product_info) > 0) {
			foreach ($product_info as $vv) {
				if ($vv->name == $module->GetPreference('pavadinimas_field')) {
					$detailpage = $module->GetPreference('detail_page_field_'.$params['kalba']);
					$prettyurl = product_ops::pretty_url($prod_id, $detailpage, $params['kalba']);
					$tmp[] = $module->CreateLink($id,'details',$detailpage, $vv->value[$params['kalba']],array(), '',false,$inline,'',false,$prettyurl);
				}
			}
		}
		
	}
	
	if (isset($end)) {
		$tmp[] = $end['name'];
	}
	//print_r($tmp);
    if( $delim != '' ) {
      return implode($delim,$tmp);
    }
    return $tmp;
  }

  public static function get_flat_list($full = TRUE,$id = 'prod',$returndid = '')
  {
	 
    if( !function_exists('__hiertree_cb') ) {
      function __hiertree_cb(&$row) 
      {
		
		/*echo '<pre>';
		print_r($row);
		echo '</pre>';*/
		
		global $id,$returnid,$entryarray;
		$mod = cms_utils::get_module('Products');
		
		$db = $mod->GetDb();
		
		if( is_object($mod) ) {
		  $row['edit_url'] = $mod->CreateURL($id,'admin_edit_hierarchy_item',
							 $returnid,
							 array('hierarchy_id'=>$row['id']));
			$row['depth'] = count(explode('.', $row['hierarchy'])) - 1;
			$row['edit_link'] = $mod->CreateImageLink($id,'admin_edit_hierarchy_item',
								$returnid,
								$mod->Lang('edit_hierarchy_item'),
								'icons/system/edit.gif',
								array('hierarchy_id'=>$row['id']));
			$row['delete_link'] = $mod->CreateImageLink($id,'admin_delete_hierarchy_item',
								  $returnid,
								  $mod->Lang('delete_hierarchy_item'),
								  'icons/system/delete.gif',
								  array('hierarchy_id'=>$row['id']),'',
								  $mod->Lang('confirm_delete_hierarchy_node'));
			
			$query_test = "SELECT COUNT(product_id) AS pcount FROM ".cms_db_prefix()."module_products_prodtohier WHERE hierarchy_id = ? GROUP BY hierarchy_id";
			$pr_count = $db->GetOne($query_test, array($row['id']));
			if ($pr_count > 0) {
				$row['product_order_url'] = $mod->CreateURL($id,'admin_order_hierarchy_products',
							 $returnid,
							 array('hierarchy_id'=>$row['id']));
			} else {
				$query1 = "SELECT name FROM ".cms_db_prefix()."module_products_hierarchy WHERE id = ?";
				$name_arr = $db->GetOne($query1, array($row['id']));
				$name_arr = unserialize($name_arr);
				$name = $name_arr['lt'];
				
				$query2 = "SELECT COUNT(B.product_id) AS pcount, '1' AS grp FROM ".cms_db_prefix()."module_products_hierarchy AS A LEFT JOIN ".cms_db_prefix()."module_products_prodtohier AS B ON B.hierarchy_id = A.id WHERE long_name LIKE '%".$name." | %' GROUP BY grp";
				
				//echo $row['id'].' '.$query2.'<br/>';
				
				$rrrx = $db->GetRow($query2, array());
				$pr_count = $rrrx['pcount'];
				if ($pr_count > 0) {
					$row['product_order_url'] = $mod->CreateURL($id,'admin_order_hierarchy_products',
						$returnid,
						array('hierarchy_id'=>$row['id']));
					
				}
				
			}
		  $entryarray[] = $row;
		}
      }

      function __hiertree_flatten($tree,&$entryarray)
      {
	if( is_array($tree) && count($tree) ) {
	  foreach( $tree as $one ) {
	    $copy = $one;
	    unset($copy['children']);
	    $entryarray[] = $copy;
	    if( isset($one['children']) ) {
	      __hiertree_flatten($one['children'],$entryarray);
	    }
	  }
	}
      } // function.
    }

    $entryarray = array();
    $cb = '';
    if( $full ) $cb = '__hiertree_cb';
    $tree = product_utils::hierarchy_get_tree(-1,0,$cb);

    __hiertree_flatten($tree,$entryarray);
	//echo '<pre>';
	//print_r($entryarray);
    return $entryarray;
  }
  public static function get_hierarchy_alias($id, $lang) {
	$db = cmsms()->GetDb();
	
	$query = "SELECT alias FROM ".cms_db_prefix()."module_products_hierarchy_linknames WHERE hier_id = ? AND lang = ?";
	$rr = $db->GetOne($query, array($id, $lang));
	return $rr;
  }
} // end of class

#
# EOF
#
?>