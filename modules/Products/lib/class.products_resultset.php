<?php  /* -*- Mode: PHP; tab-width: 4; c-basic-offset: 2 -*- */
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Products (c) 2012 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow users to create, manage
#  and display products in a variety of ways.
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

final class products_resultset
{
  private $_query;
  private $_rs;
  private $_totalmatchingrows;
  private $_category_cache;
  private $_field_cache;
  private $_attribute_cache;
  private $_detailpage;
  private $_hierpage;
  private $_curpage;
  private $_notpretty;
  private $_detailtemplate;

  public function __construct(products_query $query)
  {
    $this->_query = $query;
  }

  private function _execute()
  {
	if( !is_null($this->_rs) ) return;
    $db = cmsms()->GetDb();
    $obj = $this->_query;

    $query = 'SELECT SQL_CALC_FOUND_ROWS C.*,PH.hierarchy_id FROM '.cms_db_prefix().'module_products C';
    $where = array();
    $qparms = array();
    $joins = array();

	$joins[] = cms_db_prefix().'module_products_prodtohier PH ON PH.product_id = C.id';

	if( isset($obj['product_id']) && $obj['product_id'] != '' ) {
	  $where[] = 'C.id = ?';
	  $qparms[] = $obj['product_id'];
	}
	else if( isset($obj['productlist']) && $obj['productlist'] != '' ) {
	  $tmp = $obj['productlist'];
	  if( !is_array($tmp) ) {
		$tmp = explode(',',$tmp);
	  }
	  $list = array();
	  foreach( $tmp as $one ) {
		$one = (int)$one;
		if( $one > 0 ) $list[] = (int)$one;
      }
	  $list = array_unique($list);
	  $where[] = 'C.id IN ('.implode(',',$list).')';
	}

	if( isset($obj['status']) && $obj['status'] != '*') {
	  $val = $obj['status'];
	  if( startswith($val,'!') ) {
		$where[] = 'C.status != ?';
		$val = substr($val,1);
	  } else {
		$where[] = 'C.status = ?';
	  }
	  $qparms[] = $val;
	}

    if( isset($obj['categoryid']) && $obj['categoryid'] != '' ) {
      $joins[] = cms_db_prefix().'module_products_products_categories cc ON cc.product_id = C.id';
      $where[] = 'cc.category_id = ?';
      $qparms[] = $obj['categoryid'];
    }

	if( isset($obj['hierarchy']) && $obj['hierarchy'] != '' ) {
	  $subquery = 'SELECT DISTINCT id FROM '.cms_db_prefix().'module_products_hierarchy WHERE ';
	  $subparms = array();
	  $tmp = explode(',',$obj['hierarchy']);
	  $tmp2 = array();
	  foreach( $tmp as $one ) {
		if( strstr($one,'*') !== FALSE ) {
		  $tmp2[] = 'upper(h.long_name) LIKE upper(?)';
		}
		else {
		  $tmp2[] = 'upper(h.name) = upper(?)';
		}
		
		$one = cms_html_entity_decode($one);
		$one = trim(str_replace('*','%',str_replace('"','_',$one)));
		$subparms[] = $one;
	  }
	  $subquery .= implode(' OR ',$tmp2);
	  $hierarchy_ids = $db->GetCol($subquery,$subparms);

	  if( is_array($hierarchy_ids) && count($hierarchy_ids) ) {
		$joins[] = cms_db_prefix().'module_products_prodtohier ph ON ph.product_id = C.id';
		$where[] = 'ph.hierarchy_id IN ('.implode(',',$hierarchy_ids).')';
	  }
	}
	else if( isset($obj['hierarchyid']) ) {
	  $where[] = 'PH.hierarchy_id = ?';
	  $qparms[] = (int)$obj['hierarchyid'];
	}

    if( isset($obj['category']) && $obj['category'] != '' ) {
      // get the category's
      $ocats = product_utils::get_categories(TRUE);
      $icats = explode(',',$obj['category']);
      if( is_array($icats) && count($icats) ) {
		$icatids = array();
		foreach( $icats as $one ) {
		  $one = trim($one);
		  if( isset($ocats[$one]) ) {
			$icatids[] = (int)$ocats[$one]['id'];
		  }
		}
		if( count($icatids) ) {
		  $joins[] = cms_db_prefix().'module_products_products_categories cc ON cc.product_id = c.id';
		  $where[] = 'cc.category_id IN ('.implode(',',$icatids).')';
		}
      }
    }

    if( isset($obj['excludecat']) && $obj['excludecat'] != '' ) {
      // get the cateogry id's from the name.
      $ocats = product_utils::get_categories(TRUE);
	  $ecats = explode(',',$obj['excludecat']);
	  $exclude_ids = array();
	  foreach( $icats as $ecat ) {
		if( is_numeric($ecat) ) {
		  $exclude_ids = (int)$ecat;
		}
		else {
		  if( isset($ocats[$ecat]) ) {
			$exclude_ids = (int)$ocats[$cat]['id'];
		  }
		}
	  }
    }

	if( isset($obj['fieldid']) && $obj['fieldid'] > 0 && isset($obj['fieldval']) && $obj['fieldval'] != '' ) {
	  $fieldid = $obj['fieldid'];
	  $fieldval = $obj['fieldval'];

	  if( $fieldval == '::null::' ) {
		// handle a case where a field is not set for a product.
		$joins[] = cms_db_prefix().'module_products_fieldvals FVA ON C.id = FVA.product_id AND FVA.fielddef_id = ?';
		$where[] = '(FVA.value IS NULL)';
		array_unshift($qparms,$fieldid);
	  }
	  else if( $fieldval == '::notnull::' ) {
		// handle the case where a field is set for a product, but we don't care about the value.
		$joins[] = cms_db_prefix().'module_products_fieldvals FVA ON C.id = FVA.product_id AND FVA.fielddef_id = ?';
		$where[] = '(FVA.value != \'\')';
		array_unshift($qparms,$fieldid);
	  }
	  else {
		// limit results to all of the items that have this field, and field value.
		$joins[] = cms_db_prefix().'module_products_fieldvals FVA ON C.id = FVA.product_id AND FVA.fielddef_id = ?';
		$where[] = '(FVA.value = ?)';
		array_unshift($qparms,$fieldid);
		$qparms[] = $fieldval;
	  }
	}

	//
	// build the query now.
	//
	if( count($joins) ) {
	  $query .= ' LEFT JOIN '.implode(' LEFT JOIN ',$joins);
	}
	if( count($where) ) {
	  $query .= ' WHERE '.implode(' AND ',$where);
	}
	if( $obj['sorttype'] == '' ) {
	  $query .= ' ORDER BY '.$obj['sortby'].' '.$obj['sortorder'];
	}
	else {
	  $query .= ' ORDER BY CAST('.$sortby.' AS '.$sorttype.') '.$sortorder;
	}
	
	$startelement = 0;
	$limit = 100000;
	if( isset($obj['page']) && $obj['page'] > 0 && isset($obj['pagelimit']) && $obj['pagelimit'] > 0 ) {
	  $limit = (int)$obj['pagelimit'];
	  $startelement = ((int)$obj['page'] - 1) * $limit;
	}
	$this->_rs = $db->SelectLimit($query,$limit,$startelement,$qparms);
	
	//echo $db->sql;
	//die;
	
	if( !$this->_rs ) {
	  throw new Exception('INTERNAL ERROR: Query failed - '.$db->sql.' -- '.$db->ErrorMsg());
	}
	$this->_totalmatchingrows = $db->GetOne('SELECT FOUND_ROWS()');

	$this->_preload();
  } // _execute


