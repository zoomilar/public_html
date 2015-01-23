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


final class product_ops
{
  static private $_fielddefs;
  static private $_prodhier;
  static private $_product_cache;

  static public function set_product($product)
  {
    if( !is_array($product) || !isset($product['id']) ) return;
    if( !is_array(self::$_product_cache) ) self::$_product_cache = array();
    self::$_product_cache[$product['id']] = $product;
  }

  static public function get_product($product_id)
  {
    if( is_array(self::$_product_cache) && isset(self::$_product_cache[$product_id]) ) {
      return self::$_product_cache[$product_id];
    }

    $query = new products_query();
    $query['product_id'] = $product_id;
	
	/*echo '<pre>';
	print_r($query);
	echo '</pre>';
	die;*/
	
    $results = new products_resultset($query);
    if( $results->RecordCount() > 1 ) {
      throw new Exception('INTERNAL ERROR: More than one product with the id '.$product_id);
    }
    
    if( !is_array(self::$_product_cache) ) self::$_product_cache = array();
    self::$_product_cache[$product_id] = $results->fields;
    if( $product_id != $results->fields['id'] ) {
      throw new Exception('INTERNAL ERROR: query did not return information for '.$product_id);
    }
    return self::$_product_cache[$product_id];
  }

  static public function is_valid_category($name)
  {
    $db = cmsms()->GetDb();
    $query = 'SELECT id FROM '.cms_db_prefix().'module_products_categories
               WHERE name = ?';
    $tmp = $db->GetOne($query,array($name));
    if( $tmp ) return TRUE;
    return FALSE;
  }


  public static function is_valid_product_id($pid)
  {
    $db = cmsms()->GetDb();
    $query = 'SELECT id FROM '.cms_db_prefix().'module_products 
               WHERE id = ?';
    $tmp = $db->Execute($query,array($pid));
    if( $tmp ) return TRUE;
    return FALSE;
  }


  public static function is_valid_hierarchy($str)
  {
    // accept string of "name.name.name.name" and 
    // convert into "name | name | name | name";
    $tmp = explode('.',$str);
    $tmp2 = array();
    foreach( $tmp as $one )
      {
	$tmp2[] = trim(trim($one,'"'));
      }
    $tmp3 = implode(' | ',$tmp2);

    $db = cmsms()->GetDb();
    $query = 'SELECT id FROM '.cms_db_prefix().'module_products_hierarchy
               WHERE long_name = ?';
    $tmp = $db->GetOne($query,array($tmp3));
    if( !$tmp ) return FALSE;
    return TRUE;
  }


  public static function check_sku_used($sku,$productid = '',$productonly = false)
  {
    $db = cmsms()->GetDb();
    $query = 'SELECT id FROM '.cms_db_prefix().'module_products
               WHERE sku = ?';
    $parms = array($sku);
    if( !empty($productid) )
      {
	$query .= ' AND id != ?';
	$parms[] = $productid;
      }
    $tmp = $db->GetOne($query,$parms);
    if( $tmp ) return TRUE;

    if( !$productonly )
      {
	$query = 'SELECT id FROM '.cms_db_prefix().'module_products_attributes
                   WHERE sku = ?';
	$tmp = $db->GetOne($query,array($sku));
	if( $tmp ) return TRUE;
      }

    return FALSE;
  }


  static public function check_alias_used($alias,$productid = '')
  {
    global $gCms;
    $db = $gCms->GetDb();

    $parms = array();
    $parms[] = $alias;
    $query = 'SELECT id FROM '.cms_db_prefix().'module_products
               WHERE alias = ?';
    if( !empty($productid) )
      {
	$query .= 'AND id != ?';
	$parms[] = (int)$productid;
      }
    $tmp = $db->GetOne($query,$parms);
    if( !$tmp ) return FALSE;
    return TRUE;
  }


  static public function generate_alias($product_name, $product_id = 0)
  {
    $str = munge_string_to_url($product_name);
    $postfix = '';
    
    while( $postfix < 1000 )
      {
		$alias = $str.$postfix;
		if ($product_id > 0) {
			if( !self::check_alias_used($alias, $product_id)) {
				return $alias;
			}
		} else {
			if( !self::check_alias_used($alias)) {
				return $alias;
			}
		}
		if( $postfix == '' ) $postfix = 1;
		$postfix++;
      }

    return FALSE;
  }


