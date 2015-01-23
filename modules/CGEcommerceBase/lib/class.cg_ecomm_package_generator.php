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

class cg_ecomm_package_generator
{
  private $_profile;
  private $_items;
  private $_packages;
  private $_error;


  public function __construct()
  {
    $mod = cge_utils::get_module('CGEcommerceBase');
    $tmp = $mod->GetPreference('packaging_profile');
    if( $tmp )
      {
	$this->_profile = unserialize($tmp);
      }
  }


  public function set_profile(cg_ecomm_packaging_profile $profile)
  {
    $this->_profile = $profile;
  }
  

  public function reset()
  {
    $this->_items = null;
    $this->_error = null;
    $this->_packages = null;
  }


  public function add_item(cg_ecomm_packaging_box $box)
  {
    if( !is_array($this->_items) ) $this->_items = array();
    $this->_items[] = $box;
  }


  public function get_packages()
  {
    if( !is_array($this->_packages) || count($this->_packages) == 0 )
      return $this->_items;

    return $this->_packages;
  }


  public function get_error()
  {
    return $this->_error;
  }


  /**
   * Calculate package given the items
   * 
   * @return boolean
   */
  public function calculate()
  {
    if( !$this->_profile || !$this->_items || count($this->_items) == 0 )
      {
	// nothing to do.
	return FALSE;
      }
    $module = cg_ecomm::get_packaging_module();
    if( !$module )
      {
	// no module to do anything.... we'll just pretend it worked.
	return TRUE;
      }
    
    return FALSE;
  }

} // end of class

#
# EOF
#
?>