  private function _preload_categories($product_ids)
  {
	if( !is_array($product_ids) || count($product_ids) == 0 ) return;

	$db = cmsms()->GetDb();
	$query = 'SELECT product_id,category_id FROM '.cms_db_prefix().'module_products_product_categories
              WHERE product_id IN ('.implode(',',$product_ids).') ORDER BY product_id ASC';
	$dbr = $db->GetArray($query);
	if( !is_array($dbr) || count($dbr) == 0 ) return;

	$this->_category_cache = $dbr;
  }


  private function _preload_fields($product_ids)
  {
	if( !is_array($product_ids) || count($product_ids) == 0 ) return;

	$db = cmsms()->GetDb();
	$query = 'SELECT product_id,fielddef_id,value FROM '.cms_db_prefix().'module_products_fieldvals
              WHERE product_id IN ('.implode(',',$product_ids).') ORDER BY product_id ASC';
	$dbr = $db->GetArray($query);
	if( !is_array($dbr) || count($dbr) == 0 ) return;

	$this->_field_cache = $dbr;
  }


  private function _preload_attributes($product_ids)
  {
	if( !is_array($product_ids) || count($product_ids) == 0 ) return;

	$db = cmsms()->GetDb();
	$query = 'SELECT * FROM '.cms_db_prefix().'module_products_attribsets
              WHERE product_id IN ('.implode(',',$product_ids).') ORDER BY product_id ASC,attrib_set_id ';
	$attribsets = $db->GetArray($query);
	if( !is_array($attribsets) || count($attribsets) == 0 ) return;

	$attribset_ids = cge_array::extract_field($attribsets,'attrib_set_id');
	$query = 'SELECT * FROM '.cms_db_prefix().'module_products_attributes
              WHERE attrib_set_id IN ('.implode(',',$attribset_ids).') ORDER BY attrib_set_id ASC';
	$attributes = $db->GetArray($query);
	
	$this->_attribute_cache = array();
	for( $i = 0; $i < count($attribsets); $i++ ) {
	  $oneset =& $attribsets[$i];
	  $pid = $oneset['product_id'];
	  if( !isset($this->_attribute_cache[$pid]) ) $this->_attribute_cache[$pid] = array();
	  $data =& $this->_attribute_cache[$pid];

	  $attribs = array();
	  for( $j = 0; $j < count($attributes); $j++ ) {
		$oneattrib =& $attributes[$j];
		if( $oneattrib['attrib_set_id'] < $oneset['attrib_set_id'] ) continue;
		if( $oneattrib['attrib_set_id'] > $oneset['attrib_set_id'] ) break;

		$attribs[$oneattrib['attrib_text']] = $oneattrib;
	  }
	  $data[$oneset['attrib_set_name']] = $attribs;
	}
  }


