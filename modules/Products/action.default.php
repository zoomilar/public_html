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
if (!isset($gCms)) exit;

$test = GetModuleParameters('cntnt01');
$params = array_merge($test, $params);

$kalba = $smarty->get_template_vars('kalba');

$path = $gCms->config['root_path'].'/languages/'.$kalba.'.conf';
if(is_file($path)) {
	$smarty->config_load($path);
	$langfile = $smarty->get_config_vars();
}


$kalbos = $this->GetPreference('kalbos', 'lt');
$main_kalba = explode(',', $kalbos);
$main_kalba = $main_kalba[0];

//gamintojai!!!
global $manufacturers_field_name, $filter_params;
$manufacturers_field_name = 'gamintojai';

if ($_SESSION['hier_url']) {
	
	$parmsx['hierarchyid'] = $_SESSION['hier_url'][0];
	$summarypagex = $_SESSION['hier_url'][1];
	
	$back_url = $this->CreatePrettyLink('cntnt01','default',$summarypagex,'',$parmsx,'',true);
	
} else {
	$back_url = '#';
}



$prods = array();
if (isset($params['filter1']) && !empty($params['filter1'])) {
	
	$mnf = $this->getManufacturers(0, $manufacturers_field_name, $kalba);
	
	$manufacturer_title = $mnf[$params['filter1']];
	$smarty->assign('manufacturer_title', $manufacturer_title);
	
	$hierdataz = hierarchy_ops::get_hierarchy_info($params['hierarchyid']);
	
	if ($hierdataz['extra2'] != 1) {
		$prods = $this->getProdsByMf($params['filter1'], $manufacturers_field_name, $kalba, $params['hierarchyid']);
		$smarty->assign('show_both_titles', '1');
	} else {
		$prods = $this->getProdsByMf($params['filter1'], $manufacturers_field_name, $kalba);
	}
	$params['productlist'] = $prods;
	
}

if (isset($params['session_filter']) && $params['session_filter'] == 1) {
	$filter_params = $_SESSION['filter_params'];
} else {
	$_SESSION['filter_params'] = $filter_params;
}
//

//$params['productlist']
//print_r($params);

$no_simple_view = false;
if (isset($params['recently_viewed']) && $params['recently_viewed'] == 1) {
	$no_simple_view = true;
	$params['productlist'] = $this->recently_viewed('get_all');
	//print_r($params['productlist']);
}



if( $this->GetPreference('summary_newdefault',0) ) {
  include_once(dirname(__FILE__).'/action.default2.php');
  return;
}
$fieldefs = '';
{
  $tmp = $this->GetFieldDefs();
  if( is_array($tmp) )
    {
      $fielddefs = array();
      for( $i = 0; $i < count($tmp); $i++ )
	{
	  $obj = $tmp[$i];
	  $fielddefs[$obj->name] = $obj;
	}
    }
}



$query = '';
$query2 = '';
$count = '';
$page = '';
$startelement = '';
$limit = 99999;
$productlist = '';
$sorttype = '';
$countjoins = array();
$joins = array();
$sortfield = 1;
unset($params['assign']);
$inline = false;
$default_detailpage = $this->GetPreference('detailpage','');
$curency = $this->GetPreference('curency_field_'.$kalba);

$detailpage = $default_detailpage;

//echo $params['detailpage'];
if (isset($params['detailpage']))
  {
    $detailpage = trim($params['detailpage']);
  }
if( !empty($detailpage) && $detailpage != -1 )
  {
    $manager = $gCms->GetHierarchyManager();
    $node = $manager->sureGetNodeByAlias($detailpage);
    if (isset($node))
      {
	$content = $node->GetContent();	
	if (isset($content))
	  {
	    $detailpage = $content->Id();
	  }
      }
    else
      {
	$node = $manager->sureGetNodeById($detailpage);
	if (!isset($node))
	  {
	    $detailpage = '';
	  }
      }
    if( $detailpage != '' )
      {
	$params['cd_origpage'] = $returnid;
      }
  }

