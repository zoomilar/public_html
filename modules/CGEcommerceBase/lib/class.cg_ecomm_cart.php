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

class cg_ecomm_cart
{
  static public function get_cart_contents($feu_uid = -1)
  {
    $cart = cg_ecomm::get_cart_module();
    if( $cart->GetNumItems() <= 0 ) return FALSE;

    $names = $cart->GetBasketNames();
    $data = array();
    foreach( $names as $basket_name )
      {
	$data[$basket_name] = array();
	$data[$basket_name]['details'] = $cart->GetBasketDetails($basket_name,$feu_uid);
	$data[$basket_name]['items'] = $cart->GetBasketItems($basket_name,$feu_uid);
      }
    return $data;
  }


  static public function before_add_cartitem(cg_ecomm_cartitem& $obj)
  {
    $parms = array();
    $parms['existing_items'] = self::get_cart_contents();
    $parms['cart_item'] =& $obj;
    $mod = cge_utils::get_module('CGEcommerceBase');
    $mod->SendEvent('CartItemAddPre',$parms);
  }


  static public function on_cart_item_added(cg_ecomm_cartitem &$obj)
  {
    $parms['cart_item'] =& $obj;
    $mod = cge_utils::get_module('CGEcommerceBase');
    $mod->SendEvent('CartItemAdded',$parms);
  }


  static public function on_cart_adjusted($status = '',$adddata = '')
  {
    $cart = cg_ecomm::get_cart_module();
    $parms['cart_items'] = self::get_cart_contents();
    $parms['status'] = $status;
    $parms['extra'] = $adddata;
    $mod = cge_utils::get_module('CGEcommerceBase');
    $mod->SendEvent('CartAdjusted',$parms);
  }


  public static function get_cartitem_policy()
  {
    $policy = cg_ecomm::get_payment_cartitem_policy();

    // merge in any settings from the module
    // todo:
    $spolicy = cg_ecomm::get_system_cartitem_policy();
    $policy->merge($spolicy);
    
    return $policy;
  }


  /**
   * Check the cart contents, and a new item against the cart item policy
   * to see if this new item can be added.
   */
  public static function check_cartitem_valid($existing_items,
					      cg_ecomm_cartitem& $new_item,
					      &$message = '')
  {
    // 1.  Build a policy 
    $policy = self::get_cartitem_policy();

    // check for services, products, and subscription in existing
    // cart items.
    $have_services = 0;
    $have_products = 0;
    $have_subscriptions = 0;
    foreach( $existing_items as &$one_item )
      {
	if( $one_item->get_type() == cg_ecomm_cartitem::TYPE_SERVICE )
	  {
	    $have_services++;
	  }
	else if( $one_item->get_type() == cg_ecomm_cartitem::TYPE_PRODUCT )
	  {
	    $have_products++;
	  }
	
	if( ($tmp = $one_item->get_subscription()) )
	  {
	    if( $tmp->get_payperiod() != cg_ecomm_productinfo_subscription::SUBSCR_PERIOD_NONE )
	      {
		$have_subscriptions++;
	      }
	  }
      }

    // check for product, service, or subscription in 
    // NEW cart item.
    $new_service = 0;
    $new_product = 0;
    if( $new_item->get_type() == cg_ecomm_cartitem::TYPE_SERVICE )
      {
	$new_service = 1;
	$have_services++;
      }
    if( $new_item->get_type() == cg_ecomm_cartitem::TYPE_PRODUCT )
      {
	$new_product = 1;
	$have_products++;
      }
    $new_subscription = 0;
    $tmp = $new_item->get_subscription();
    if( is_object($tmp) && $tmp->is_valid() )
      {
	$new_subscription = 1;
	$have_subscriptions++;
      }

    // now cross reference this information against our policy.
    if( !$policy->handle_products() && $have_products )
      {
	return FALSE;
      }

    if( !$policy->handle_services() && $have_services )
      {
	return FALSE;
      }

    if( !$policy->handle_subscriptions() && $have_subscriptions )
      {
	return FALSE;
      }

    $tmp = $policy->max_subscriptions();
    if( $tmp > 0 && $tmp < $have_subscriptions )
      {
	return FALSE;
      }

    if( !$policy->handle_mixed_subscriptions() && 
	$have_subscriptions &&
	(($have_products+$have_services) > 1) )
      {
	return FALSE;
      }

    return TRUE;
  }

  public static function calculate_cartitem_summary($product_info,$selected_attribs,cg_ecomm_cartitem $item)
  {
    global $gCms;
    $smarty = $gCms->GetSmarty();
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    $smarty->assign('currency_symbol',$ecomm->GetPreference('currency_symbol'));
    $smarty->assign('weight_units',$ecomm->GetPreference('weight_units'));
    $smarty->assign('currency_code',$ecomm->GetPreference('currency_code'));
    $smarty->assign('product_obj',$product_info);
    $smarty->assign('cart_item',$item);

    // hack for backwards compatibility
    if( is_object($product_info) )
      {
	$tmp = array();
	$tmp['product_name'] = $product_info->get_name();
	$smarty->assign('oneproduct',$tmp);
      }

    $meta = new stdClass;
    $meta->attributes = $selected_attribs;
    $smarty->assign('meta',$meta);
    $str = $ecomm->ProcessTemplateFromDatabase('lineitem_desc_template');
    $str = strip_tags($str);
    $str = str_replace('&nbsp;',' ',$str);
    $str = html_entity_decode($str); // remove those nasty &nbsp; things. etc.
    $str = trim($str);
    return $str;
  }
} // end of class

#
# EOF
#
?>