  // creates a product detail url.
  static public function pretty_url($pid,$returnid = '', $kalba = '')
  {
	
    $module = cms_utils::get_module('Products');
    $product = self::get_product($pid);
    if( !$product ) return;
    $db = cmsms()->GetDB();
    //print_r($product);
    $usereturnid = true;    
    if( $returnid == -1 )
      {
	global $gCms;
	$contentops = $gCms->GetContentOperations();
	$returnid = $contentops->GetDefaultContent();
      }
    $dfltreturnid = $module->GetPreference('detailpage',-1);
    if( $dfltreturnid == $returnid || $returnid == '' )
      {
	$usereturnid = false;
	$returnid = $dfltreturnid;
      }

    $pretty_url = $module->GetPreference('urlprefix',$module->GetName());
	
	// detailo nauji url
	$lng_for_p = $module->GetPreference('kalbos', 'lt');
	$lng_for_p = explode(',', $lng_for_p);
	$lang = '';
	$page_name = '';
	if (is_array($lng_for_p) && count($lng_for_p) > 0) {
		foreach ($lng_for_p as $val) {
			if ($module->GetPreference('detail_page_field_'.$val) == $returnid) {
				$lang = $val;
				$page_name = $module->GetPreference('detail_page_names_field_'.$val);
			}
		}
	}
	if (!empty($page_name)) {
		$pretty_url = $page_name;
	}
	// end detailo nauji url
	
	
    $done = false;
	//buvo hier_id pakiciau i hierarchy_id
	
    if( $module->GetPreference('usehierpathurls',0) && !empty($product['alias']) && ($product['hierarchy_id'] > 0) )
      {
	 
	$hier_id = self::get_product_hierarchy_id($pid);
	
	if( $hier_id )
	  {
		
	    $tmp = hierarchy_ops::get_hierarchy_info($hier_id);
		
	    if( $tmp )
	      {
			if (!empty($kalba)) {
				$path = hierarchy_ops::get_hierarchy_alias($hier_id, $kalba);
			} else {
				$tmp2 = explode(' | ',$tmp['long_name']);
				for( $i = 0; $i < count($tmp2); $i++ ) {
					$tmp2[$i] = munge_string_to_url($tmp2[$i]);
				}
				$path = implode('/', $tmp2);
			}
		
		//$pretty_url .= '/details';
		/*$pretty_url .= "/$pid";
		if( $usereturnid )
		  {
		    $pretty_url .= "/$returnid";
		  }

		if( !empty($path) )
		  {
		    $pretty_url .= "/$path";
		  }
		*/
		$pretty_url .= "/".$product['alias'];
		
		
		$done = true;
	      }
	  }
      }

    if( !$done ) {
		//echo $pretty_url.'<br/>';
		/*$pretty_url .= "/$pid";
		if( $usereturnid ) {
			$pretty_url .= "/$returnid";
		}*/
		$alias = $product['alias'];
		if( empty($alias) ) {
			$alias = $module->make_alias($product['product_name']);
		}
		$pretty_url .= "/$alias";
    }
	
	
    return $pretty_url;
  }


  public static function get_product_hierarchy_id($productid)
  {
    if( !is_array(self::$_prodhier) || !isset(self::$_prodhier[$productid]) )
      {
	$db = cmsms()->GetDb();
	$query = 'SELECT hierarchy_id FROM '.cms_db_prefix().'module_products_prodtohier
              WHERE product_id = ? LIMIT 1';
	$hier_id = $db->GetOne($query,array($productid));
	if( $hier_id <= 0 ) return FALSE;
	if( !is_array(self::$_prodhier) )
	  {
	    self::$_prodhier = array();
	  }
	self::$_prodhier[$productid] = $hier_id;
      }
    return self::$_prodhier[$productid];
  }


  /* deprecated */
  public static function get_product_hierarchy_path($productid)
  {
    $hier_id = self::get_product_hierarchy_id($productid);
    if( $hier_id )
      {
	return hierarchy_ops::get_hierarchy_path($hier_id);
      }
  }


  /* deprecated */
  public static function create_hierarchy_breadcrumb($id,$product_id, $hierpage, $delim = ' &gt; ')
  {
    $hier_id = self::get_product_hierarchy_id($product_id);
    if( $hier_id <= 0 ) return FALSE;
    return hierarchy_ops::get_breadcrumb($id,$hier_id,$hierpage,$delim);
  }