$thetemplate = 'summary_'.$this->GetPreference(PRODUCTS_PREF_DFLTSUMMARY_TEMPLATE);
if( isset($params['summarytemplate'] ) )
  {
    $thetemplate = 'summary_'.$params['summarytemplate'];
  }


if( isset($params['productlist']) )
  {
    $productlist = $params['productlist'];
    unset($params['productlist']);
    if( !is_array($productlist) )
      {
	$productlist = explode(',',$productlist);
      }
  }
 
if( !(is_array($productlist) && count($productlist) > 0) && $no_simple_view === false)
  {
  
    // we don't have an explicit product list, so gotta build a query
    // from other parameters
	
	if (isset($_COOKIE['order_prods']) && !empty($_COOKIE['order_prods'])) {
		$params['sortby'] = $_COOKIE['order_prods'];
	}
	//echo $params['sortby'];
    $sortorder = $this->GetPreference('sortorder','asc');
	$params['sortorder'] = 'ASC';
    if( isset( $params['sortorder'] ) )
      {
	switch( $params['sortorder'] )
	  {
	  case 'asc':
	  case 'desc':
	    $sortorder = $params['sortorder'];
	  }
      }
    
	$use_hier_ordering = false;
    $sortby = $this->GetPreference('sortby','product_name');
	
	if (!isset($params['sortby'])) {
		$params['sortby'] = $sortby;
	}
	
    if( isset( $params['sortby'] ) )
      {
	$tmp = strtolower(trim($params['sortby']));
	switch( $tmp )
	  {
	  case 'id':
	    $sortby = 'id';
	    break;
	
	  case 'product_name':
	    $sortby = 'product_name';
	    break;
	  case 'price':
	    $sortby = 'price';
	    break;
	  case 'created':
	    $sortby = 'create_date';
	    break;
	  case 'modified':
	    $sortby = 'modified_date';
	    break;
	  case 'status':
	    $sortby = 'status';
	    break;
	  case 'weight':
	    $sortby = 'weight';
	    break;
	  case 'order_hierarchy':
		$use_hier_ordering = true; // if posible
		break;
	  case 'random':
	    $sortby = 'RAND()';
	    $sortorder = '';
	    break;
	  default:
	    if( startswith($tmp,'f:') )
	      {
			$fieldname = substr($tmp,strlen('f:'));
			if( isset($fielddefs[$fieldname]) )
			  {
				$fieldid = $fielddefs[$fieldname]->id;
				$as = 'FV'.$sortfield++;
				$joins[] = cms_db_prefix()."module_products_fieldvals {$as} ON c.id = {$as}.product_id AND $as.fielddef_id = ".$db->qstr($fieldid);
				$sortby = "{$as}.value";
			  }
	      } else if (startswith($tmp,'by_')) {
			$fieldname = substr($tmp,strlen('by_'));
			$ordering = $this->getProductsOrderedBy($fieldname, $sortorder, $kalba);
			if (is_array($ordering) && count($ordering) > 0) {
				$sortorder = '';
				
				$sortby = 'FIELD(c.id,'.implode(',', $ordering).')';
			}
		  }
	    break;
	  }
      }
    if( $sortby == 'random' )
      {
	$sortby = 'RAND()';
	$sortorder = '';
      }

    if( isset($params['sorttype']) )
      {
	$tmp = trim($params['sorttype']);
	$tmp = strtoupper($tmp);
	switch( $tmp )
	  {
	  case 'STRING':
	    $sorttype = '';
	    break;
	  case 'SIGNED':
	  case 'UNSIGNED':
	    $sorttype = $tmp;
	  }
      }
    $limit = $this->GetPreference('summary_pagelimit',10000);
    if( isset($params['pagelimit']) )
      {
	$limit = (int)$params['pagelimit'];
      }
    $limit = max($limit,1);
    $limit = min($limit,10000);
	
    $page = 1;
    if( isset($params['page']) )
      {
	$page = (int)$params['page'];
	if( $page < 1 ) $page = 1;
      }
    $startelement = ($page-1)*$limit;

    $category = '';
    $inputcat = '';
    if( isset( $params['category'] ) )
      {
	$category = trim($params['category']);
	$category = cms_html_entity_decode($category);
      }
    else if (isset($params['categoryid']))
      {
	$categoryid = $params['categoryid'];
      }

    $excludecat = '';
    if (isset($params['excludecat']) )
      {
	$excludecat = trim($params['excludecat']);
	$excludecat = cms_html_entity_decode($excludecat);
      }
	
    $hierarchy = '';
    if( isset( $params['hierarchy'] ) )
      {
	$hierarchy = trim($params['hierarchy']);
      }
    $hierarchyid = -100;
    if( isset($params['hierarchyid']) )
      {
	$hierarchyid = (int)$params['hierarchyid'];
      }

    $fieldid = -100;
    if( isset( $params['fieldid']) )
      {
	$fieldid = (int)$params['fieldid'];
      }
    $fieldval = '';
    if( isset( $params['fieldval'] ) )
      {
	$fieldval = trim($params['fieldval']);
      }
	
	$exclude_prod = 0;
	if ($params['exclude_prod'] > 0) {
		$exclude_prod = intval($params['exclude_prod']);
	}
	
    //
    // Build the queries
    //
    $entryarray = array();
    $paramarray = array();
    $where = array();
    $query = "SELECT c.* FROM ".cms_db_prefix()."module_products c";
    $query2 = "SELECT count(*) as count FROM ".cms_db_prefix()."module_products c";
    $where[] = 'c.status = \'published\'';
    if ( isset($categoryid) && $categoryid != '')
      {
	$str = " INNER JOIN ".cms_db_prefix()."module_products_product_categories cc ON cc.product_id = c.id";
	$query .= $str;
	$query2 .= $str;
	$where[] = 'cc.category_id = ?';
	$paramarray[] = $categoryid;
      }
    else if( isset($category) && $category != '' )
      {
	$str = " INNER JOIN ".cms_db_prefix()."module_products_product_categories cc ON cc.product_id = c.id";
	$query .= $str;
	$query2 .= $str;
	$str = " INNER JOIN ".cms_db_prefix()."module_products_categories cs ON cs.id = cc.category_id";
	$query .= $str;
	$query2 .= $str;

	$arr1 = explode(',',$category);
	$arr2 = array();
	foreach( $arr1 as $xx )
	  {
	    $arr2[] = $db->qstr($xx);
	  }
	$txt = implode(',',$arr2);
	$where[] = 'cs.name IN ('.$txt.')';
      }
	
    if( isset($excludecat) && $excludecat != '' )
      {
	$arr1 = explode(',',$excludecat);
	$arr2 = array();
	foreach( $arr1 as $xx )
	  {
	    $arr2[] = $db->qstr($xx);
	  }
	$txt = implode(',',$arr2);
	$subquery = 'SELECT pc.product_id FROM '.cms_db_prefix().'module_products_product_categories pc
                     LEFT JOIN '.cms_db_prefix().'module_products_categories cc
                     ON pc.category_id = cc.id
                     WHERE cc.name IN ('.$txt.')';
	$where[] = 'c.id NOT IN ('.$subquery.')';
      }

    if ( isset($hierarchy) && $hierarchy != '' )
      {
		
		if ($use_hier_ordering == true) {
			$sortby = 'ordtbl.order_id';
			$sortorder = 'ASC';
		}
		
		$str = " INNER JOIN ".cms_db_prefix()."module_products_prodtohier ph ON ph.product_id = c.id";
		$query .= $str;
		$query2 .= $str;

		$str = " INNER JOIN ".cms_db_prefix()."module_products_hierarchy h ON ph.hierarchy_id = h.id";
		$query .= $str;
		$query2 .= $str;
		
		$str = " LEFT JOIN ".cms_db_prefix()."module_products_hierordering ordtbl ON (ordtbl.hier_id = h.id AND ordtbl.product_id = c.id)";
		$query .= $str;
		$query2 .= $str;
		
		

		$tmp2 = array();
		$tmp = explode(',',$hierarchy);
		foreach( $tmp as $one )
		  {
			if( strstr($one,'*') !== FALSE )
			  {
			$tmp2[] = "upper(h.long_name) LIKE upper(?)";
			  }
			else
			  {
			$tmp2[] = "upper(h.name) = upper(?)";
			  }

			$one = cms_html_entity_decode($one);
			$one = trim(str_replace('*','%',str_replace('"','_',$one)));
			$paramarray[] = $one;
		  }
		$str = '(' . implode(' OR ',$tmp2) . ')';
		$where[] = $str;
      }
    else if( $hierarchyid > -100 )
      {
		if ($use_hier_ordering == true) {
			$sortby = 'ordtbl.order_id';
			$sortorder = 'ASC';
		}
		
		$arr_h = $this->getChildrenHier($hierarchyid);
		
		$str = " INNER JOIN ".cms_db_prefix()."module_products_prodtohier ph ON ph.product_id = c.id";
		$query .= $str;
		$query2 .= $str;
		
		
		if (count($arr_h) > 1) {
			$where[] = "ph.hierarchy_id IN (".implode(',', $arr_h).")";
		} else {
			$where[] = "ph.hierarchy_id = ?";
			$paramarray[] = $hierarchyid;
		}
		
		$str = " LEFT JOIN ".cms_db_prefix()."module_products_hierordering ordtbl ON (ordtbl.hier_id = ".$hierarchyid." AND ordtbl.product_id = c.id) ";
		$query .= $str;
		$query2 .= $str;
		
      }

    if( isset($fieldid) && $fieldid > 0 && isset($fieldval) && !empty($fieldval) )
      {
	// handle gathering products that have a certain field id.
	if( $fieldval == '::null::' )
	  {
	    // handle a case when a field is not set for a product.
	    $countjoins[] = cms_db_prefix().'module_products_fieldvals FVA ON c.id = FVA.product_id AND FVA.fielddef_id = ?';
	    $joins[] = cms_db_prefix().'module_products_fieldvals FVA ON c.id = FVA.product_id AND FVA.fielddef_id = ?';
	    $where[] = '(FVA.value IS NULL)';
	    array_unshift($paramarray,$fieldid);
	    //$paramarray[] = $fieldid;
	  }
	if( $fieldval == '::notnull::' )
	  {
	    // handle a case when a field is not set for a product.
	    $countjoins[] = cms_db_prefix().'module_products_fieldvals FVA ON c.id = FVA.product_id AND FVA.fielddef_id = ?';
	    $joins[] = cms_db_prefix().'module_products_fieldvals FVA ON c.id = FVA.product_id AND FVA.fielddef_id = ?';
	    $where[] = '(FVA.value != \'\')';
	    array_unshift($paramarray,$fieldid);
	  }
	else
	  {
	    // limit results to all of the items that have this field value.
	    $countjoins[] = cms_db_prefix().'module_products_fieldvals FVA ON c.id = FVA.product_id AND FVA.fielddef_id = ?';
	    $joins[] = cms_db_prefix().'module_products_fieldvals FVA ON c.id = FVA.product_id AND FVA.fielddef_id = ?';
	    $where[] = 'FVA.value = ?';
	    array_unshift($paramarray,$fieldid);
	    //$paramarray[] = $fieldid;
	    $paramarray[] = $fieldval;
	  }
      }
	if ($exclude_prod > 0) {
		$where[] = "c.id != ?";
		$paramarray[] = $exclude_prod;
	}
	if (isset($filter_params) && is_array($filter_params) && count($filter_params) > 0) {
		
		$empty_fields = $this->GetPreference('empty_fields', '');
		$empty_fields = explode(',', $empty_fields);
		foreach ($filter_params as $key => $val) {
			
			$val_tmp = array();
			if (!is_array($val)) {
				$val_tmp[] = $val;
			} else {
				$val_tmp = $val;
			}
			
			if (is_array($val_tmp) && count($val_tmp) > 0) {
				$where_tmp = array();
				foreach ($val_tmp as $kt => $vt) {
					
					if (!empty($vt) && !in_array($vt, $empty_fields)) {
						
						$filt_name = substr($key,strlen('filt_'));
						
						if (isset($fielddefs[$filt_name])) {
							
							$joins[] = cms_db_prefix().'module_products_fieldvals FLT'.$key.$kt.' ON FLT'.$key.$kt.'.product_id = c.id';
							$countjoins[] = cms_db_prefix().'module_products_fieldvals FLT'.$key.$kt.' ON FLT'.$key.$kt.'.product_id = c.id';
							
							
							$orig_search = $vt;
							if ($main_kalba != $kalba && isset($fielddefs[$filt_name]->optionslng) && count($fielddefs[$filt_name]->optionslng) > 0) {
								foreach ($fielddefs[$filt_name]->optionslng as $val_lng) {
									if ($val_lng[$kalba] == $vt) {
										$orig_search = $val_lng[$main_kalba];
										break;
									}
								}
							}
							
							$where_tmp[] = 'FLT'.$key.$kt.'.value_'.$fielddefs[$filt_name]->id.' = ? OR FLT'.$key.$kt.'.value_'.$fielddefs[$filt_name]->id.' LIKE \'%"'.$orig_search.'"%\'';
							
							$paramarray[] = $orig_search;
						}
					}
				}
				
				if (count($where_tmp) > 0) {
					
					$where[] = ' ('.implode(' OR ', $where_tmp).') ';
				}
			}
			
			/*if (is_array($val)) {
				if (count($val) > 0) {
					foreach ($val as $val) {
						$joins[] = cms_db_prefix().'module_products_fieldvals FLT'.$key.' ON FLT'.$key.'.product_id = c.id';
						$countjoins[] = cms_db_prefix().'module_products_fieldvals FLT'.$key.' ON FLT'.$key.'.product_id = c.id';
						
						$filt_name = substr($key,strlen('filt_'));
						
						$where[] = 'FLT'.$key.'.value_'.$fielddefs[$filt_name]->id.' = ?';
						
						$paramarray[] = $val;
					}
				}
			} else {
				if (!in_array($val, $empty_fields)) {
					$joins[] = cms_db_prefix().'module_products_fieldvals FLT'.$key.' ON FLT'.$key.'.product_id = c.id';
					$countjoins[] = cms_db_prefix().'module_products_fieldvals FLT'.$key.' ON FLT'.$key.'.product_id = c.id';
					
					$filt_name = substr($key,strlen('filt_'));
					
					$where[] = 'FLT'.$key.'.value_'.$fielddefs[$filt_name]->id.' = ?';
					
					$paramarray[] = $val;
				}
			}*/
		}
	}
	
    if( count($joins) )
      {
	$query .= ' LEFT JOIN '.implode(' LEFT JOIN ',$joins);
      }
    if( count($countjoins) )
      {
	$query2 .= ' LEFT JOIN '.implode(' LEFT JOIN ',$countjoins);
      }
    $query = $query . ' WHERE ' . implode(' AND ',$where );
    $query2 = $query2 . ' WHERE ' . implode(' AND ',$where );
    if( $sorttype == '' )
      {
	$query .= " ORDER BY ".$sortby." ".$sortorder;
      }
    else
      {
	$query .= ' ORDER BY CAST('.$sortby.' AS '.$sorttype.') '.$sortorder;
      }
	  
	 // echo $query;
	//
	
	
	
    // Execute the Queries
    $count = $db->GetOne($query2,$paramarray);
	//echo $query2;
	
	// nesupratau kodel cia apskritai yra returnas???
    //if( $count == 0 ) return;
	
	//print_r($params);
    $dbresult = $db->SelectLimit($query, $limit, $startelement, $paramarray);
	//echo $db->sql;
    if( !$dbresult ) 
      {
	  
	echo $db->sql.'<br/>'; die( $db->ErrorMsg() );
      }
	  
	 // echo $db->sql.'<br/>';
	
  } // end product list not specified.
