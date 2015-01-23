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
if (!isset($gCms)) exit;
if (!$this->CheckPermission('Modify Products')) return;

// initialization.
$sku_cleared = FALSE;
$this->SetCurrentTab('Products');
if( !isset($params['compid']) )
  {
    $this->SetError($this->Lang('error_missingparam'));
    $this->RedirectToTab($id);
    return;
  }
$compid = (int)$params['compid'];
if( $compid <= 0 )
  {
    $this->SetError($this->Lang('error_missingparam'));
    $this->RedirectToTab($id);
    return;
  }
$fielddefs = product_ops::get_fields();

//
// read all the data
//
$query = 'SELECT * FROM '.cms_db_prefix().'module_products WHERE Id = ?';
$product = $db->GetRow($query,array($compid));
if( !is_array($product) ) 
  {
    $this->SetError($this->Lang('error_productnotfound'));
    $this->RedirectToTab($id);
    return;
  }

// get the categories
$query = 'SELECT * FROM '.cms_db_prefix().'module_products_product_categories WHERE product_id = ?';
$product_categories = $db->GetArray($query,array($compid));

// get the field values...
$query = 'SELECT * FROM '.cms_db_prefix().'module_products_fieldvals WHERE product_id = ?';
$product_fieldvals = $db->GetArray($query,array($compid));

// get the attribute sets
$query = 'SELECT * FROM '.cms_db_prefix().'module_products_attribsets WHERE product_id = ? ORDER BY attrib_set_id';
$attribsets = $db->GetArray($query,array($compid));

// get the attributes
if( is_array($attribsets) && count($attribsets) )
  {
    $attributes = array();
    $query = 'SELECT * FROM '.cms_db_prefix().'module_products_attributes WHERE attrib_set_id = ? ORDER BY attrib_id';
    foreach( $attribsets as $one )
      {
	$attribs = $db->GetArray($query,array($one['attrib_set_id']));
	if( is_array($attribs) && count($attribs) )
	  {
	    $attributes[$one['attrib_set_id']] = $attribs;
	  }
      }
  }

// get the hierarchy
$query = 'SELECT hierarchy_id FROM '.cms_db_prefix().'module_products_prodtohier WHERE product_id = ?';
$hierarchy_id = $db->GetOne($query,array($compid));

//
// alter data
//
if( $product['alias'] )
  {
    $product['alias'] = product_ops::generate_alias($product['product_name']);
  }

// get a new name for the product.
$product['product_name'] = $this->Lang('prefix_copyof').' '.$product['product_name'];
$suffix = '';
$query = 'SELECT id FROM '.cms_db_prefix().'module_products WHERE product_name = ?';
while( $suffix < 100 )
  {
    $tname = $product['product_name'].$suffix;
    $tmp = $db->GetOne($query,array($tname));
    if( !$tmp )
      {
	$product['product_name'] = $tname;
	break;
      }
    if( !$suffix ) $suffix = 1;
    $suffix++;
  }

// clear the sku for the product
if( $product['sku'] )
  {
    $sku_cleared = TRUE;
    $product['sku'] = '';
  }
// clear the sku's for the attributes
foreach( $attributes as &$one )
{
  foreach( $one as &$attrib )
    {
      if( $attrib['sku'] ) 
	{
	  $sku_cleared = TRUE;
	  $attrib['sku'] = '';
	}
    }
}

//
// save data
// note: transactions would be really really nice here.
//
$query = 'INSERT INTO '.cms_db_prefix()."module_products 
          (product_name, details, price, create_date, modified_date, taxable, status, weight, sku, alias)
          VALUES (?,?,?,NOW(),NOW(),?,?,?,?,?)";
$dbr = $db->Execute($query,
		    array($product['product_name'],$product['details'],$product['price'],
			  $product['taxable'],$product['status'],$product['weight'],$product['sku'],$product['alias']));
if( !$dbr )
  {
    debug_display($db->sql); debug_display($db->ErrorMsg()); die();
    $this->SetError($this->Lang('error_dberror'));
    $this->RedirectToTab($id);
    return;
  }
$new_id = $db->Insert_Id();

if( is_array($product_categories) && count($product_categories) )
  {
    $query = 'INSERT INTO '.cms_db_prefix()."module_products_product_categories 
              (product_id,category_id,create_date,modified_date) VALUES (?,?,NOW(),NOW())";
    foreach( $product_categories as $one )
      {
	$db->Execute($query,array($new_id,$one['category_id']));
      }
  }

if( is_array($product_fieldvals) && count($product_fieldvals) )
  {
    $query = 'INSERT INTO '.cms_db_prefix()."module_products_fieldvals 
              (product_id,fielddef_id,value,create_date,modified_date)
              VALUES (?,?,?,NOW(),NOW())";
    foreach( $product_fieldvals as $one )
      {
	$db->Execute($query,array($new_id,$one['fielddef_id'],$one['value']));
      }
  }

if( is_array($attribsets) && count($attribsets) )
  {
    $query = 'INSERT INTO '.cms_db_prefix().'module_products_attribsets
              (product_id,attrib_set_name)
              VALUES (?,?)';
    foreach( $attribsets as $one )
      {
	$db->Execute($query,array($new_id,$one['attrib_set_name']));
	$new_attrib_id = $db->Insert_ID();

	if( isset($attributes[$one['attrib_set_id']]) && count($attributes[$one['attrib_set_id']]) )
	  {
	    $query2 = 'INSERT INTO '.cms_db_prefix().'module_products_attributes 
                       (attrib_set_id,attrib_text,attrib_adjustment,sku)
                       VALUES (?,?,?,?)';
	    foreach( $attributes[$one['attrib_set_id']] as $attrib )
	      {
		$db->Execute($query2,array($new_attrib_id,$attrib['attrib_text'],$attrib['attrib_adjustment'],$attrib['sku']));
	      }
	  }
      }
  }

if( $hierarchy_id > 0 )
  {
    $query = 'INSERT INTO '.cms_db_prefix().'module_products_prodtohier (product_id,hierarchy_id) VALUES (?,?)';
    $db->Execute($query,array($new_id,$hierarchy_id));
  }

//
// copy files.
//
$srcdir = cms_join_path($gCms->config['uploads_path'],$this->GetName(),'product_'.$compid);
$destdir = cms_join_path($gCms->config['uploads_path'],$this->GetName(),'product_'.$new_id);
if( is_dir($srcdir) )
  {
    $files = glob($srcdir.'/*');
    if( is_array($files) && count($files) )
      {
	@mkdir($destdir);
	foreach( $files as $onefile )
	  {
	    $fn = basename($onefile);
	    copy($onefile,cms_join_path($destdir,$fn));
	  }
      }
  }

//
// all done.. redirect to edit form
//
$this->SetMessage($this->Lang('msg_productcopied'));
$this->Redirect($id,'editproduct','',array('compid'=>$new_id));

#
# EOF
#
?>