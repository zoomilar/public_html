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

final class productsCsvImporter
{
  var $_defs_byname;
  var $_defs_byindex;
  var $_record;
  var $_linenum;
  var $_line;
  var $_delim;
  var $_errors;
  var $_module;
  var $_field_map;
  var $_category_map;
  var $_hierarchy_map;
  var $_policy;
  var $_imageHandler;


  public function productsCsvImporter(&$mod)
  {
    $this->_module = $mod;
    $this->_linenum = 0;
    $this->_delim = '|';
    $this->_policy = array();
  }


  public function setImageHandler(&$handler)
  {
    if( !is_object($handler) ) return FALSE;
    $this->_imageHandler = $handler;
    return TRUE;
  }


  public function setPolicyValue($key,$value)
  {
    $this->_policy[$key] = $value;
  }

  
  private function _getPolicyValue($key,$dflt = FALSE)
  {
    if( !isset($this->_policy[$key]) ) return $dflt;
    return $this->_policy[$key];
  }


  private function _setError($tmp)
  {
    if( !is_array($this->_errors) )
      {
	$this->_errors = array();
      }
    $this->_errors[] = $this->_linenum.': '.$tmp;
  }


  public function clearErrors()
  {
    $this->_errors = array();
  }


  public function getErrors()
  {
    return $this->_errors;
  }


  public function setDelim($delim)
  {
    if( empty($delim) ) return FALSE;
    $this->_delim = $delim;
    return TRUE;
  }


  public function setFieldDefsByName($tmp)
  {
    if( !is_array($tmp) ) return FALSE;
    $this->_defs_byname = $tmp;
    return TRUE;
  }


  public function setFieldDefsByIndex($tmp)
  {
    if( !is_array($tmp) ) return FALSE;
    $this->_defs_byindex = $tmp;
    return FALSE;
  }


  private function _setLine($tmp)
  {
    $this->_line = $tmp;
    $this->_linenum++;
    $this->_record = cge_array::smart_explode($this->_line,$this->_delim);
    if( endswith($tmp,$this->_delim) ) {
      $this->_record[] = '';
    }
    return TRUE;
  }


  private function _getFieldId($name)
  {
    if( !is_array($this->_field_map) ) {
      $db = cmsms()->GetDb();
      $query = 'SELECT id,name,type FROM '.cms_db_prefix().'module_products_fielddefs';
      $tmp = $db->GetArray($query);
      if( is_array($tmp) ) {
	$this->_field_map = cge_array::to_hash($tmp,'name');
      }
    }
    if( is_array($this->_field_map) && isset($this->_field_map[$name]) ) {
      return $this->_field_map[$name]['id'];
    }
    return FALSE;
  }


  private function _getFieldType($name)
  {
    if( !is_array($this->_field_map) )
      {
	$tmp = $this->_getFieldId($name);
      }
    if( is_array($this->_field_map) && isset($this->_field_map[$name]) )
      {
	return $this->_field_map[$name]['type'];
      }
    return FALSE;
  }


  private function _setFieldValue($product_id,$fid,$val)
  {
    $db = cmsms()->GetDb();
    $query = 'SELECT value FROM '.cms_db_prefix().'module_products_fieldvals WHERE product_id = ? AND fielddef_id = ?';
    $tmp = $db->GetOne($query,array($product_id,$fid));
    if( $tmp ) {
      $query = 'UPDATE '.cms_db_prefix().'module_products_fieldvals SET value = ? WHERE product_id = ? AND fielddef_id = ?';
      $dbr = $db->Execute($query,array($val,$product_id,$fid));
    } else {
      $query = 'INSERT INTO '.cms_db_prefix().'module_products_fieldvals (value, product_id, fielddef_id) VALUES (?,?,?)';
      $dbr = $db->Execute($query,array($val,$product_id,$fid));
    }
    if( !$dbr ) {
      $this->_setError('Problem inserting field value for field '.$fid);
      return FALSE;
    }
    return TRUE;
  }