else
  {
  
    // a product id list was specified
    // which means we display only the products specified.
    $count = count($productlist);
    $query = 'SELECT * FROM '.cms_db_prefix().'module_products WHERE id IN (';
    
    // clean up the productlist, just in case
    $productlist = array_unique($productlist);
    for( $i = 0; $i < count($productlist); $i++ )
      {
	$productlist[$i] = (int)$productlist[$i];
      }
    $query .= implode(',',$productlist).') ORDER BY FIELD(id,'.implode(',',$productlist).')';
    
    $dbresult = $db->SelectLimit($query,1000,0);
	//echo $db->sql;
  }



// Determine the number of pages
$npages = intval($count / $limit);
if( $count % $limit != 0 ) $npages++;

// build the object list
$config = cmsms()->GetConfig();
while ($dbresult && ($row = $dbresult->FetchRow()))
{
  if( $detailpage == '' || $detailpage == -1 ) $detailpage = $returnid;

  $filedir = cms_join_path($config['uploads_path'],$this->GetName(),'product_'.$row['id']);
  $onerow = cge_array::to_object($row);
  $pretty_url = '';
  
  if( product_utils::can_do_pretty('detail',$params) ) {
	
    $prettyurl = product_ops::pretty_url($row['id'],$detailpage, $kalba);
	//echo $prettyurl;
	
  }
  
  
  $parms = $params;
  
  if (!$parms['hierarchyid']) {
	$hier_info = product_ops::get_product_hierarchy_path($row['id']);
	$parms['hierarchyid'] = array_pop($hier_info);
  }
  
  $parms['productid'] = $row['id'];
  $onerow->detail_url = $this->CreateLink($id,'details',$detailpage,'',$parms,
					  '',true,$inline,'',false,$prettyurl);
					  /*echo '<pre>';
					  print_r($parms);
					  echo '</pre>';*/
  $onerow->product_name_link = $this->CreateLink($id, 'details', $detailpage, $row['product_name'], $parms);
  $onerow->file_location = $config['uploads_url'].'/'.$this->GetName().'/product_'.$row['id'];
  $onerow->details = $row['details'];

  $onerow->hierarchy_id = product_ops::get_product_hierarchy_id($row['id']);
  $onerow->breadcrumb = product_ops::create_hierarchy_breadcrumb($id,$row['id'],$returnid);

  // add custom fields
  $fielddefs = $this->GetFieldDefsForProduct($row['id'],true,true);
  $fields = array();
  foreach( $fielddefs as $tonedef )
    {
      $onedef = clone $tonedef;
      if( $onedef->type == 'image' )
		{
			if (!empty($onedef->value)) {
				$onedef->value = unserialize($onedef->value);
			} else {
				$onedef->value = '';
			}
			//print_r($onedef->value);
		  /*if( isset($onedef->value) && file_exists(cms_join_path($filedir,'thumb_'.$onedef->value)) )
			{
			  $onedef->thumbnail = 'thumb_'.$onedef->value;
			}

		  if( isset($onedef->value) && file_exists(cms_join_path($filedir,'preview_'.$onedef->value)) )
			{
			  $onedef->preview = 'preview_'.$onedef->value;
			}*/
		}
		if ($onedef->type == 'dropdown') {
			
			$ccx = 1;
			$key_x = 0;
			foreach ($onedef->options as $kk => $vv) {
				if ($kk == $onedef->value) {
					$key_x = $ccx;
					break;
				} else {
					$ccx++;
				}
			}
			
			//$key_x = array_search($onedef->value, $onedef->options);
			
			if ($key_x > 0) {
				//echo $key_x.'<br/>';
				//print_r($onedef->optionslng);
				$onedef->value = $onedef->optionslng[$key_x][$kalba];
			}
			//echo $onedef->value.'<br/>';
			/*
			echo '<pre>';
			print_r($onedef);
			echo '</pre>';
			*/
			
			
			//$onedef->options[$onedef->value];
		}
      $fields[$onedef->name] = $onedef;
    }
  $onerow->fields = $fields;

  // add categories
  $catarray = $this->GetCategoriesForProduct($parms['productid'],true,true);
  if( count($catarray) )
    {
      $catnamearray = array();
      foreach( $catarray as $onecat )
	{
	  $catnamearray[] = $onecat->name;
	}
      $onerow->categories = $catarray;
      $onerow->categorynames = $catnamearray;
    }

  // add attributes ... deprecated.
  $tmp = product_ops::get_product_attributes_full($parms['productid']);
  if( is_array($tmp) )
    {
      $onerow->attributes = $tmp;
      $onerow->attribs_full = $tmp;
    }

  $entryarray[] = $onerow;
}

