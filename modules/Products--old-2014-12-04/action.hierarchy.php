<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Products (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow users to create, manage
#  and display products in a variety of ways.
# 
# Version: 1.1.5
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
$config = $gCms->GetConfig();

global $kalba2, $loop_counter;

$kalba = $smarty->get_template_vars('kalba');

$kalba2 = $kalba;

$hier_a = GetModuleParameters('cntnt01');
$params = array_merge($hier_a, $params);
global $manufacturers_field_name;


$manufacturers_field_name = 'gamintojai';
$summarypage = $returnid;
if( isset($params['summarypage']) ) {
	$summarypage = $this->resolve_alias_or_id($params['summarypage']);
	if( !$summarypage ) {
		$summarypage = $returnid;
	}
} else {
	$summarypage = $this->GetPreference('summary_page_field_'.$kalba, $summarypage);

}

$hierpage = $returnid;
$tmp = $this->GetPreference('hierpage');
if( $tmp > 0 ) {
  $hierpage = $tmp;
}
if( isset($params['hierarchypage']) ) {
  $tmp = $this->resolve_alias_or_id($params['hierarchy']);
  if( $tmp ) { 
    $hierpage = $tmp;
  }
}

if( !function_exists('products_byhierarchy_postprocess') ) {
    function products_byhierarchy_postprocess(&$data,$params,$summarypage,$hierpage) {
		global $manufacturers_field_name, $kalba2, $loop_counter;
		
		if( is_array($data) ) {
			$config = cmsms()->GetConfig();
			$module = cge_utils::get_module('Products');
			$imgdir = cms_join_path($config['uploads_path'],$module->GetName(),'hierarchy');

			for( $i = 0; $i < count($data); $i++ ) {
				$rec =& $data[$i];

				$tn = cms_join_path($imgdir,'thumb_'.$rec['image']);
				if( file_exists($tn) ) {
					$rec['thumbnail'] = 'thumb_'.$rec['image'];
				}

				$tn = cms_join_path($imgdir,'preview_'.$rec['image']);
				if( file_exists($tn) ) {
					$rec['preview'] = 'preview_'.$rec['image'];
				}

				if( !isset($rec['count']) ) $rec['count'] = 0;
				
				$manuf = $module->getManufacturers($rec['id'], $manufacturers_field_name, $kalba2);
				$rec['manuf'] = $manuf;
				
				if ($rec['redirect_to'] > 0) {
					if ($rec['redirect_to'] != $rec['id']) {
						//patikrinimas kad nebutu loopas
						$loop_counter = 0;
						$rec['redirect_to'] = $module->get_redirect_to($rec['redirect_to']);
						if ($rec['redirect_to'] > 0) {
							$rec['id2'] = $rec['redirect_to'];
						}
						
					}
				}
				
				$parms = $params;
				if ($rec['id2'] > 0) {
					$parms['parent'] = $rec['id'];
				} else {
					$parms['parent'] = $rec['id'];
				}
				$rec['down_url'] = $module->CreateURL('cntnt01','hierarchy',$hierpage,$parms);

				$parms = $params;
				if ($rec['id2'] > 0) {
					$parms['hierarchyid'] = $rec['id2'];
				} else {
					$parms['hierarchyid'] = $rec['id'];
				}
				if( isset($parms['summarypage']) ) unset($parms['summarypage']);
			  
				$rec['url'] = $module->CreatePrettyLink('cntnt01','default',$summarypage,'',$parms,'',true);
				
				if (@unserialize($rec['extra1'])) {
					$rec['extra1'] = unserialize($rec['extra1']);
				}
				//echo '<pre>';
				//print_r($manuf);
				//echo '</pre>';
				// echo $rec['url'];
				if( isset($rec['children']) ) {
					products_byhierarchy_postprocess($rec['children'],$params,$summarypage,$hierpage);
				}
			}
		}
    }
}


$nodes = array();
$parents = array(-1);
//print_r($params);
if( isset($params['parent'] ) ) {
  $parents = array((int)$params['parent']);
  unset($params['parent']);
  
 }
else if( isset($params['parents']) ) {
  $tmp = explode(',',$params['parents']);
  $tmp2 = array();
  $tmp3 = array();
  $all_hierarchy = hierarchy_ops::get_all_hierarchy_info();
  if( !is_array($all_hierarchy) || count($all_hierarchy) == 0 ) return; // nothing to do.
  foreach( $tmp as $one ) {
    $one = trim($one);
    foreach( $all_hierarchy as $onehier ) {
      if( is_numeric($one) && $onehier['id'] == $one && !in_array($one,$tmp3) ) {
	$tmp2[] = $onehier;
	$tmp3[] = $one;
	break;
      }
      else if( $onehier['name'] == $one && !in_array($onehier['id'],$tmp3) ) {
	$tmp2[] = $onehier;
	$tmp3[] = $onehier['id'];
	break;
      }
    }
  }
  if( !is_array($tmp2) || count($tmp2) == 0 ) return; // nothing to display.
  $parents = $tmp2;
  unset($params['parents']);
  products_byhierarchy_postprocess($parents,$params,$summarypage,$hierpage);
}
else if( isset($params['hierarchy']) ) {
  $tmp = explode(',',$params['hierarchy']);
  $tmp2 = array();
  foreach( $tmp as $one ) {
    $tmp2[] = "'".trim($one)."'";
  }
  $tmp2 = implode(',',$tmp2);
  $query = 'SELECT id FROM '.cms_db_prefix().'module_products_hierarchy
               WHERE name IN ('.$tmp2.')';
  $nodes = $db->GetCol($query);
  $nodes = array_unique($nodes);
  unset($params['hierarchy']);
}

if( !count($parents) ) {
  // nothing found to start with
  return;
 }

$data = array();
if( count($nodes) )
  {
  
    // this will only display the selected hierarchies (not including their children) that have products.
    $nodes = implode(',',$nodes);
    $query = 'SELECT ph.*,count(pr.id) AS count FROM '.cms_db_prefix().'module_products_hierarchy ph
                LEFT OUTER JOIN '.cms_db_prefix().'module_products_prodtohier pth
                  ON ph.id = pth.hierarchy_id
                LEFT OUTER JOIN '.cms_db_prefix().'module_products pr
                  ON pth.product_id = pr.id
               WHERE pr.status = \'published\'
                 AND ph.id IN ('.$nodes.')
               GROUP BY ph.id ORDER BY ph.hierarchy';
    $tmp = $db->GetArray($query);
    products_byhierarchy_postprocess($tmp,$params,$summarypage,$hierpage);
    $data = $tmp;
	
  }
else
  {
	
	
    foreach( $parents as $one )
      {
	$parent_id = '';
	if( is_array($one) ) {
	  $parent_id = $one['id'];
	}
	else if( is_int($one) ) {
	  $parent_id = $one;
	}

	if( $parent_id == '' ) continue;
	
	$tmp = product_utils::hierarchy_get_tree($parent_id);
	
	if( is_array($tmp) && count($tmp) )
	  {
	    products_byhierarchy_postprocess($tmp,$params,$summarypage,$hierpage);
		
	    if( is_array($one) ) {
	      $one['children'] = $tmp;
	      $data[] = $one;
	    }
	    else {
	      $data[] = $tmp;
	    }
	  }
      }
  }
  
  

$hierdata = '';
if( count($data) == 1 && empty($nodes) )
  {
    $data = $data[0];
  }
  
  
$smarty->assign('hierdata',$data);

//print_r($parents);

if( count($parents) == 1 )
  {
    $hierdata = hierarchy_ops::get_hierarchy_info($parents[0]);
    if( $hierdata )
      {
	$hierdata['canonical'] = $this->CreatePrettyLink($id,'hierarchy',$returnid,'',array('parent'=>$parents[0]),'',true);
	
	//
	$hierdata['url'] = $this->CreatePrettyLink($id,'default',$returnid,'',array('hierarchyid' => $parents[0]/*, 'parent'=>$parents[0]*/),'',true);
	
	$smarty->assign('hierarchy_item',$hierdata);
      }
  }
$smarty->assign('hierarchy_image_location',$config['uploads_url'].'/'.$this->GetName().'/hierarchy');

if (!$params['hierarchyid']) {
	$params['hierarchyid'] = $this->getHierarchyId($kalba);
}

$pars_arr = $this->getHierarchyParents($params['hierarchyid']);


$back_link = '';
if (is_array($pars_arr) && count($pars_arr) > 0) {
	$btmp = array_search($params['hierarchyid'], $pars_arr);
	
	if ($btmp !== false) {
		$btmp = $btmp-1;
		if (isset($pars_arr[$btmp])) {
			$bpar = $pars_arr[$btmp];
			$back_link = $this->CreatePrettyLink($id,'default',$returnid,'',array('hierarchyid' => $bpar),'',true);
		}
	}
}

$smarty->assign('back_link', $back_link);


$hier_name = $this->getHierarchyName($params['hierarchyid']);

$main_manuf = $this->getManufacturers(0, $manufacturers_field_name, $kalba);

$smarty->assign('main_manuf', $main_manuf);
$smarty->assign('hier_name', $hier_name);

/*
echo '<pre>';
print_r($pars_arr);
echo '</pre>';
*/

$smarty->assign('hierarchy_tree', $pars_arr);
$smarty->assign('active_hierarchy', $params['hierarchyid']);

$product_id = $this->GetCurrentProductId();

if ($product_id > 0) {
	$smarty->assign('its_a_f_product', $product_id);
} else {
	$smarty->assign('its_a_f_product', 0);
}
//
// template
//
$thetemplate = 'byhierarchy_'.$this->GetPreference(PRODUCTS_PREF_DFLTBYHIERARCHY_TEMPLATE);
if( isset($params['hierarchytemplate'] ) )
  {
    $thetemplate = 'byhierarchy_'.$params['hierarchytemplate'];
  }
 
echo $this->ProcessTemplateFromDatabase($thetemplate);
#
# EOF
#
?>