  private function _getCategoryId($name)
  {
    if( !is_array($this->_category_map) )
      {
	$db = cmsms()->GetDb();
	$query = 'SELECT id,name FROM '.cms_db_prefix().'module_products_categories';
	$tmp = $db->GetArray($query);
	if( is_array($tmp) )
	  {
	    $this->_category_map = cge_array::to_hash($tmp,'name');
	  }
      }
    if( is_array($this->_category_map) && isset($this->_category_map[$name]) )
      {
	return $this->_category_map[$name]['id'];
      }
    return FALSE;
  }


  private function __getHierarchyCache()
  {
    // make sure we have everything in memory.
    $db = cmsms()->GetDb();
    $query = 'SELECT id,long_name FROM '.cms_db_prefix().'module_products_hierarchy';
    $tmp = $db->GetArray($query);
    if( is_array($tmp) )
      {
	$this->_hierarchy_map = cge_array::to_hash($tmp,'long_name');
      }
  }


  private function _setHierarchyId($product_id,$hier_id)
  {
    $db = cmsms()->GetDb();

    $query = 'SELECT hierarchy_id FROM '.cms_db_prefix().'module_products_prodtohier
               WHERE product_id = ?';
    $tmp = $db->GetOne($query,array($product_id));
    if( $tmp ) {
      $query = 'UPDATE '.cms_db_prefix().'module_products_prodtohier
                SET hierarchy_id = ? WHERE product_id = ?';
      $dbr = $db->Execute($query,array($hier_id,$product_id));
    }
    else {
      $query = 'INSERT INTO '.cms_db_prefix().'module_products_prodtohier
                 (product_id,hierarchy_id) VALUES (?,?)';
      $dbr = $db->Execute($query,array($product_id,$hier_id));
    }
    if( !$dbr ) {
      $this->_setError('problem adjusting hierarchy for '.$product_id);
      return FALSE;
    }
    return TRUE;
  }

  private function _getHierarchyId($hier)
  {
    if( !is_array($this->_hierarchy_map) )
      {
	$this->__getHierarchyCache();
      }
    if( $this->_getPolicyValue('create_hierarchy') )
      {
	if( (is_array($this->_hierarchy_map) && !isset($this->_hierarchy_map[$hier])) ||
	    !is_array($this->_hierarchy_map) )
	  {
	    $db = cmsms()->GetDb();

	    // we have everything in memory
	    // it's just not there
	    // so we have to create it.
	    $path = explode(' | ',$hier);
	    $parent = -1;
	    $item_order = 1;
	    $fquery = 'SELECT id FROM '.cms_db_prefix().'module_products_hierarchy WHERE name = ? AND parent_id = ?';
	    $iquery = 'INSERT INTO '.cms_db_prefix().'module_products_hierarchy (name,parent_id) VALUES (?,?)';
	    foreach( $path as $one )
	      {
		$name = trim($one);
		$name = trim($name,'"\'');
		if( empty($name) ) continue;
		$t_id = $db->GetOne($fquery,array($name,$parent));
		if( !$t_id )
		  {
		    // gotta insert it
		    $db->Execute($iquery,array($name,$parent));
		    $t_id = $db->Insert_ID();
		    $this->_module->UpdateHierarchyPositions();
		  }
		$parent = $t_id;
	      }
	  }

	// refresh the memory
	$this->__getHierarchyCache();
      }

    // return the desired value
    if( is_array($this->_hierarchy_map) && isset($this->_hierarchy_map[$hier]) )
      {
	return $this->_hierarchy_map[$hier]['id'];
      }

    // this ia really a problem
    return FALSE;
  }


  private function _hasField($name)
  {
    if( !is_array($this->_record) ) return FALSE;
    if( !is_array($this->_defs_byname) ) return FALSE;
    if( !isset($this->_defs_byname[$name]) ) return FALSE;
    $idx = $this->_defs_byname[$name];
    if( $idx >= count($this->_record) ) return FALSE;
    return $idx;
  }


  private function _getField($name,$dflt = FALSE)
  {
    $idx = $this->_hasField($name);
    if( $idx === FALSE )
      {
	return $dflt;
      }
    $val = trim($this->_record[$idx],'\'"');
    return $val;
  }