//
// Give everything to smarty
//

//$_SESSION['hier_url'] = $_SERVER['REQUEST_URI'];


$turnyrai = array();
$turnyrai_past = array();

$a=0;
foreach($entryarray as $k=>$tmp){
	$data = explode("-", $tmp->fields['data']->value);
	$menuo = $data[1]*1;
	
	if ($data[0] == date("Y") && strtotime($tmp->fields['data']->value) < strtotime(date("Y-m-d", time())))
		$turnyrai_past[$menuo][] = $tmp;
	else	
		$turnyrai[$menuo][] = $tmp;
}




$smarty->assign('turnyrai', $turnyrai);
$smarty->assign('turnyrai_past', $turnyrai_past);

$smarty->assign('items', $entryarray);
$smarty->assign('totalcount', $count);
$smarty->assign('itemcount', count($entryarray));
$smarty->assign('pagetext', $this->Lang('page'));
$smarty->assign('oftext', $this->Lang('of'));
$smarty->assign('pagecount',$npages);
$smarty->assign('curpage',$page);
if( $page == 1 )
  {
    $smarty->assign('firstlink','');
    $smarty->assign('prevlink','');
  }
else
  {
    $parms = $params;
    $parms['page'] = 1;
	if (isset($filter_params) && is_array($filter_params) && count($filter_params) > 0) {
		$parms['filter_params'] = $filter_params;
	}
	
	$smarty->assign('firstlink', $this->CreatePrettyLink($id,'default',$returnid, $this->Lang('firstpage'), $parms));
	$smarty->assign('firstpage_url',$this->CreatePrettyLink($id,'default',$returnid, '', $parms, '', true));
	
	
    $parms['page'] = $page - 1;
    $smarty->assign('prevlink', $this->CreatePrettyLink($id,'default',$returnid, $langfile['lastlink'], $parms));
	$smarty->assign('prevpage_url',$this->CreatePrettyLink($id,'default',$returnid, '', $parms, '',true));
  }
