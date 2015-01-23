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
if( !isset($gCms) ) exit;

$weight_units = cg_ecomm::get_weight_units();
$length_units = cg_ecomm::get_length_units();
$smarty->assign('formstart',$this->CGCreateFormStart($id,'defaultadmin'));
$smarty->assign('formend',$this->CreateFormEnd());

$tmp = module_helper::get_modules_with_method('CalculatePackages');
$module_list = cge_array::hash_prepend($tmp,-1,$this->Lang('none'));
$smarty->assign('packaging_modules',$module_list);
$smarty->assign('packaging_module',$this->GetPreference('packaging_module',-1));

$tmp = $this->GetPreference('packaging_profile');
$packaging_profile = new cg_ecomm_packaging_profile();
if( isset($params['packaging_submit']) )
  {
    $overweight_limit = (float)$params['overweight_limit'];
    if( !cge_units::is_weight_metric($weight_units) )
      {
	$overweight_limit *= cge_units::LBS_TO_KG;
      }
    $packaging_profile->set_overweight_limit($overweight_limit);

    $boxes = array();
    foreach( $params['box_name'] as $key => $name )
      {
	$name = trim($params['box_name'][$key]);
	$width =  (float)$params['box_width'][$key];
	$height = (float)$params['box_height'][$key];
	$length = (float)$params['box_length'][$key];
	$weight = (float)$params['box_weight'][$key];
	$score = (int)$params['box_score'][$key];

	if( !empty($name) && $width > 0 && $height > 0 && $length > 0 && $weight > 0 )
	  {
	    if( !cge_units::is_length_metric($length_units) )
	      {
		$width *= cge_units::INCHES_TO_CM;
		$height *= cge_units::INCHES_TO_CM;
		$length *= cge_units::INCHES_TO_CM;
	      }
	    if( !cge_units::is_weight_metric($weight_units) )
	      {
		$weight *= cge_units::LBS_TO_KG;
	      }
	    $box = new cg_ecomm_packaging_box($name,$weight,$score);
	    $box['width'] = $width;
	    $box['height'] = $height;
	    $box['length'] = $length;
	    $box['weight'] = $weight;
	    if( $box->is_valid() )
	      {
		$boxes[] = $box;
	      }
	  }

	// sort the boxes.
	uasort($boxes,array('cg_ecomm_packaging_box','cmp'));
	$packaging_profile->set_boxes($boxes);
      }

    if( isset($params['ship_seperately']) )
      {
	$this->SetPreference('ship_seperately',trim($params['ship_seperately']));
      }
    if( isset($params['ship_dimensions']) )
      {
	$this->SetPreference('ship_dimensions',trim($params['ship_dimensions']));
      }
    $this->SetPreference('packaging_module',trim($params['packaging_module']));
    $this->SetPreference('packaging_profile',serialize($packaging_profile));
  }
else if($tmp)
  {
    $packaging_profile = unserialize($tmp);
    debug_display($packaging_profile);
  }

// convert the shipping profile back into display units.
if( !cge_units::is_weight_metric($weight_units) )
  {
    $packaging_profile->set_overweight_limit($packaging_profile->get_overweight_limit()*cge_units::KG_TO_LBS);
  }
for( $i = 0; $i < $packaging_profile->get_box_count(); $i++ )
  {
    $item = $packaging_profile->get_box_at($i);
    if( !cge_units::is_weight_metric($weight_units) )
      {
	$item['weight'] = $item['weight'] * cge_units::KG_TO_LBS;
      }
    if( !cge_units::is_length_metric($length_units) )
      {
	$item['width'] = $item['width'] * cge_units::CM_TO_INCHES;
	$item['height'] = $item['height'] * cge_units::CM_TO_INCHES;
	$item['length'] = $item['length'] * cge_units::CM_TO_INCHES;
      }
  }

// add a dummy box.
$box = new cg_ecomm_packaging_box('',0.0,$packaging_profile->get_box_count()+1);
$packaging_profile->add_box($box);

// hack should be source module independant
if( class_exists('product_ops') )
  {
    $product_fields = array('-1'=>$this->Lang('none'));
    $tmp = product_ops::get_field_options('checkbox');
    if( $tmp )
      {
	$product_fields = cge_array::hash_prepend($tmp,-1,$this->Lang('none'));
      }
    $smarty->assign('products_checkboxes',$product_fields);

    $product_fields = array('-1'=>$this->Lang('none'));
    $tmp = product_ops::get_field_options('dimensions');
    if( $tmp )
      {
        $product_fields = cge_array::hash_prepend($tmp,-1,$this->Lang('none'));
      }
    $smarty->assign('products_dimensions',$product_fields);
  }
// hack

$smarty->assign('ship_seperately',$this->GetPreference('ship_seperately',-1));
$smarty->assign('ship_dimensions',$this->GetPreference('ship_dimensions',-1));
$smarty->assign('shipping_profile',$packaging_profile);
$smarty->assign('length_units',$length_units);
$smarty->assign('weight_units',$weight_units);
echo $this->ProcessTemplate('admin_packaging_tab.tpl');

#
# EOF
#
?>