  private function _getDefCount()
  {
    return count($this->_defs_byindex);
  }


  private function _getFieldCount()  {
    return count($this->_record);
  }


  private function _getCurrency($str)
  {
    $LocaleInfo = localeconv();
    $currency_symbol = '$';
    if( isset($LocaleInfo['currency_symbol']) && $LocaleInfo['currency_symbol'] != '' )
      $currency_symbol = $LocaleInfo['currency_symbol'];

    $str = trim($str);
    $str = trim($str,$currency_symbol);
    $str = str_replace($LocaleInfo["mon_thousands_sep"] , "", $str);
    $str = str_replace($LocaleInfo["mon_decimal_point"] , ".", $str);
    $val = floatval($str); 
    return $val;
  }


  private function _getFieldNamesLike($prefix)
  {
    if( !is_array($this->_defs_byindex) ) return FALSE;
    $res = array();
    for($i = 0; $i < count($this->_defs_byindex); $i++ )
      {
	$tmp = trim(trim($this->_defs_byindex[$i]),'\'"');
	if( startswith($tmp,$prefix) )
	  {
	    $res[] = $tmp;
	  }
      }
    return $res;
  }


  private function _handleFirstLine()
  {
    $db = cmsms()->GetDb();
    $now = $db->DbTimeStamp(time());

    // 0.  Get the field definitions
    for( $i = 0; $i < count($this->_record); $i++ )
      {
	$tmp = trim(trim($this->_record[$i]),'"\'');
	$byname[$tmp] = $i;
      }
    $this->_defs_byname = $byname;
    $this->_defs_byindex = $this->_record;


    // 1. first make sure we have all the required fields.
    $required_fields = explode(',','#FLAG,#name,#price');
    foreach( $required_fields as $one )
      {
	if( !array_key_exists($one,$this->_defs_byname) )
	  {
	    $this->_setError('missing required field '.$one);
	    return FALSE;
	  }
      }

    // 2. go through and get categories
    // and make sure they exist
    if( $this->_getPolicyValue('create_categories') )
      {
	$cats = $this->_getFieldNamesLike('#CAT');
	if( is_array($cats) )
	  {
	    $fquery = 'SELECT id FROM '.cms_db_prefix().'module_products_categories WHERE name = ?';
	    $iquery = 'INSERT INTO '.cms_db_prefix()."module_products_categories (name,create_date,modified_date) VALUES (?,$now,$now)";
	    foreach( $cats as $one )
	      {
		$tmp = trim(substr($one,5));
		$tmp = trim($tmp,'"\'');
		if( empty($tmp) ) continue;
		$t_id = $db->GetOne($fquery,array($tmp));
		if( !$t_id )
		  {
		    // oops, gotta add it
		    $dbr = $db->Execute($iquery,array($tmp));
		    if( !$dbr )
		      {
			$this->_setError('problem creating category '.$tmp);
			$this->_setError('DEBUG: '.$db->sql.' -- '.$db->ErrorMsg());
		      }
		  }
	      }
	  }
      }

    // 3. then fields
    // and make sure they exist
    if( $this->_getPolicyValue('create_fields') ) {
      $fields = $this->_getFieldNamesLike('#FIELD');
      if( is_array($fields) ) {
	$field_types = array_keys(product_utils::get_field_types());
	$fquery = 'SELECT id FROM '.cms_db_prefix().'module_products_fielddefs WHERE name = ?';
	$oquery = 'SELECT max(item_order) + 1 FROM '.cms_db_prefix().'module_products_fielddefs';
	$iquery = 'INSERT INTO '.cms_db_prefix()."module_products_fielddefs 
                      (name, prompt, type, max_length, item_order, create_date, modified_date, public)
                   VALUES(?,?,?,?,?,$now,$now,1)";                                                         
	foreach( $fields as $one ) {
	  $tmp = explode(':',$one);
	  if( count($tmp) != 3 ) continue;
	  $type = trim(trim($tmp[1]),'"\'');
	  $name = trim(trim($tmp[2]),'"\'');
	  if( empty($type) || empty($name) ) continue;
	  if( !in_array($type,$field_types) ) {
	    $this->_setError('Invalid field type: '.$type.' for field '.$name);
	    return FALSE;
	  }
	  $t_id = $db->GetOne($fquery,array($name));
	  if( !$t_id ) {
	    $prompt = ucwords($name);
	    // oops, gotta add it.
	    $max = $db->GetOne($oquery);
	    if( !$max ) $max = 0;
	    $dbr = $db->Execute($iquery,array($name,$prompt,$type,255,$max));
	    if( !$dbr ) {
	      $this->_setError('Problem creating field '.$name);
	      $this->_setError('DEBUG: '.$db->sql.' -- '.$db->ErrorMsg());
	    }
	  }
	}
      }
    }

    return TRUE;
  }