  private function _preload() 
  {
	if( !$this->_rs ) return;

	$product_ids = array();
	$this->_rs->MoveFirst();
	while( !$this->_rs->EOF ) {
	  $product_ids[] = $this->_rs->fields['id'];
	  $this->_rs->MoveNext();
	}
	$this->_rs->MoveFirst();

	if( !count($product_ids) ) return;
	$product_ids = array_unique($product_ids);

	// preload category info for proudct(s).
	$allcats = product_utils::get_categories(TRUE);
	if( is_array($allcats) && count($allcats) ) {
	  $this->_preload_categories($product_ids);
	}

	// preload field info
	$allfields = product_utils::get_fielddefs(TRUE,TRUE);
	if( is_array($allfields) && count($allfields) ) {
	  $this->_preload_fields($product_ids);
	}

	// preload attributes
	$this->_preload_attributes($product_ids);
  }

  public function RecordCount() 
  {
	$this->_execute();
	if( $this->_rs ) return $this->_rs->RecordCount();
  }

  public function MoveNext()
  {
	$this->_execute();
	if( $this->_rs ) return $this->_rs->MoveNext();
	return FALSE;
  }

  public function MoveFirst()
  {
	$this->_execute();
	if( $this->_rs ) return $this->_rs->MoveFirst();
	return FALSE;
  }