if( $page == $npages )
  {
    $smarty->assign('lastlink','');
    $smarty->assign('nextlink','');
  }
else
  {
    $parms = $params;
    $parms['page'] = $npages;
	if (isset($filter_params) && is_array($filter_params) && count($filter_params) > 0) {
		$parms['filter_params'] = $filter_params;
	}
	
	$smarty->assign('lastlink', $this->CreatePrettyLink($id,'default',$returnid, $langfile['lastlink'], $parms));
	$smarty->assign('lastpage_url',$this->CreatePrettyLink($id,'default',$returnid, '', $parms, '',true));
	
	
	
   
	
    $parms['page'] = $page + 1;
	
	
    $smarty->assign('nextlink', $this->CreatePrettyLink($id,'default',$returnid, $langfile['nextlink'], $parms));
	
	
    $smarty->assign('nextpage_url',$this->CreatePrettyLink($id,'default',$returnid, '', $parms, '',true));
  }
if ($npages > 1) {
	$pages_array = array();
	
	$format = array(
		1 => true,
		2 => true,
		3 => true,
		4 => true,
		5 => true
	);
	
	if ($npages > 5) {
		if ($page == 1 || 
			$page == 2 || 
			$page == ($npages) || 
			$page == ($npages-1)) {
			// pirmi ir paskutiniai
			
			$format = array(
				1 => true,
				2 => true,
				3 => false,
				($npages-1) => true,
				$npages => true
			);
		} else {
			// pirmas tarpas vidurys tarpas paskutiis
			
			$format = array(
				1 => true,
				2 => false,
				$page => true,
				($npages-1) => false,
				$npages => true
			);
		}
	}
	
	for($i = 1; $i <= $npages; $i++) {
		if (isset($format[$i])) {
			if ($format[$i] === true) {
				$parms = $params;
				$parms['page'] = $i;////
				//$pages_array[$i]['link'] = $this->CreateLink($id,'default',$returnid, $i, $parms,$warn_message='', $onlyhref=false, $inline=false, $addtext='');
				if (isset($filter_params) && is_array($filter_params) && count($filter_params) > 0) {
					$parms['filter_params'] = $filter_params;
				}
				$pages_array[$i]['link'] = $this->CreatePrettyLink($id,'default',$returnid,$i,$parms,'',false);
				$pages_array[$i]['url'] = $this->CreatePrettyLink($id,'default',$returnid,'',$parms,'',true);
				$pages_array[$i]['class'] = '';
				if ($i == $page) {
					$pages_array[$i]['class'] = 'selected';
				}
			} else {
				$pages_array[$i]['link'] = '...';
				$pages_array[$i]['url'] = '';
				$pages_array[$i]['class'] = '';
			}
		}
	}
	$smarty->assign('pages_array', $pages_array);
}
  
