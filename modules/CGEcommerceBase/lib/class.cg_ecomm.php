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

final class cg_ecomm
{
  protected function __construct() {} // static class... cannot be instantiated.

  public static function get_currency_symbol()
  {
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    return $ecomm->GetPreference('currency_symbol','$');
  }


  public static function get_currency_code()
  {
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    return $ecomm->GetPreference('currency_code','USD');
  }


  public static function get_weight_units()
  {
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    return $ecomm->GetPreference('weight_units','lbs');
  }


  public static function get_length_units()
  {
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    return $ecomm->GetPreference('length_units','in');
  }


  public static function get_supplier_modules()
  {
    $res = FALSE;
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    $tmp = $ecomm->GetPreference('supplier_modules');
    if( !empty($tmp) )
      {
	$res = explode(',',$tmp);
      }
    return $res;
  }


  public static function is_supplier_module($name)
  {
    $tmp = self::get_supplier_modules();
    if( !is_array($tmp) ) return FALSE;
    if( !in_array($name,$tmp) ) return FALSE;
    return TRUE;
  }


  public static function &get_supplier_module($source)
  {
    $res = null;
    if( self::is_supplier_module($source) )
      {
	$res = cge_utils::get_module($source);
      }
    return $res;
  }


  public static function &get_cart_module()
  {
    $res = null;
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    $modname = $ecomm->GetPreference('cart_module');
    if( $modname == '' || $modname == '-1' ) return $res;

    return cge_utils::get_module($modname);
  }


  public static function &get_tax_module()
  {
    $res = null;
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    $modname = $ecomm->GetPreference('tax_module');
    if( $modname == '' || $modname == '-1' ) return $res;

    return cge_utils::get_module($modname);
  }


  public static function &get_packaging_module()
  {
    $res = null;
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    $modname = $ecomm->GetPreference('packaging_module');
    if( $modname == '' || $modname == '-1' ) return $res;

    return cge_utils::get_module($modname);
  }


  public static function &get_shipping_module()
  {
    $res = null;
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    $modname = $ecomm->GetPreference('shipping_module');
    if( $modname == '' || $modname == '-1' ) return $res;

    return cge_utils::get_module($modname);
  }


  public static function &get_promotions_module()
  {
    $res = null;
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    $modname = $ecomm->GetPreference('promotions_module');
    if( $modname == '' || $modname == '-1' ) return $res;

    return cge_utils::get_module($modname);
  }


  public static function &get_payment_module()
  {
    $res = null;
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    $modname = $ecomm->GetPreference('payment_module');
    if( $modname == '' || $modname == '-1' ) return $res;

    return cge_utils::get_module($modname);
  }


  public static function &get_order_manager()
  {
    // todo: this can be changed.
    return cge_utils::get_module('Orders');
  }

  
  public static function reset_lineitem_desc()
  {
    $ecomm = null;
    if( version_compare(CMS_VERSION,'1.10-beta0') < 0 )
      {
	$ecomm = cge_utils::get_module('CGEcommerceBase');
      }
    else
      {
	$ecomm = ModuleOperations::get_instance()->get_module_instance('CGEcommerceBase','',TRUE);
      }
    if( !$ecomm ) return;

    $fn = $ecomm->GetModulePath().'/templates/orig_lineitem_desc_template.tpl';
    if( file_exists($fn) )
      {
	$data = @file_get_contents($fn);
	$ecomm->SetTemplate('lineitem_desc_template',$data);
      }
  }


  public static function get_product_info($source,$product_id)
  {
	
    $module = self::get_supplier_module($source);
    if( $module )
      {
	  
	if( method_exists($module,'get_product_info') )
	  {
		
	    $tmp = $module->get_product_info($product_id);
	    if( is_object($tmp) && ($res instanceof cg_ecomm_productinfo) )
	      {
		return $tmp;
	      }
	  }
      }

    // the get_product_info method didn't return an object
    // so we see if there's a translator.
    $classname = 'cgecomm_sourcetranslator_'.strtolower($source);
    if( class_exists($classname) )
      {
		//echo $classname;
	$translator = new $classname;
	$ret = $translator->get_product_info($product_id);
	return $ret;
      }

    throw new Exception('No ProductInfo Translator object available for '.$source);
  }


