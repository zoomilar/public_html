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

class products_query implements ArrayAccess
{
  private static $_keys = array('productid','product_id','productlist','category','categoryid','excludecat','hierarchy','hierarchyid','fieldid','fieldval','sortorder',
				'sortby','sorttype','pagelimit','limit','page','status');
  private static $_sortings = array('id','product_name','price','create_date','modified','status','weight','random', 'order_hierarchy');
  private $_data = array();
  private $_origparms = null;
  private $_sortfield = 0;
  
  public function __construct($data = array())
  {
    $this->_origparms = $data;
    $this->reset();
  }

  public function reset()
  {
    $mod = cms_utils::get_module('Products');
    $this->_data['pagelimit'] = $mod->GetPreference('summary_pagelimit',10000);
	$sortby = $mod->GetPreference('sortby','product_name');
	
	if ($sortby == 'order_hierarchy') {
		$sortby = 'PH.order_id';
	}
	
    $this->_data['sortby'] = $sortby;
    $this->_data['sortorder'] = $mod->GetPreference('sortorder','DESC');
    $this->_data['status'] = 'published';
	$this->_data['page'] = 1;

    foreach( $this->_origparms as $key => $value ) {
      if( in_array($key,self::$_keys) ) {
		$this[$key] = $value;
      }
    }
  }

  public function offsetGet($key)
  {
    if( !in_array($key,self::$_keys) )
      throw new ProductsException('Get: invalid key '.$key.' specified for products_query');

    if( isset($this->_data[$key]) )
      return $this->_data[$key];
  }

  public function offsetSet($key,$value)
  {
    if( !in_array($key,self::$_keys) )
      throw new Exception('Set: Invalid Key '.$key.' specified for products_query');

    if( !$value ) return;

    $mod = cms_utils::get_module('Products');
    switch( $key ) {
	case 'status':
	  $value = strtolower($value);
	  switch( $value ) {
	  case 'draft':
	  case 'disabled':
	  case 'published':
	  case '!draft':
	  case '!disabled':
	  case '!published':
	  case '*':
		$this->_data['status'] = $value;
		break;
	  }
	  break;

    case 'productid':
    case 'product_id':
      $this->_data['product_id'] = (int)$value;
      unset($this->_data['productlist']);
      break;
      
    case 'productlist':
      $tmp = explode(',',$value);
      if( is_array($tmp) && count($tmp) ) {
		foreach( $tmp as &$one ) {
		  $one = (int)$one;
		}
		$value = implode(',',$tmp);
		$this->_data[$key] = $value;
      }
      unset($this->_data['product_id']);
      break;

    case 'category':
      $this->_data[$key] = trim($value);
      unset($this->_data['categoryid']);
      break;

    case 'categoryid':
      $this->_data[$key] = (int)$value;
      unset($this->_data['category']);
      break;

    case 'excludecat':
      $this->_data[$key] = trim($value);
      break;

    case 'hierarchy':
      $this->_data[$key] = trim($value);
      unset($this->_data['hierarchyid']);
      break;

    case 'hierarchyid':
      $this->_data[$key] = (int)$value;
      unset($this->_data['hierarchy']);
      break;

    case 'fieldid':
      $this->_data[$key] = (int)$value;
      break;

    case 'fieldval':
      $this->_data[$key] = trim($value);
      break;

    case 'sortorder':
      $value = strtolower(trim($value));
      switch( $value ) {
      case 'asc':
      case 'desc':
		$this->_data[$key] = $value;
		break;
      }
      break;

    case 'sortby':
      $value = strtolower(trim($value));
      if( in_array($value,self::$_sortings) ) {
		$this->_data[$key] = $value;
      } else if( startswith($value,'f:') ) {
		$fieldname = substr($tmp,strlen('f:'));
		if( isset($this->_fielddefs[$fieldname]) ) {
		  $this->_data[$key] = $value;
		}
      }
      break;

    case 'sorttype':
      $value = trim(strtoupper($value));
      switch( $value ) {
      case 'STRING':
		$this->_data[$key] = '';
		break;
      case 'SIGNED':
      case 'UNSIGNED':
		$this->_data[$key] = $value;
		break;
      }
      break;

    case 'pagelimit':
    case 'limit':
      $value = max(1,(int)$value);
      $this->_data['pagelimit'] = $value;
      break;

    case 'page':
      $value = max(1,(int)$value);
      $this->_data['page'] = $value;
      break;
    }
  }

  public function offsetExists($key)
  {
    if( !in_array($key,self::$_keys) )
      throw new ProductsException('Exists: Invalid Key '.$key.' specified for products_query');

    return isset($this->_data[$key]);
  }

  public function offsetUnset($key)
  {
    if( !in_array($key,self::$_keys) )
      throw new ProductsException('Exists: Invalid Key '.$key.' specified for products_query');

    return FALSE;
  }

  public function &execute()
  {
    $rs = new products_resultset($this);
    return $res;
  }
} // end of class

#
# EOF
#
?>