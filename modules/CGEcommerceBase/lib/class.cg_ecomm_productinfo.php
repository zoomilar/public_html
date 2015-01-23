<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGExtensions (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to provide useful functions
#  and commonly used gui capabilities to other modules.
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

class cg_ecomm_productinfo_attrib_option
{
  private $_id;
  private $_text;
  private $_adjustment;
  private $_sku;

  public function __construct($id,$text,$sku,$adjustment)
  {
    $this->_id = $id;
    $this->_text = $text;
    $this->_sku = $sku;
    $this->_adjustment = $adjustment;
  }

  public function get_id()
  {
    return $this->_id;
  }

  public function get_text()
  {
    return $this->_text;
  }

  public function get_sku()
  {
    return $this->_sku;
  }

  public function get_adjustment()
  {
    return $this->_adjustment;
  }

  public function to_array()
  {
    $tmp = array();
    $tmp['id'] = $this->_id;
    $tmp['text'] = $this->_text;
    $tmp['sku'] = $this->_sku;
    $tmp['adjustment'] = $this->_adjustment;
    return $tmp;
  }

  public function from_array($data)
  {
    $this->_id = $data['id'];
    $this->_text = $data['text'];
    $this->_sku = $data['sku'];
    $this->_adjustment = $data['adjustment'];
  }
}


class cg_ecomm_productinfo_attribute
{
  private $_id;
  private $_name;
  private $_options = array();

  public function __construct($id,$name)
  {
    $this->_id = $id;
    $this->_name = $name;
  }

  public function get_id()
  {
    return $this->_id;
  }

  public function get_name()
  {
    return $this->_name;
  }

  public function count_options()
  {
    return count($this->_options);
  }

  public function add_option(cg_ecomm_productinfo_attrib_option $attrib)
  {
    $this->_options[] = $attrib;
  }

  public function get_option_by_text($txt)
  {
    for( $i = 0; $i < count($this->_options); $i++ )
      {
	$obj =& $this->_options[$i];
	if( $obj->get_text() == $txt )
	  {
	    return $obj;
	  }
      }
  }

  public function get_option_by_idx($idx)
  {
    if( $idx < 0 || $idx > count($this->_options) - 1 ) return FALSE;
    return $this->_options[$idx];
  }


  public function get_option_by_id($id)
  {
    $fnd = FALSE;
    for( $i = 0; $i < count($this->_options); $i++ )
      {
	$obj =& $this->_options[$i];
	if( $obj->get_id() == $id )
	  {
	    $fnd = $obj;
	    break;
	  }
      }
    return $fnd;
  }


  public function to_array()
  {
    $tmp = array();
    $tmp['id'] = $this->_id;
    $tmp['name'] = $this->_name;
    if( count($this->_options) )
      {
	$tmp['attribs'] = array();
	foreach( $this->_options as $one )
	  {
	    $tmp['attribs'][] = $one->to_array();
	  }
      }
    return $tmp;
  }

  public function from_array($data)
  {
    $this->_id = $data['id'];
    $this->_name = $data['name'];
    $this->_options = array();
    if( isset($data['attribs']) && is_array($data['attribs']) )
      {
	foreach( $data['attribs'] as $one )
	  {
	    $obj = new cg_ecomm_productinfo_attrib_option;
	    $this->_options[] = $obj->to_array($one);
	  }
      }
  }

  public function get_dropdown_options()
  {
    if( !count($this->_options) ) return FALSE;
	//
    $output = array();
    foreach( $this->_options as $one )
      {
	  
	$output[$one->get_id()] = cg_ecomm::get_displayable_attribute_option($one);
      }
	  
	  
    return $output;
  }
}


class cg_ecomm_productinfo
{
  const   TYPE_PRODUCT = 1;
  const   TYPE_SERVICE = 3;

  private $_product_id = null;
  private $_weight = null;
  private $_sku = null;
  private $_price = null;
  private $_discount = null;
  private $_curency = null;
  private $_name = null;
  private $_taxable = null;
  private $_type = self::TYPE_PRODUCT;
  private $_subscription = null;
  private $_attributes = array();
  private $_dimensions;

  public function get_type()
  {
    return $this->_type;
  }


  public function set_type($type)
  {
    switch( $type )
      {
      case self::TYPE_PRODUCT:
      case self::TYPE_SERVICE:
	$this->_type = $type;
	break;
      }
  }
  public function set_discount($val) {
	$this->_discount = floatval($val);
  }
  
  public function get_discount() {
	return $this->_discount;
  }

  public function get_product_id()
  {
    return $this->_product_id;
  }


  public function set_product_id($val)
  {
    $this->_product_id = (int)$val;
  }


  public function get_weight()
  {
    return $this->_weight;
  }


  public function set_weight($val)
  {
    $this->_weight = (float)$val;
  }


  public function get_dimensions()
  {
    return $this->_dimensions;
  }


  public function set_dimensions($l,$w,$h)
  {
    $this->_dimensions = array($l,$w,$h);
  }

  public function get_sku()
  {
    return $this->_sku;
  }


  public function set_sku($val)
  {
    $this->_sku = trim($val);
  }


  public function get_price()
  {
    return $this->_price;
  }


  public function set_price($val)
  {
    $this->_price = (float)$val;
  }
  
  public function get_curency()
  {
    return $this->_curency;
  }

  public function set_curency($cur)
  {
    $this->_curency = $cur;
  }
  

  public function get_name()
  {
    return $this->_name;
  }


  public function set_name($val)
  {
    $this->_name = trim($val);
  }


  public function get_taxable()
  {
    return $this->_taxable;
  }


  public function set_taxable($val)
  {
    $this->_taxable = (int)$val;
  }


  public function get_subscription()
  {
    return $this->_subscription;
  }


  public function set_subscription(cg_ecomm_productinfo_subscription $obj)
  {
    $this->_subscription = $obj;
  }


  public function count_attributes()
  {
    return count($this->_attributes);
  }


  public function add_attribute(cg_ecomm_productinfo_attribute $attr)
  {
    $this->_attributes[] = $attr;
  }
  
  public function get_all_attributes() {
	return $this->_attributes;
  }


  public function get_attr_by_idx($idx)
  {
    if( $idx < 0 || $idx > count($this->_attributes) - 1 ) return FALSE;
    return $this->_attributes[$idx];
  }


  public function get_attr_by_id($id)
  {
    $fnd = FALSE;
    for( $i = 0; $i < count($this->_attributes); $i++ )
      {
	$obj =& $this->_attributes[$i];
	if( $obj->get_id() == $id )
	  {
	    $fnd = $obj;
	    break;
	  }
      }
    return $fnd;
  }


  public function get_attr_by_name($name)
  {
    if( !$name ) return;
    for( $i = 0; $i < count($this->_attributes); $i++ )
      {
	$obj =& $this->_attributes[$i];
	if( $obj->get_name() == $name )
	  {
	    return $obj;
	  }
      }
  }
}

#
# EOF
#
?>