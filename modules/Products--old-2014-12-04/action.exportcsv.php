<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Products (c) 2012 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow users to create, manage
#  and display products in a variety of ways.
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

$this->SetCurrentTab('products');
if( isset($params['cancel']) ) {
  $this->RedirectToTab($id);
}

$allcats = '';
$allfields = '';
$ops = array('exportdraft'=>1,
	     'exportcats'=>1,
	     'exportfields'=>1,
	     'exportattribs'=>1,
	     'exportdelim'=>',');

function quote($str)
{
  if( $str ) return '"'.$str.'"';
}

function to_flat_array($product,$map)
{
  $out = array();
  foreach( $map as $key ) {
    switch( $key ) {
    case 'FLAG':
      $out[] = 'P';
      break;
    case 'name':
      $out[] = quote($product->product_name);
      break;
    case 'sku':
      $out[] = quote($product->sku);
      break;
    case 'details':
      $out[] = quote($product->details);
      break;
    case 'price':
      $out[] = $product->price;
      break;
    case 'create_date':
      $out[] = $product->create_date;
      break;
    case 'modified_date':
      $out[] = $product->modified_date;
      break;
    case 'taxable':
      $out[] = $product->taxable;
      break;
    case 'status':
      $out[] = quote($product->status);
      break;
    case 'weight':
      $out[] = $product->weight;
      break;

    case 'HIER':
      $val = '';
      if( $product->hierarchy_id ) {
	$hier = hierarchy_ops::get_hierarchy_info($product->hierarchy_id);
	if( is_array($hier) && count($hier) ) {
	  $val = str_replace('|','>>',$hier['long_name']);
	}
      }
      $out[] = quote($val);
      break;

    case 'ATTRIBS':
      // Set:Attr:adj,sku--
      $val = '';
      if( isset($product->attributes_full) && count($product->attributes_full) ) {
	$sets = array();
	foreach( $product->attributes_full as $theset => $attribset ) {
	  $oneset = array('set'=>'','attr'=>'','adj'=>'','sku'=>'');
	  $oneset['set'] = quote($theset);
	  foreach( $attribset as $attr => $attribinfo ) {
	    $oneset['attr'] = quote($attr);
	    $oneset['adj'] = $attribinfo['attrib_adjustment'];
	    $oneset['sku'] = quote($attribinfo['sku']);
	    $sets[] = implode(':',array_values($oneset));
	  }
	}
	$val = implode('--',$sets);
      }
      $out[] = $val;
      break;

    default:
      if( startswith($key,'CAT:') ) {
	// categories are only 1 or 0
	$val = 0;
	if( isset($product->categories) && count($product->categories) ) {
	  $name = substr($key,4);
	  foreach( $product->categories as $one ) {
	    if( $one->name != $name ) continue;
	    if( $one->value == 1 ) {
	      $val = 1;
	      break;
	    }
	  }
	}
	$out[] = $val;
      }
      elseif( startswith($key,'FIELD:') ) {
	$val = '';
	if( isset($product->fields) && count($product->fields) ) {
	  list($t0,$t1,$name) = explode(':',$key,3);
	  if( isset($product->fields[$name]) && is_object($product->fields[$name]) ) {
	    $fld = $product->fields[$name];
	    switch( $fld->type ) {
	    case 'dimensions':
	      $val = 'l:'.$fld->value['length'].',w:'.$fld->value['width'].',h:'.$fld->value['height'];
	      break;
	    case 'subscription':
	      $val = ''; // subscription info not output,or read... for now.
	      break;
	    default:
	      $val = $fld->value;
	    }
	  }
	}
	$out[] = quote($val);
      }
    }
  }
  return $out;
}

if( isset($params['submit']) ) {

  set_time_limit(0);
  $handlers = ob_list_handlers(); 
  for ($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

  //Then force the output normally and exit so we don't get a footer
  header("Content-disposition: attachment; filename=products." . date("Y-m-d") . ".csv");
  header("Content-type: text/csv");
  flush();
  
  $ops['exportcats'] = (int)$params['exportcats'];
  $ops['exportdraft'] = (int)$params['exportdraft'];
  $ops['exportfields'] = (int)$params['exportfields'];
  $ops['exportattribs'] = (int)$params['exportattribs'];
  $ops['exportdelim'] = trim($params['exportdelim']);
  $this->SetPreference('exportoptions',serialize($ops));
  
  // now do the export.
  if( $ops['exportcats'] ) {
    $allcats = product_utils::get_categories();
    $map = array('FLAG','name','sku','details','price','create_date','modified_date','taxable','status','weight','HIER');
    if( is_array($allcats) && count($allcats) ) {
      foreach( $allcats as $one ) {
	$map[] = 'CAT:'.$one->name;
      }
    }
  }

  if( $ops['exportfields'] ) {
    $allfields = product_utils::get_fielddefs(TRUE,TRUE);
    if( is_array($allfields) && count($allfields) ) {
      foreach( $allfields as $one ) {
	$map[] = 'FIELD:'.$one->type.':'.$one->name;
      }
    }
  }

  if( $ops['exportattribs'] ) {
    $map[] = 'ATTRIBS';
  }

  $output = '';
  {
    $header = $map;
    foreach( $header as &$one ) {
      $one = '#'.$one;
    }
    $output .= implode($ops['exportdelim'],$header)."\n";
  }
  echo $output; flush();

  // now get the products...
  $query = new products_query();
  $query['pagelimit'] = 1000000;
  if( $ops['exportdraft'] ) {
    $query['status'] = '!disabled';
  }
  $results = new products_resultset($query);

  while( !$results->EOF ) {
    $product = $results->get_product(); // really don't need this for export, cuz links are irrelevant
    $tmp = to_flat_array($product,$map);
    $output = implode($ops['exportdelim'],$tmp)."\n";
    $results->MoveNext();
    echo $output; flush();
  }

  audit('',$this->GetName(),'Exported product data to csv');
  exit();
}


$tmp = $this->GetPreference('exportoptions');
if( $tmp ) $ops = unserialize($tmp);

$smarty->assign('options',$ops);
$smarty->assign('formstart',$this->CGCreateFormStart($id,'exportcsv'));
$smarty->assign('formend',$this->CreateFormEnd());
echo $this->ProcessTemplate('exportcsv.tpl');

#
# EOF
#
?>