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

class cg_ecomm_cartitem_policy
{
  private $_max_services = 1000000;
  private $_max_products = 1000000;
  private $_max_subscriptions = 1000000;
  private $_mixed_subscriptions = 1;

  public function set_max_services($num)
  {
    $this->_max_services = (int)$num;
  }

  public function set_max_products($num)
  {
    $this->_max_products = (int)$num;
  }

  public function set_max_subscriptions($num)
  {
    $this->_max_subscriptions = (int)$num;
  }

  public function set_mixed_subscriptions($flag)
  {
    if( $flag )
      $this->_mixed_subscriptions = 1;
    else
      $this->_mixed_subscriptions = 0;
  }

  public function handle_services()
  {
    return ($this->_max_services != 0);
  }

  public function max_services()
  {
    return $this->_max_services;
  }

  public function handle_products()
  {
    return ($this->_max_products != 0);
  }

  public function max_products()
  {
    return $this->_max_products;
  }

  public function handle_subscriptions()
  {
    return ($this->_max_subscriptions != 0)?1:0;
  }

  public function max_subscriptions()
  {
    return $this->_max_subscriptions;
  }

  public function handle_mixed_subscriptions()
  {
    return $this->_mixed_subscriptions;
  }

  public function merge(cg_ecomm_cartitem_policy& $in)
  {
    $this->_max_services = min($this->_max_services,$in->_max_services);
    $this->_max_products = min($this->_max_products,$in->_max_products);
    $this->_max_subscriptions = min($this->_max_subscriptions,$in->_max_subscriptions);
    if( !$this->_mixed_subscriptions ||
	!$in->_mixed_subscriptions )
      $this->_mixed_subscriptions = 0;
  }
}

#
# EOF
#
?>