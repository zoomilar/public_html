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

class cgecomm_smarty
{
  protected function __construct() {} // static class.. cannot be instantiated

  public static function init()
  {
    $smarty = cmsms()->GetSmarty();
    $smarty->register_function('cgecomm_currency_code',array('cgecomm_smarty','cgecomm_currency_code'));
    $smarty->register_function('cgecomm_currency_symbol',array('cgecomm_smarty','cgecomm_currency_symbol'));
    $smarty->register_function('cgecomm_weight_units',array('cgecomm_smarty','cgecomm_weight_units'));
    $smarty->register_function('cgecomm_length_units',array('cgecomm_smarty','cgecomm_length_units'));
    $smarty->register_function('cgecomm_company_address',array('cgecomm_smarty','cgecomm_company_address'));
    $smarty->register_function('cgecomm_cartitem_exists',array('cgecomm_smarty','cgecomm_cartitem_exists'));
    $smarty->register_function('cgecomm_form_addtocart',array('cgecomm_smarty','cgecomm_form_addtocart'));
    $smarty->register_function('cgecomm_erasecart',array('cgecomm_smarty','cgecomm_erasecart'));
    $smarty->register_function('cgecomm_get_productinfo',array('cgecomm_smarty','cgecomm_get_productinfo'));
  }


  public static function cgecomm_currency_code($params,&$smarty)
  {
    $code = cg_ecomm::get_currency_code();
    if( isset($params['assign']) )
      {
	$smarty->assign($params['assign'],$code);
	return;
      }
    return $code;
  }


  public static function cgecomm_currency_symbol($params,&$smarty)
  {
    $code = cg_ecomm::get_currency_symbol();
    if( isset($params['assign']) )
      {
	$smarty->assign($params['assign'],$code);
	return;
      }
    return $code;
  }


  public static function cgecomm_weight_units($params,&$smarty)
  {
    $code = cg_ecomm::get_weight_units();
    if( isset($params['assign']) )
      {
	$smarty->assign($params['assign'],$code);
	return;
      }
    return $code;
  }


  public static function cgecomm_length_units($params,&$smarty)
  {
    $code = cg_ecomm::get_length_units();
    if( isset($params['assign']) )
      {
	$smarty->assign($params['assign'],$code);
	return;
      }
    return $code;
  }


  public static function cgecomm_company_address($params,&$smarty)
  {
    $mod = cms_utils::get_module('CGEcommerceBase');
    $tmp = $mod->GetPreference('myinfo_address');
    $my_address = null;
    if( $tmp )
      {
	$my_address = unserialize($tmp);
      }
    else
      {
	$my_address = new cg_ecomm_company_address;
      }
    if( is_object($my_address) ) return;

    if( isset($params['assign']) )
      {
	$smarty->assign($params['assign'],$my_address);
	return;
      }
    return $my_address;
  }


  public static function cgecomm_cartitem_exists($params,&$smarty)
  {
    $source = 'Products';
    $product = '';
    $sku = '';
    $extra = null;
    if( isset($params['source']) ) $source = trim($params['source']);
    if( isset($params['product']) ) $product = (int)$params['product'];
    if( isset($params['sku']) ) $sku = trim($params['sku']);
    if( isset($params['extra']) ) $extra = $params['extra'];

    $res = 0;
    $cart = cg_ecomm::get_cart_module();
    if( $source && ($product || $sku) && $cart )
      {
	if( $product && method_exists($cart,'check_itemid_exists') )
	  {
	    $res = $cart->check_itemid_exists($source,$product,$extra);
	  }
	else if( $sku && method_exists($cart,'check_sku_exists') )
	  {
	    $res = $cart->check_sku_exists($source,$sku,$extra);
	  }
	$res = ($res)?1:0;
      }

    if( isset($params['assign']) )
      {
	$smarty->assign($params['assign'],$res);
	return;
      }
    return $res;
  }


  public static function cgecomm_form_addtocart($params,&$smarty)
  {
    $cart = cg_ecomm::get_cart_module();
    if( !method_exists($cart,'get_addtocart_form') ) return;

    $cart_name = $cart->GetName();
    $smarty = cmsms()->GetSmarty();
    $params['module'] = $cart_name;
    $txt = cms_module_plugin($params,$smarty);
    return $txt;
  }


  public static function cgecomm_erasecart($params,&$smarty)
  {
    $cart = cg_ecomm::get_cart_module();
    $cart->EraseCart();
  }


  public static function cgecomm_get_productinfo($params,&$smarty)
  {
    $source = 'Products';
    $entry_id = '';

    if( !isset($params['itemid']) ) return;
    if( isset($params['source']) ) $source = trim($params['source']);
    $item_id = (int)$params['itemid'];

    try
      {
	$info = cg_ecomm::get_product_info($source,$item_id);
	if( is_object($info) && isset($params['assign']) )
	  {
	    $smarty->assign(trim($params['assign']),$info);
	    return;
	  }
	return $info;
      }
    catch( Exception $e )
      {
	// do nothing.
      }
  }
} // end of class

#
# EOF
#
?>