  public function Rewind()
  {
	$this->_execute();
	return $this->MoveFirst();
  }

  public function MoveLast()
  {
	$this->_execute();
	if( $this->_rs ) return $this->_rs->MoveLast();
	return FALSE;
  }

  public function EOF()
  {
	$this->_execute();
    if( $this->_rs ) return $this->_rs->EOF();
    return TRUE;
  }

  public function Close()
  {
	$this->_execute();
    if( $this->_rs ) return $this->_rs->Close();
    return TRUE;
  }

  public function __get($key)
  {
	$mod = cms_utils::get_module('Products');

	if( $key == 'detailpage' ) {
	  if( $this->_detailpage ) return $this->_detailpage;
	  $dfltreturnid = $mod->GetPreference('detailpage',-1);
	  if( $dfltreturnid > 0 ) return $dfltreturnid;
	  if( $this->_curpage ) return $this->_curpage;
	  return cmsms()->GetContentOperations()->GetDefaultContent();
	}
	if( $key == 'detailtemplate' ) {
	  return $this->_detailtemplate;
	}
	if( $key == 'hierpage' ) {
	  if( $this->_hierpage ) return $this->_hierpage;
	  $dfltreturnid = $mod->GetPreference('hierpage',-1);
	  if( $dfltreturnid > 0 ) return $dfltreturnid;
	  if( $this->_curpage ) return $this->_curpage;
	  return cmsms()->GetContentOperations()->GetDefaultContent();
	}
	if( $key == 'curpage' ) {
	  return $this->_curpage;
	}
	if( $key == 'notpretty' ) {
	  return $this->_notpretty;
	}

	$this->_execute();
	if( $key == 'EOF' ) {
	  return $this->_rs->EOF();
	}
	if( $key == 'totalrows' ) {
	  return $this->_totalmatchingrows;
	}
	if( $key == 'fields' && $this->_rs && !$this->_rs->EOF() ) {
	  return $this->_rs->fields;
	}
	if( $key == 'numpages' ) {
	  return ceil($this->_totalmatchingrows / $this->_query['pagelimit']);
	}
  }

  public function __set($key,$value)
  {
	$mod = cms_utils::get_module('Products');
	switch( $key ) {
	case 'detailpage':
	  $tmp = $mod->resolve_alias_or_id($value);
	  if( $tmp ) $this->_detailpage = $tmp;
	  break;
	case 'hierpage':
	  $tmp = $mod->resolve_alias_or_id($value);
	  if( $tmp ) $this->_hierpage = $value;
	  break;
	case 'curpage':
	  $tmp = $mod->resolve_alias_or_id($value);
	  if( $tmp ) $this->_curpage = $value;
	  break;
	case 'notpretty':
	  $this->_notpretty = trim($value);
	  break;
	case 'detailtemplate':
	  $this->_detailtemplate = $value;
	  if( $this->_notpretty == '' ) {
		$this->_notpretty = 'details';
	  }
	  break;

	default:
	  throw new Exception('Cannot set '.$key.' into this object');
	}
  }