  private function _handleProductLine()
  {
    $db = cmsms()->GetDb();
    $now = $db->DbTimeStamp(time());
    
    // get the info for the product
    // and insert it
    $tnow = trim($now,"'");
    $name = $this->_getField('#name');
    if( empty($name) ) {
      $this->_setError("empty product name");
      return FALSE;
    }
    $fquery = 'SELECT id FROM '.cms_db_prefix().'module_products WHERE product_name = ?';
    $t_id = $db->GetOne($fquery,array($name));
    $is_update = FALSE;
    if( $t_id ) {
      // uh-oh, it's a duplicate product.
      $handler = $this->_getPolicyValue('on_duplicate_product');
      if( $handler == 'skip' ) {
	// woohoo, we get to skip this whole line
	$this->_setError("duplicate product $name");
	return FALSE;
      }
      else if( $handler == 'update' ) {
	// it's an update... nothing here.
	$is_update = TRUE;
      }
      else {
	// uh-oh we gotta delete this existing product first.
	$this->_module->DeleteProduct($t_id);
	$t_id = null;
      }
    }

    if( !$t_id ) {
      $iquery = 'INSERT INTO '.cms_db_prefix()."module_products
                 (product_name,details,price,create_date,modified_date,taxable,status,weight,sku)
                 VALUES (?,?,?,?,?,?,?,?,?)";
      $dbr = $db->Execute($iquery,array($this->_getField('#name'),
					$this->_getField('#details',''),
					$this->_getCurrency($this->_getField('#price',0)),
					$this->_getField('#create_date',$tnow),
					$this->_getField('#modified_date',$tnow),
					$this->_getField('#taxable',1),
					$this->_getField('#status','published'),
					$this->_getField('#weight',0),
					$this->_getField('#sku','')));
      if( !$dbr ) {
	$this->_setError('product insert failed');
	return FALSE;
      }
      $product_id = $db->Insert_ID();
    }
    else {
      // it's a product update.
      $product_id = $t_id;
      $uquery = 'UPDATE '.cms_db_prefix().'module_products
                 SET product_name = ?, details = ?, price = ?, modified_date = ?, taxable = ?, 
                     status = ?, weight = ?, sku = ?
                 WHERE id = ?';
      $dbr = $db->Execute($uquery,array($this->_getField('#name'),
				        $this->_getField('#details',''),
				        $this->_getCurrency($this->_getField('#price',0)),
				        $this->_getField('#modified_date',$tnow),
				        $this->_getField('#taxable',1),
				        $this->_getField('#status','published'),
				        $this->_getField('#weight',0),
				        $this->_getField('#sku',''),
				        $product_id));
    }


    // get the hierarchy
    // and insert it
    $hier = $this->_getField('#HIER');
    if( $hier ) {
      $tmp = explode('>>',$hier);
      for( $i = 0; $i < count($tmp); $i++ ) {
	$tmp[$i] = trim(trim($tmp[$i]),'"\'');
      }
      $hier = implode(' | ',$tmp);

      $hid = $this->_getHierarchyId($hier);
      if( $hid ) {
	$t = $this->_setHierarchyId($product_id,$hid);
      }
    }

    // get the info for fields
    // and insert them
    if( $is_update && $this->_getPolicyValue('clearfields') ) {
      $query = 'DELETE FROM '.cms_db_prefix().'module_products_fieldvals WHERE product_id = ?';
      $db->Execute($query,array($product_id));
    }
    $fields = $this->_getFieldNamesLike('#FIELD');
    if( is_array($fields) ) {
      foreach( $fields as $one ) {
	$tmp = explode(':',$one);
	if( count($tmp) != 3 ) continue;
	$name = trim(trim($tmp[2]),'"\'');
	$type_a = trim(trim($tmp[1]),'"\'');
	$val = $this->_getField($one);
	$val = trim(trim($val),'"\'');

	$fid = $this->_getFieldId($name);
	if( $fid === FALSE ) {
	  $this->_setError('field '.$name.' not found');
	  continue;
	}

	$type = $this->_getFieldType($name);
	if( $type_a != $type ) {
	  $this->_setError('Invalid type for field '.$name);
	  continue;
	}

	if( $type == 'subscription' ) {
	  // we don't import these.
	  continue;
	}

	if( $type == 'dimensions' ) {
	  $parts = explode(',',$val);
	  if( count($parts) != 3 ) {
	    $this->_setError('Invalid value for dimensions field');
	    continue;
	  }
	  $data = array('length'=>'','width'=>'','height'=>'');
	  $err = false;
	  foreach( $parts as $one ) {
	    list($k,$v) = explode(':',$one,2);
	    switch($k) {
	    case 'l':
	      $data['length'] = $v;
	      break;
	    case 'w':
	      $data['width'] = $v;
	      break;
	    case 'h':
	      $data['height'] = $v;
	      break;
	    default:
	      $this->_setError('Invalid value for dimensions field');
	      $err = true;
	      break;
	    }
	  }
	  if( $err ) continue;
	  $val = serialize($data);
	}

	$insert = true;
	if( $type == 'image') {
	  // it's an image... 
	  if( !$this->_getPolicyValue('handle_images') || empty($val)
	      || empty($this->_imageHandler) || !is_object($this->_imageHandler) ) {
	    // we're not handling images, or the value is empty.
	    $insert = false;
	  }
	  else {
	    // build source name
	    $res = $this->_imageHandler->handleImage($product_id,$val);
	    if( $res == FALSE ) {
	      $this->_setError('problem handling image '.$val);
	      $insert = false;
	    }
	    else {
	      $val = $res;
	    }
	  }
	}

	if( $insert ) {
	  // good to insert.
	  if( !$this->_setFieldValue($product_id,$fid,$val) ) {
	    continue;
	  }
	}	
      } // fields.
    }

    // get the info for categories
    // and insert them
    // here should we nuke existing categories?
    if( $is_update && $this->_getPolicyValue('clearcategories') ) {
      $query = 'DELETE FROM '.cms_db_prefix().'module_products_product_categories
                WHERE product_id = ?';
      $db->Execute($query,array($product_id));
    }
    $cats = $this->_getFieldNamesLike('#CAT');
    if( is_array($cats) ) {
      $iquery = 'INSERT INTO '.cms_db_prefix()."module_products_product_categories
                 (product_id,category_id,create_date,modified_date)
                 VALUES (?,?,$now,$now)"; 
      foreach( $cats as $one ) {
	$tmp = explode(':',$one);
	if( count($tmp) != 2 ) continue;
	$name = trim(trim($tmp[1]),'"\'');
	$val = $this->_getField($one);
	$val = trim(trim($val),'"\'');

	$cid = $this->_getCategoryId($name);
	if( !(int)$val && !$this->_getPolicyValue('clearcategories') ) {
	  if( $cid ) {
	    $dquery = 'DELETE FROM '.cms_db_prefix().'module_products_product_categories 
                       WHERE product_id = ? AND category_id = ?';
	    $db->Execute($dquery,array($product_id,$cid));
	    continue;
	  }
	}	
	// get the category id from cache
	if( $cid === FALSE ) {
	  $this->_setError('field '.$name.' not found');
	}
	else if( $val ) {
	  $dbr = $db->Execute($iquery,array($product_id,$cid));
	  if( !$dbr ) {
	    $this->_setError("problem associating category $cid with product $product_id");
	  }
	}
      }
    }

    // get attributes
    // insert them.
    if( $is_update && $this->_getPolicyValue('clearattribs') ) {
      $query = 'SELECT attrib_set_id FROM '.cms_db_prefix().'module_products_attribsets
                WHERE product_id = ?';
      $tmp = $db->GetCol($query,array($product_id));
      
      $query = 'DELETE FROM '.cms_db_prefix().'module_products_attributes
                WHERE attrib_set_id IN ('.implode(',',$tmp).')';
      $db->Execute($query);

      $query = 'DELETE FROM '.cms_db_prefix().'module_products_attribsets
                WHERE product_id = ?';
      $db->Execute($query,array($product_id));
    }
    $tmp = $this->_getField('#ATTRIBS');
    if( !empty($tmp) ) {
      $attribs = explode('--',$tmp);
      foreach( $attribs as $one ) {
	$one = trim($one);
	$one = trim($one,'"\'');
	if( strstr($one,':') === FALSE ) continue;
	list($set,$attr,$adj,$sku) = explode(':',$one);
	$set = trim($set,'"\'');
	$set = trim($set);
	$attr = trim($attr,'"\'');
	$attr = trim($attr);
	$adj = trim($adj,'"\'');
	$adj = trim($adj);
	$sku = trim($sku,'"\'');
	$sku = trim($sku);
	
	if( empty($set) || empty($attr) ) continue;
	
	// add the attribute set
	$fquery = 'SELECT attrib_set_id FROM '.cms_db_prefix().'module_products_attribsets
                   WHERE product_id = ? AND attrib_set_name = ?';
	$t_id = $db->GetOne($fquery,array($product_id,$set));
	if( !$t_id ) {
	  $squery = 'INSERT INTO '.cms_db_prefix().'module_products_attribsets
                   (product_id, attrib_set_name) VALUES (?,?)';
	  $db->Execute($squery,array($product_id,$set));
	  $t_id = $db->Insert_ID();
	}

	// add the attribute value
	$fquery = 'SELECT attrib_id FROM '.cms_db_prefix().'module_products_attributes
                   WHERE attrib_set_id = ? AND attrib_text = ?';
	$attr_id = $db->GetOne($fquery,array($t_id,$attr));
	if( !$attr_id ) {
	  $query = 'INSERT INTO '.cms_db_prefix().'module_products_attributes
                    (attrib_set_id,attrib_text,attrib_adjustment,sku)
                    VALUES (?,?,?,?)';
	  $db->Execute($query,array($t_id,$attr,$adj,$sku));
	}
      
      } // foreach
    }

    return TRUE;
  }


