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

$kalba = $smarty->get_template_vars('kalba');

$thetemplate = 'detail_'.$this->GetPreference(PRODUCTS_PREF_DFLTDETAIL_TEMPLATE);
if( isset($params['detailtemplate'] ) )
  {
    $thetemplate = 'detail_'.$params['detailtemplate'];
  }

$entryarray = array();

global $gCms;
$config = $gCms->GetConfig();

//$prev_next = $this->getPrevNext($params, $kalba);// jei norite sita atkomentuoti, reikia pataisyti slykstu buga, kuris pataisytas ant visu naujasniu projektu, kitaip nerodys drafto.

//$smarty->assign('prev_next', $prev_next);

$query = "SELECT A.*, B.hierarchy_id FROM ".cms_db_prefix()."module_products A
           LEFT JOIN ".cms_db_prefix().'module_products_prodtohier B
             ON A.id = B.product_id
           WHERE A.status = ?';
$parms = array('published');
if( isset($params['productid']) )
  {
    $query .= ' AND A.id = ?';
    $parms[] = $params['productid'];
  }
else if( isset($params['alias']) )
  {
    $query .= ' AND A.alias = ?';
    $parms[] = $params['alias'];
  }
else
  {
    // should generate an error here.  todo.
    return;
  }

$row = $db->GetRow($query,$parms);

if ( $row )
  {
  
	$this->recently_viewed('add',$row['id']);
	
	
    $filedir = cms_join_path($config['uploads_path'],$this->GetName(),'product_'.$row['id']);
    $onerow = cge_array::to_object($row);
    $onerow->file_location = $config['uploads_url'].'/'.$this->GetName().'/product_'.$row['id'];
    $onerow->field_file_location = $config['uploads_url'].'/'.$this->GetName().'/fielddef';

    // add canonical entry.
    $onerow->canonical = product_ops::pretty_url($row['id']);
    $parms = array('productid'=>$params['productid']);
    $onerow->detail_url = $this->CreateLink($id,'details',$returnid,'',$parms,
					    '',true,false,'',false,$onerow->canonical);

    // add custom fields
    $fielddefs = $this->GetFieldDefsForProduct($row['id']);
	
	/*
	echo '<pre>';
	print_r($fielddefs);
	echo '</pre>';
	*/
    $fields = array();
    foreach( $fielddefs as $onedef ) {
		//echo '<pre>';
		//print_r($onedef);
		if( $onedef->type == 'image' ) {
			$onedef->value = unserialize($onedef->value);
			/*if( isset($onedef->value) && file_exists(cms_join_path($filedir,'thumb_'.$onedef->value)) ) {
				$onedef->thumbnail = 'thumb_'.$onedef->value;
			}
			if( isset($onedef->value) && file_exists(cms_join_path($filedir,'preview_'.$onedef->value)) ) {
				$onedef->preview = 'preview_'.$onedef->value;
			}*/
		}
		$fields[$onedef->name] = $onedef;
    }
    if( count($fields) )
      {
	$onerow->fields = $fields;
      }

    // hierarchy information
    $onerow->hierarchy_id = product_ops::get_product_hierarchy_id($row['id']);
	$_SESSION['hier_url'] = array($onerow->hierarchy_id, $returnid);
    $onerow->breadcrumb = product_ops::create_hierarchy_breadcrumb($id,$row['id'],$returnid);
	
	$onerow->filter_fields = $this->GetHierFields($onerow->hierarchy_id, 1);
	
    // add attributes... this is deprecated.
    $tmp = $this->GetProductAttributeDataComplete($row['id']);
    if( is_array($tmp) )
      {
	$onerow->attributes = $tmp;
      }

    $tmp = product_ops::get_product_attributes_full($row['id']);
    if( is_array($tmp) )
      {
	$onerow->attribs_full = $tmp;
      }

    // add categories
    $catarray = $this->GetCategoriesForProduct($row['id'],true,true);
    $catnamearray = array();
    if( count($catarray) )
      {
	$catnamesarray = array();
	foreach( $catarray as $onecat )
	  {
	    $catnamearray[] = $onecat->name;
	  }
	$onerow->categories = $catarray;
	$onerow->categorynames = $catnamearray;
      }
    
	$pagal_ka_luginam1 = $this->getFieldsByGroup('Įvertinimai');
	
	$pagal_ka_luginam2 = $this->getFieldsByGroup('Parametrai');
	
	$pagal_ka_luginam = array_merge($pagal_ka_luginam1, $pagal_ka_luginam2);
	
    $smarty->assign('pagal_ka_luginam',$pagal_ka_luginam);
	
	
    $smarty->assign_by_ref('entry', $onerow);
    $smarty->assign('currency_symbol',product_ops::get_currency_symbol());
    $smarty->assign('weight_units',product_ops::get_weight_units());
    $smarty->assign('categorytext', implode(", ", $catnamearray));

	


		$fbgal = $onerow->fields['facebookgalerija']->value;
		$smarty->assign('fbg', $fbgal);
		
		if ($fbgal && $_GET['a'] == 3){
		
			$fbconfig['appid' ]     = "1381485728778623";
			$fbconfig['secret']     = "be5548e0dfd9df88656d3e6cefa84144";
			$fbconfig['baseurl']    = "http://www.golfclub.lt"; 

			//
			if (isset($_GET['request_ids'])){
				//user comes from invitation
				//track them if you need
			}
			
			$user            =   null; //facebook user uid
			try{
				include_once "lib/fb/facebook.php";
			}
			catch(Exception $o){
				error_log($o);
			}
			// Create our Application instance.
			$facebook = new Facebook(array(
			  'appId'  => $fbconfig['appid'],
			  'secret' => $fbconfig['secret'],
			  'cookie' => true,
			));

			
			
			//if ($_GET['a']==2){
				$fb_alb = array();
				if (strpos($fbgal, ",")){
					$tmp = explode(",", $fbgal);
					$a=0;
					foreach($tmp as $val){
						$photo = $facebook->api("/{$val}");
						$fb_alb[$a]['big'] = $photo['images']['0']['source'];
						$fb_alb[$a]['small'] = $photo['images']['3']['source'];
						$a++;
					}
				}else{
					$albumjson = $facebook->api("/{$fbgal}?fields=photos");
					foreach ($albumjson['photos']['data'] as $k=>$v){
						$fb_alb[$k]['big'] = $v['images']['0']['source'];
						$fb_alb[$k]['small'] = $v['images']['3']['source'];
					}	
				}
				$this->smarty->assign('fb_alb', $fb_alb);
		}	
	

	
	//echo $row['id'];
	
    echo $this->ProcessTemplateFromDatabase($thetemplate);
  }
else
  { 
    // product not found for some reason.
    $action = $this->GetPreference('prodnotfound','domsg');
    switch($action)
      {
      case 'do404':
	cge_redirect::redirect404();
	break;

      case 'do301':
	$page = $this->GetPreference('prodnotfoundpage',-1);
	if( $page != '' && $page != -1 )
	  {
	    cge_redirect::redirect301($page);
	  }
	// fall through to domsg

      case 'domsg':
      default:
	$msg = $this->GetPreference('prodnotfoundmsg',
				    $this->Lang('error_product_notfound'));
	echo $this->ProcessTemplateFromData($msg);
	break;
      }
  }

?>