  public static function get_search_result($returnid, $productid, $attr = '', $kalba = '')
  {
	
	//echo $kalba;
    $result = array();
    $mod = cms_utils::get_module('Products');
    
    if ($attr != 'product')
      {
	return $result;
      }

    if( $mod->GetPreference('use_detailpage_for_search',0) )
      {
	$returnid = '';
      }
	
	$pavadinimas_field = $mod->GetPreference('pavadinimas_field');
	
	
    $db = $mod->GetDb();
    
	
	$q = "SELECT product_name FROM ".cms_db_prefix()."module_products WHERE
			      id = ?";
    $dbresult = $db->Execute( $q, array( $productid ) );
    if ($dbresult)
      {
	$row = $dbresult->FetchRow();
	
	//0 position is the prefix displayed in the list results.
	$result[0] = $mod->GetFriendlyName();
	
	//1 position is the title
	if (!empty($pavadinimas_field)) {
	
		$query1 = "SELECT id FROM ".cms_db_prefix()."module_products_fielddefs WHERE name = ? ";
		$dbresult1 = $db->Execute( $query1, array($pavadinimas_field) );
		if ($dbresult1) {	
			
			$row1 = $dbresult1->FetchRow();
			$query = "SELECT value_".$row1['id']." AS val FROM ".cms_db_prefix()."module_products_fieldvals WHERE product_id = ? ";
			
			$dbresult2 = $db->Execute( $query, array( $productid) );
			//echo $db->sql;
			if ($dbresult2) {
				
				$row2 = $dbresult2->FetchRow();
				
				if ($kalba != '') {
					$tt = unserialize($row2['val']);
					$result[1] = $tt[$kalba];
				} else {
					$result[1] = $tt;
				}
			} else {
				$result[1] = $row['product_name'];
			}
		} else {
			$result[1] = $row['product_name'];
		}	
	} else {
		$result[1] = $row['product_name'];
	}
	//2 position is the URL to the title.
	$prettyurl = self::pretty_url($productid,$returnid);
	$result[2] = $mod->CreateLink('cntnt01', 'details', $returnid, '', array('productid' => $productid) ,
				      '', true, false, '', true, $prettyurl);
      }
    
    return $result;
  }
	

  public static function get_currency_symbol()
  {
    if( class_exists('cg_ecomm') )
      {
	return cg_ecomm::get_currency_symbol();
      }
    $mod = cms_utils::get_module('Products');
    return $mod->GetPreference('products_currencysymbol','$');
  }


  public static function get_weight_units()
  {
    if( class_exists('cg_ecomm') )
      {
	return cg_ecomm::get_weight_units();
      }
    $mod = cms_utils::get_module('Products');
    return $mod->GetPreference('products_weightunits','kg');
  }

  
  public static function get_length_units()
  {
    if( class_exists('cg_ecomm') )
      {
	return cg_ecomm::get_length_units();
      }
    $mod = cms_utils::get_module('Products');
    return $mod->GetPreference('products_lengthunits','kg');
  }

  
  public static function get_fields()
  {
    if( !is_array(self::$_fielddefs) )
      {
	global $gCms;
	$db = $gCms->GetDb();
	
	$query = 'SELECT * FROM '.cms_db_prefix().'module_products_fielddefs ORDER BY item_order';
	self::$_fielddefs = $db->GetArray($query);
      }
    return self::$_fielddefs;
  }


  public static function get_field_options($type = '')
  {
    $tmp = self::get_fields();
    if( !is_array($tmp) ) return;

    $result = array();
    for( $i = 0; $i < count($tmp); $i++ )
      {
	if( $type == '' || $tmp[$i]['type'] == $type )
	  {
	    $result[$tmp[$i]['id']] = $tmp[$i]['prompt'];
	  }
      }
    return $result;
  }


  public static function get_product_attributes_full($product_id)
  {
    $db = cmsms()->GetDb();
    $data = array();

    $query = 'SELECT * FROM '.cms_db_prefix().'module_products_attribsets
              WHERE product_id = ?';
    $tmp = $db->GetArray($query,array($product_id));	

    $tmp2 = cge_array::extract_field($tmp,'attrib_set_id');
    $q2 = 'SELECT * FROM '.cms_db_prefix().'module_products_attributes
            WHERE attrib_set_id IN ('.implode(',',$tmp2).') ORDER BY attrib_set_id ASC';
    $tmp3 = $db->GetArray($q2);

    for( $i = 0; $i < count($tmp); $i++ )
      {
	$row =& $tmp[$i];

	$attribs = array();
	for( $j = 0; $j < count($tmp3); $j++ )
	  {
	    $row2 =& $tmp3[$j];
	    if( $row2['attrib_set_id'] < $row['attrib_set_id'] ) continue;
	    if( $row2['attrib_set_id'] > $row['attrib_set_id'] ) break;

	    $attribs[$row2['attrib_text']] = $row2;
	  }
	$data[$row['attrib_set_name']] = $attribs;
      }

    if( !count($data) ) return false;
    return $data;
  }
} // class


#
# EOF
#
?>