  private function _testFirstLine(&$messages)
  {
    $db = cmsms()->GetDb();

    for( $i = 0; $i < count($this->_record); $i++ )
      {
	$tmp = trim(trim($this->_record[$i]),'"\'');
	$byname[$tmp] = $i;
      }
    $this->_defs_byname = $byname;
    $this->_defs_byindex = $this->_record;

    $required_fields = explode(',','#FLAG,#name,#price');
    foreach( $required_fields as $one )
      {
	if( !array_key_exists($one,$this->_defs_byname) )
	  {
	    $this->_setError('missing required field '.$one);
	    return FALSE;
	  }
      }

    $messages[] = 'found all required fields';

    $cats = $this->_getFieldNamesLike('#CAT');
    if( is_array($cats) )
      {
	foreach( $cats as $one )
	  {
	    $fquery = 'SELECT id FROM '.cms_db_prefix().'module_products_categories WHERE name = ?';

	    $tmp = trim(substr($one,5));
	    $tmp = trim($tmp,'"\'');
	    if( empty($tmp) ) continue;
	    $t_id = $db->GetOne($fquery,array($tmp));
	    if( $t_id )
	      {
		$messages[] = 'found existing category '.$tmp;
	      }
	    else
	      {
		$messages[] = 'unknown category '.$tmp;
	      }
	  }
      }
    
    $fields = $this->_getFieldNamesLike('#FIELD');
    if( is_array($fields) )
      {
	$field_types = array_keys(product_utils::get_field_types());
	$fquery = 'SELECT id FROM '.cms_db_prefix().'module_products_fielddefs WHERE name = ?';
	foreach( $fields as $one )
	  {
	    $tmp = explode(':',$one);
	    if( count($tmp) != 3 ) continue;
	    $type = trim(trim($tmp[1]),'"\'');
	    $name = trim(trim($tmp[2]),'"\'');
	    if( empty($type) || empty($name) )
	      {
		$this->_setError('Invalid field definition: '.$one);
		return FALSE;
	      }
	    if( !in_array($type,$field_types) )
	      {
		$this->_setError('Invalid field type: '.$type);
		return FALSE;
	      }
	    $t_id = $db->GetOne($fquery,array($name));
	    if( !$t_id )
	      {
		$messages[] = 'unknown field '.$name;
	      }
	    else
	      {
		$messages[] = 'found field '.$name.' of type '.$type;
	      }
	  }
      }

    return TRUE;
  }


