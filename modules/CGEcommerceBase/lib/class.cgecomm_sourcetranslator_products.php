<?php

class cgecomm_sourcetranslator_products implements cg_ecomm_sourcetranslator
{
  public function get_product_info($product_id)
  {
    $products = cge_utils::get_module('Products');
    $raw_info = $products->get_product_info($product_id);
    if( !$raw_info ) return FALSE;
    if( $raw_info['status'] != 'published' ) return FALSE;

    $mod = cge_utils::get_module('CGEcommerceBase');
    $dimensions_fld = $mod->GetPreference('ship_dimensions');

    $obj = new cg_ecomm_productinfo();
    $obj->set_product_id($raw_info['id']);

    $name = '';
    if( isset($raw_info['product_name']) ) $name = $raw_info['product_name'];
    if( !$name && isset($raw_info['name']) ) $name = $raw_info['name'];
    $obj->set_name($name);
	
    $obj->set_weight($raw_info['weight']);
    $obj->set_sku($raw_info['sku']);
    $obj->set_discount($raw_info['discount']);
    $obj->set_price($raw_info['price']);
    $obj->set_name($raw_info['product_name']);
    $obj->set_taxable($raw_info['taxable']);
    $obj->set_type(cg_ecomm_productinfo::TYPE_PRODUCT);
	$obj->set_curency($raw_info['curency']);
	//echo $obj->get_curency();
    // get fields.
    if( isset($raw_info['fields']) )
      {
	// attempt to find subscription info
	$dimensions_set = FALSE;
	foreach( $raw_info['fields'] as &$fld )
	  {
	    if( $fld->type == 'dimensions' && $fld->id == $dimensions_fld && $dimensions_set == FALSE )
	      {
		// get the dimensions.
		$obj->set_dimensions($fld->value['length'],$fld->value['width'],$fld->value['height']);
		$dimensions_set = TRUE;
		continue;
	      }

	    if( $fld->type == 'subscription' )
	      {
		$subscr = new cg_ecomm_productinfo_subscription;
		$subscr->set_payperiod($fld->value['payperiod']);
		$subscr->set_deliveryperiod($fld->value['delperiod']);
		$subscr->set_expiry($fld->value['expire']);
		$obj->set_subscription($subscr);
		continue;
	      }
	  }
      }

    // get attributes.
    if( isset($raw_info['attributes']) )
      {
	foreach( $raw_info['attributes'] as $attr_id => $attr_data )
	  {
	    if( !isset($attr_data['name']) || !isset($attr_data['values']) ) continue;

	    $attr = new cg_ecomm_productinfo_attribute($attr_id,$attr_data['name']);
	    foreach( $attr_data['values'] as $option )
	      {
		$attr_option = new cg_ecomm_productinfo_attrib_option($option['attrib_id'],$option['attrib_text'],
								      $option['sku'],$option['attrib_adjustment']);
		$attr->add_option($attr_option);
	      }
	    $obj->add_attribute($attr);
	  }
      }

    return $obj;
  }

} // class

?>