  public static function get_displayable_attribute_option(cg_ecomm_productinfo_attrib_option $opt)
  {
    global $gCms;
    $smarty = $gCms->GetSmarty();
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    
    $smarty->assign('currency_symbol',$ecomm->GetPreference('currency_symbol'));
    $smarty->assign('weight_units',$ecomm->GetPreference('weight_units'));
    $smarty->assign('currency_code',$ecomm->GetPreference('currency_code'));
    $template = $ecomm->GetPreference('attrib_item_description');
	
    $smarty->assign('attrib_text',$opt->get_text());
    $smarty->assign('attrib_adjust',$opt->get_adjustment());
    $smarty->assign('attrib_sku',$opt->get_sku());
    $str = $ecomm->ProcessTemplateFromData($template);
    return $str;
  }

  // deprecated.
//   public static function get_attribute_dropdown_values($product_info,$attribset_id)
//   {
//     if( !is_array($product_info) ) return FALSE;
//     if( !isset($product_info['attributes']) ) return FALSE;
//     if( !isset($product_info['attributes'][$attribset_id]) ) return FALSE;

//     global $gCms;
//     $smarty = $gCms->GetSmarty();
//     $ecomm = cge_utils::get_module('CGEcommerceBase');
    
//     $smarty->assign('currency_symbol',$ecomm->GetPreference('currency_symbol'));
//     $smarty->assign('weight_units',$ecomm->GetPreference('weight_units'));
//     $smarty->assign('currency_code',$ecomm->GetPreference('currency_code'));
//     $template = $ecomm->GetPreference('attrib_item_description');

//     $output = array();
//     foreach( $product_info['attributes'][$attribset_id]['values'] as $attrib_id => $one )
//       {
// 	$smarty->assign('attrib_text',$one['attrib_text']);
// 	$smarty->assign('attrib_adjust',$one['attrib_adjustment']);
// 	$smarty->assign('attrib_sku',$one['sku']);
// 	$str = $ecomm->ProcessTemplateFromData($template);	
// 	$output[$one['attrib_id']] = $str;
//       }
    
//     if( count($output) )
//       {
// 	return $output;
//       }

//     return FALSE;
//   }


  public static function get_company_address()
  {
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    $tmp = $ecomm->GetPreference('myinfo_address');
    $res = null;
    if( $tmp )
      {
	$res = unserialize($tmp);
      }
    return $res;
  }

  public static function get_system_cartitem_policy()
  {
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    $policy = new cg_ecomm_cartitem_policy();
    $policy->set_max_services($ecomm->GetPreference('policy_maxservices',1000000));
    $policy->set_max_products($ecomm->GetPreference('policy_maxproducts',1000000));
    $policy->set_max_subscriptions($ecomm->GetPreference('policy_maxsubscriptions',1000000));
    $policy->set_mixed_subscriptions($ecomm->GetPreference('policy_mixedsubscriptions',1));
    return $policy;
  }

  public static function get_payment_cartitem_policy()
  {
    $policy = new cg_ecomm_cartitem_policy();

    // get policy from payment gateway(s)
    $paymod = self::get_payment_module();
    if( is_object($paymod) )
      {      
	$ppolicy = $paymod->get_cartitem_policy();
	$policy->merge($ppolicy);
      }

    return $policy;
  }

  public static function can_tax_shipping()
  {
    $ecomm = cge_utils::get_module('CGEcommerceBase');
    return $ecomm->GetPreference('tax_shipping',1);
  }
} // end of class

#
# EOF
#
?>