  private function _testNewProduct(&$message)
  {
    // make sure we have the required number of fields
    // according to the header.
    if( $this->_getFieldCount() != $this->_getDefCount() )
      {
	$this->_setError('invalid field count ('.$this->_getFieldCount().' of expected '.$this->_getDefCount().')');
	return FALSE;
      }

    return TRUE;
  }


  public function testLine($line,&$messages)
  {
    $pos = strpos($line,'//');
    if( $pos !== FALSE )
      {
	$line = substr($line,0,$pos);
      }
    $line = trim($line);
    if( empty($line) ) return TRUE;
    
    $res = $this->_setLine($line);
    if( $res === FALSE ) return FALSE;

    if( $this->_linenum == 1 )
      {
	$res = $this->_testFirstLine($messages);
      }
    else
      {
	if( $this->_getField('#FLAG') == 'P' )
	  {
	    $res = $this->_testNewProduct($messages);
	  }
	else
	  {
	    $this->_setError('invalid field: #FLAG');
	    $res = FALSE;
	  }
      }
    return $res;
  }


  public function handleLine($line)
  {
    // trim off comments.
    $pos = strpos($line,'//');
    if( $pos !== FALSE )
      {
	$line = substr($line,0,$pos);
      }
    $line = trim($line);
    if( empty($line) ) return TRUE;

    $res = $this->_setLine($line);
    if( $res === FALSE ) return FALSE;
    if( $this->_linenum == 1 ) {
      $res = $this->_handleFirstLine();
    }
    else {
      if( $this->_getField('#FLAG') == 'P' ) {
	$res = $this->_testNewProduct($messages);
	if( $res ) {
	  $res = $this->_handleProductLine();
	}
      } else {
	$this->_setError('invalid field: #FLAG');
	$res = FALSE;
      }
    }

    return $res;
  }