  // return the full product (with fields, and attributes)
  public function &get_product($bare = false)
  {
	$ret = null;
	if( !$this->_rs ) return $ret;

	product_ops::set_product($this->_rs->fields); // used by other stuff that requires a product... should minimize duplicate loads.
	$onerow = cge_array::to_object($this->_rs->fields);	

	$config = cmsms()->GetConfig();
	$module = cms_utils::get_module('Products');
	$filedir = cms_join_path($config['uploads_path'],$module->GetName(),'product_'.$onerow->id);

	// categories
	if( is_array($this->_category_cache) && count($this->_category_cache) ) {
	  $cats = product_utils::get_full_categories();
	  $catarray = array();
	  $catnamearray = array();
	  for( $i = 0; $i < count($this->_category_cache); $i++ ) {
		if( $this->_category_cache[$i]['product_id'] < $onerow->id ) continue;
		if( $this->_category_cache[$i]['product_id'] > $onerow->id ) break;

		foreach( $cats as $onecat ) {
		  if( $this->_category_cache[$i]['category_id'] != $onecat->id ) continue;
		  $entry = clone $onecat;
		  $entry->value = true;
		  $catnamearray[] = $entry->name;
		  $catarray[] = $entry;
		}
	  }
	  $onerow->categories = $catarray;
	  $onerow->catnamearray = $catnamearray;
	}

	// fields
	if( is_array($this->_field_cache) && count($this->_field_cache) ) {
	  $flddefs = product_utils::get_fielddefs(FALSE,TRUE);
	  $fldarray = array();
	  for( $i = 0; $i < count($this->_field_cache); $i++ ) {
		if( $this->_field_cache[$i]['product_id'] < $onerow->id ) continue;
		if( $this->_field_cache[$i]['product_id'] > $onerow->id ) break;

		foreach( $flddefs as $onedef ) {
		  if( $this->_field_cache[$i]['fielddef_id'] != $onedef->id ) continue;

		  $entry = clone $onedef;
		  $entry->value = $this->_field_cache[$i]['value'];
		  if( $entry->type == 'dimensions' || $entry->type == 'subscription' ) {
			$entry->value = unserialize($entry->value);
		  }
		  else if( $entry->type == 'image' ) {
			if( $entry->value && file_exists(cms_join_path($filedir,'thumb_'.$entry->value)) ) {
			  $entry->thumbnail = 'thumb_'.$entry->value;
			}
			if( $entry->value && file_exists(cms_join_path($filedir,'preview_'.$entry->value)) ) {
			  $entry->thumbnail = 'preview_'.$entry->value;
			}
		  }
		  $entry->fielddef_id = $entry->id; // ??
		  $fldarray[$entry->name] = $entry;
		}
	  }
	  $onerow->fields = $fldarray;
	}

	// attributes
	if( is_array($this->_attribute_cache) && isset($this->_attribute_cache[$onerow->id]) &&
		is_array($this->_attribute_cache[$onerow->id]) &&
		count($this->_attribute_cache[$onerow->id]) ) {
	  $onerow->attributes = $this->_attribute_cache[$onerow->id];
	  $onerow->attributes_full = $this->_attribute_cache[$onerow->id];
	}

	return $onerow;
  }


  public function &get_product_for_display()
  {
	$ret = null;
	if( !$this->_rs ) return $ret;

	$onerow = $this->get_product();
	if( !$onerow ) return $ret;

	$config = cmsms()->GetConfig();
	$module = cms_utils::get_module('Products');

	$onerow->file_location = $config['uploads_url'].'/'.$module->GetName().'/product_'.$onerow->id;

	$pretty_url = '';
	$parms = array();
	if( $this->_notpretty != '' ) {
	  $parms['notpretty'] = $this->_notpretty;
	}
	if( product_utils::can_do_pretty('details',$parms) ) {
	  $pretty_url = product_ops::pretty_url($onerow->id,$this->detailpage);
	}

	$parms = array();
	$parms['productid'] = $onerow->id;
	if( $this->_detailpage ) $parms['detailpage'] = $this->_detailpage;
	if( $this->_detailtemplate ) $parms['detailtemplate'] = $this->_detailtemplate;
	$onerow->detail_url = $module->create_url('prod','details',$this->detailpage,$parms,false,false,$pretty_url);
	if( $onerow->hierarchy_id ) {
	  $onerow->breadcrumb = hierarchy_ops::get_breadcrumb('cntnt01',$onerow->hierarchy_id,$this->hierpage);
	}

	return $onerow;
  } // function
} // end of class

#
# EOF
#
?>