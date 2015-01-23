<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGEcommerceBase (c) 2010 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to provide a base communications
#  layer and common preference repository for his ecommerce suite of
#  modules for CMSMS.
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

final class cg_ecomm_packaging_box implements ArrayAccess
{
  // all dimensions are in cm, all weights in kilograms.
  private $_data = array();
  static private $_keys = array('name','width','height','length','weight','value','score');


  public function __construct($name,$weight_kg,$score = 0)
  {
    $this->_data['name'] = trim($name);
    $this->_data['weight'] = $weight_kg;
    $this->_data['score'] = (int)$score;
  }

  
  public function offsetGet($key)
  {
    if( !in_array($key,self::$_keys) )
      {
	throw new Exception('Attempt to retrieve invalid property from a cg_ecomm_packaging_box object');
      }
    if( isset($this->_data[$key]) )
      return $this->_data[$key];
  }


  public function offsetSet($key,$value)
  {
    if( !in_array($key,self::$_keys) )
      {
	throw new Exception('Attempt to set invalid property into  a cg_ecomm_packaging_box object');
      }
    $this->_data[$key] = $value;
  }

  
  public function offsetExists($key)
  {
    if( !in_array($key,self::$_keys) )
      {
	throw new Exception('Attempt to retrieve invalid property from a cg_ecomm_packaging_box object');
      }
    return isset($this->_data[$key]);
  }


  public function offsetUnset($key)
  {
    if( !in_array($key,self::$_keys) )
      {
	throw new Exception('Attempt to remove property from a cg_ecomm_packaging_box object');
      }
  }


  public function is_valid()
  {
    if( !$this->_data['name'] ) return FALSE;
    if( $this->_data['weight'] <= 0 ) return FALSE;
    //if( $this->_data['value'] < 0 ) return FALSE;
    return TRUE;
  }


  static public function cmp(cg_ecomm_shipping_box& $a,cg_ecomm_shipping_box& $b)
  {
    if( $a->get_score() < $b->get_score() ) return -1;
    if( $a->get_score() > $b->get_score() ) return 1;
    if( $a->get_weight() < $b->get_weight() ) return -1;
    if( $a->get_weight() > $b->get_weight() ) return 1;
    return 0;
  }

} // class.


#
# EOF
#
?>