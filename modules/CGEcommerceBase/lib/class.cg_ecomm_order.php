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

class cg_ecomm_order
{
  static public function get_order_contents($order_id)
  {
    $ordermanager = cg_ecomm::get_order_manager();
    if( !$ordermanager ) return FALSE;

    if( !method_exists($ordermanager,'get_portable_order') ) 
      return FALSE;

    $data = $ordermanager->get_portable_order($order_id);
    return $data;
  }

  
  static public function on_order_created($order_id)
  {
    $cart = cg_ecomm::get_order_manager();
    $parms['order_id'] = $order_id;
    $mod = cge_utils::get_module('CGEcommerceBase');
    $mod->SendEvent('OrderCreated',$parms);
  }


  static public function on_order_updated($order_id)
  {
    $cart = cg_ecomm::get_cart_module();
    $parms['order_id'] = $order_id;
    $mod = cge_utils::get_module('CGEcommerceBase');
    $mod->SendEvent('OrderUpdated',$parms);
  }


  static public function on_order_deleted($order_id)
  {
    $cart = cg_ecomm::get_cart_module();
    $parms['order_id'] = $order_id;
    $mod = cge_utils::get_module('CGEcommerceBase');
    $mod->SendEvent('OrderDeleted',$parms);
  }


  static public function on_gateway_transaction($order_id)
  {
    $cart = cg_ecomm::get_cart_module();
    $parms['order_id'] = $order_id;
    $mod = cge_utils::get_module('CGEcommerceBase');
    $mod->SendEvent('OnGatewayTransaction',$parms);
  }

} // end of class

#
# EOF
#
?>