if( isset( $params['selectcategory'] ) )
  {
	$query = "SELECT id, name FROM ".cms_db_prefix()."module_products_categories ORDER BY name ASC";
	$dbresult = $db->Execute($query);
	$catarray = array('(Select One)' => '');
	while ($dbresult && $row = $dbresult->FetchRow())
	  {
		$catarray[$row['name']] = $row['id'];
	  }
	$smarty->assign('catformstart', $this->CreateFrontendFormStart($id, $returnid));
	$smarty->assign('catdropdown', $this->CreateInputDropdown($id, 'categoryid', $catarray, -1, $categoryid, ''));
	$smarty->assign('catbutton', $this->CreateInputSubmit($id, 'inputsubmit', 'Submit'));
	$smarty->assign('catformend', $this->CreateFormEnd());
  }

$smarty->assign('currency_symbol',product_ops::get_currency_symbol());
$smarty->assign('weight_units',product_ops::get_weight_units());
$smarty->assign('curency',$curency);

$smarty->assign('show_hier_page', 0);
if (isset($params['hierarchyid']) && $params['hierarchyid'] > 0) {
	//$params['hierarchyid']
	$hierdataz = hierarchy_ops::get_hierarchy_info($params['hierarchyid']);
	
	if ($hierdataz['show_hier_page'] == 1) {
		$smarty->assign('show_hier_page', 1);
		$smarty->assign('hier_page_info', $hierdataz);
	}
}


//
// Process the template
//
echo $this->ProcessTemplateFromDatabase($thetemplate);

#
# EOF
#
?>
