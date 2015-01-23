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

final class cg_ecomm_packaging_profile
{
  private $_boxes;
  private $_overweight_limit;

  public function get_overweight_limit()
  {
    return $this->_overweight_limit;
  }


  public function set_overweight_limit($val)
  {
    $this->_overweight_limit = (float)$val;
  }


  public function get_box_count()
  {
    return count($this->_boxes);
  }


  public function &get_box_at($idx)
  {
    if( $idx >= 0 && $idx < $this->get_box_count() )
      {
	return $this->_boxes[$idx];
      }
  }


  public function add_box(cg_ecomm_packaging_box& $box)
  {
    if( !is_array($this->_boxes) ) $this->_boxes = array();
    $this->_boxes[] = $box;
  }


  public function &get_boxes()
  {
    return $this->_boxes;
  }


  public function set_boxes($data)
  {
    if( !is_array($data) ) return;
    for( $i = 0; $i < count($data); $i++ )
      {
	if( !($data[$i] instanceof cg_ecomm_packaging_box) ) return;
      }
    $this->_boxes = $data;
  }


  public function to_array()
  {
    $data = array();
    $data['overweight_limit'] = $this->get_overweight_limit();
    if( count($this->_boxes) )
      {
	$data['boxes'] = array();
	for( $i = 0; $i < $this->get_box_count(); $i++ )
	  {
	    $data['boxes'][] = $this->get_box_at($i)->to_array();
	  }
      }
  }


} // class

#
# EOF
#
?>