  protected function is_new_record($line)
  {
    // a function to test if this line denotes the start of a new record.
    $valid = array('#FLAG','P','"#FLAG"','"P"');

    foreach( $valid as $one )
      {
	$one .= $this->_delim;
	if( startswith($line,$one) ) return TRUE;
      }
    return FALSE;
  }


  private function my_fgets($fh)
  {
    if( !$fh ) return;
    $pos1 = ftell($fh);
    
    $line = fgets($fh);
    if( strpos($line,"\r") === FALSE )
      {
	return $line;
      }
    
    // line is probably a crappy mac line.
    $len1 = strlen($line);
    $pos = strpos($line,"\r");
    
    $line = substr($line,0,$pos);
    fseek($fh,($len1 - $pos -1 ) * -1,SEEK_CUR);
    return $line;    
  }


  public function get_unparsed_record($fh)
  {
    $line = '';
    while( !feof($fh) ) {
      $pos = ftell($fh);
      $tdata = $this->my_fgets($fh);
      if( !$this->is_new_record($tdata) ) {
	$line .= $tdata;
	continue;
      }

      if( strlen($line) > 0 ) {
	fseek($fh,$pos);
	break;
      }
      $line = $tdata;
    }

    return $line;
  }

} // end of class



#
# EOF
#
?>
