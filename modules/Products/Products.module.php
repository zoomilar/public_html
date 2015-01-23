<?php  /* -*- Mode: PHP; tab-width: 4; c-basic-offset: 2 -*- */
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Products (c) 2008 by Robert Campbell 
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

$cgextensions = cms_join_path($gCms->config['root_path'],'modules',
			      'CGExtensions','CGExtensions.module.php');
if( !is_readable( $cgextensions ) )
{
  echo '<h1><font color="red">ERROR: The CGExtensions module could not be found.</font></h1>';
  return;
}
require_once($cgextensions);

define('PRODUCTS_PREF_NEWSUMMARY_TEMPLATE','products_pref_newsummary_template');
define('PRODUCTS_PREF_DFLTSUMMARY_TEMPLATE','products_pref_dfltsummary_template');
define('PRODUCTS_PREF_NEWDETAIL_TEMPLATE','products_pref_newdetail_template');
define('PRODUCTS_PREF_DFLTDETAIL_TEMPLATE','products_pref_dfltdetail_template');
define('PRODUCTS_PREF_NEWCATEGORYLIST_TEMPLATE','products_pref_newcategorylist_template');
define('PRODUCTS_PREF_DFLTCATEGORYLIST_TEMPLATE','products_pref_dfltcategorylist_template');
define('PRODUCTS_PREF_NEWBYHIERARCHY_TEMPLATE','products_pref_newbyhierarchy_template');
define('PRODUCTS_PREF_DFLTBYHIERARCHY_TEMPLATE','products_pref_dfltbyhierarchy_template');
define('PRODUCTS_PREF_NEWSEARCH_TEMPLATE','products_pref_newsearch_template');
define('PRODUCTS_PREF_DFLTSEARCH_TEMPLATE','products_pref_dfltsearch_template');

class Products extends CGExtensions
{
  var $_hierarchy_cache;
  var $_category_cache;
  var $_admin_loaded;
  var $_flddef_cache;
	
  public function __construct()
  {
    parent::__construct();
	
	$this->_hierarchy_cache = array();
	$this->_category_cache = array();
	$this->_admin_loaded = false;

	$this->AddImageDir('icons');

    $smarty = cmsms()->GetSmarty();
	$smarty->register_function('products_getcategory',
							   array($this,'_smarty_products_getcategory'));
	$smarty->register_function('products_hierarchy_breadcrumb',
							   array($this,'_smarty_products_hierarchy_breadcrumb'));
	$smarty->register_function('products_hierarchy_parent',
							   array($this,'_smarty_products_hierarchy_parent'));
  }

  function GetName()
  {
	return 'Products';
  }

  function GetFriendlyName()
  {
	return $this->Lang('product_manager');
  }

  function GetDependencies()
  {
	return array('CGExtensions'=>'1.24',
				 'CGSimpleSmarty'=>'1.4.4',
				 'JQueryTools'=>'1.0.11');
  }

  function AllowAutoInstall()
  {
	return FALSE;
  }

  function AllowAutoUpgrade()
  {
	return FALSE;
  }

  function IsPluginModule()
  {
	return true;
  }

  function HasAdmin()
  {
	return true;
  }

  function GetVersion()
  {
	return '2.18.4';
  }

  function MinimumCMSVersion()
  {
	return '1.10.2';
  }

  function GetAdminDescription()
  {
	return $this->Lang('module_description');
  }

  function VisibleToAdminUser()
  {
	return $this->CheckPermission('Modify Products') ||
	  $this->CheckPermission('Modify Templates') ||
	  $this->CheckPermission('Modify Site Preferences');
  }

  /*---------------------------------------------------------
   GetHeaderHTML()
   ---------------------------------------------------------*/
  function GetHeaderHTML()
  {
	$obj = cge_utils::get_module('JQueryTools');
    if( is_object($obj) )
      {
$tmpl = <<<EOT
{JQueryTools action='incjs' exclude='form'}
{JQueryTools action='ready'}
EOT;
        return $this->ProcessTemplateFromData($tmpl);
      }
  }	


  function SetParameters()
  {
	
	$this->RegisterModulePlugin();
	$this->RestrictUnknownParams();

	$this->CreateParameter('action','default',$this->Lang('param_action'));

	$this->CreateParameter('productid','',$this->Lang('param_productid'));
	$this->SetParameterType('productid',CLEAN_INT);
	
	
	$this->CreateParameter('recently_viewed','','');
	$this->SetParameterType('recently_viewed',CLEAN_INT);
	
	$this->CreateParameter('projektas','',$this->Lang('param_detailpage'));
	$this->SetParameterType('projektas',CLEAN_STRING);	
	
	$this->CreateParameter('detailpage','',$this->Lang('param_detailpage'));
	$this->SetParameterType('detailpage',CLEAN_STRING);

	$this->CreateParameter('categorylisttemplate','',$this->Lang('param_categorylisttemplate'));
	$this->SetParameterType('categorylisttemplate',CLEAN_STRING);
	$this->CreateParameter('categorylistdtltemplate','',$this->Lang('param_categorylistdtltemplate'));
	$this->SetParameterType('categorylistdtltemplate',CLEAN_STRING);

	$this->CreateParameter('detailtemplate','',$this->Lang('param_detailtemplate'));
	$this->SetParameterType('detailtemplate',CLEAN_STRING);

	$this->CreateParameter('summarytemplate','',$this->Lang('param_summarytemplate'));
	$this->SetParameterType('summarytemplate',CLEAN_STRING);

	$this->CreateParameter('hierarchytemplate','',$this->Lang('param_hierarchytemplate'));
	$this->SetParameterType('hierarchytemplate',CLEAN_STRING);
	$this->CreateParameter('hierarchypage','',$this->Lang('param_hierarchypage'));
	$this->SetParameterType('hierarchypage',CLEAN_STRING);

	$this->CreateParameter('sortby','product_name',$this->Lang('param_sortby'));
	$this->SetParameterType('sortby',CLEAN_STRING);
	$this->CreateParameter('sortorder','asc',$this->Lang('param_sortorder'));
	$this->SetParameterType('sortorder',CLEAN_STRING);
	$this->CreateParameter('sorttype','',$this->Lang('param_sorttype'));
	$this->SetParameterType('sorttype',CLEAN_STRING);
// 	$this->CreateParameter('selectcategory',0,$this->Lang('param_selectcategory'));
// 	$this->SetParameterType('selectcategory',CLEAN_INT);
	
	//sukuriamas parametras gamintoju filtravimui
	$this->CreateParameter('filter1', '','');
	$this->SetParameterType('filter1', CLEAN_STRING);
	$this->CreateParameter('comparetemplate', '','');
	$this->SetParameterType('comparetemplate', CLEAN_STRING);

	$this->CreateParameter('tpl', '','');
	$this->SetParameterType('tpl', CLEAN_STRING);	
	
	$this->CreateParameter('excludecat','',$this->Lang('param_excludecat'));
	$this->SetParameterType('excludecat',CLEAN_STRING);

	$this->CreateParameter('notpretty','',$this->Lang('param_notpretty'));
	$this->SetParameterType('notpretty',CLEAN_STRING);
	
	$this->CreateParameter('category','',$this->Lang('param_category'));
	$this->SetParameterType('category',CLEAN_STRING);
	$this->SetParameterType('categoryname',CLEAN_STRING);
	$this->CreateParameter('hierarchy','',$this->Lang('param_hierarchy'));
	$this->SetParameterType('hierarchy',CLEAN_STRING);
	$this->CreateParameter('pagelimit','',$this->Lang('param_pagelimit'));
	$this->SetParameterType('pagelimit',CLEAN_INT);
	$this->CreateParameter('parent','',$this->Lang('param_parent'));
	$this->SetParameterType('parent',CLEAN_INT);
	$this->CreateParameter('parents','',$this->Lang('param_parents'));
	$this->SetParameterType('parents',CLEAN_STRING);
	$this->CreateParameter('showall','',$this->Lang('param_showall'));
	$this->SetParameterType('showall',CLEAN_INT);
	$this->CreateParameter('field','',$this->Lang('param_field'));
	$this->SetParameterType('field',CLEAN_STRING);
	$this->SetParameterType('fieldid',CLEAN_INT);
	$this->SetParameterType('fieldval',CLEAN_STRING);
	$this->CreateParameter('fieldval','',$this->Lang('param_fieldval'));
	$this->SetParameterType('categoryfield',CLEAN_STRING);
	$this->CreateParameter('categoryfield','',$this->Lang('param_categoryfield'));

	$this->CreateParameter('inline',0,$this->Lang('param_inline'));
	$this->SetParameterType('inline',CLEAN_INT);
	$this->CreateParameter('resultpage','',$this->Lang('param_resultpage'));
	$this->SetParameterType('resultpage',CLEAN_STRING);
	$this->CreateParameter('searchformtemplate','',$this->Lang('param_searchformtemplate'));
	$this->SetParameterType('searchformtemplate',CLEAN_STRING);
	$this->CreateParameter('searchfield','',$this->Lang('param_searchfield'));
	$this->SetParameterType('searchfield',CLEAN_STRING);

	$this->CreateParameter('summarypage',$this->Lang('param_summarypage'));
	$this->SetParameterType('summarypage',CLEAN_STRING);

	$this->SetParameterType('junk',CLEAN_STRING);
	$this->SetParameterType('page',CLEAN_INT);
	$this->SetParameterType('alias',CLEAN_STRING);
	
	$this->CreateParameter('hierarchyid','','');
	$this->SetParameterType('hierarchyid',CLEAN_INT);
	$this->SetParameterType('categoryid',CLEAN_INT);

	$this->CreateParameter('productlist',$this->Lang('param_productlist'));
	$this->SetParameterType('productlist',CLEAN_NONE);
	
	$this->CreateParameter('session_filter',$this->Lang('session_filter'));
	$this->SetParameterType('session_filter',CLEAN_INT);
	
	$this->CreateParameter('exclude_prod',$this->Lang('exclude_prod'));
	$this->SetParameterType('exclude_prod',CLEAN_INT);

	$this->SetParameterType(CLEAN_REGEXP.'/cd_.*/',CLEAN_STRING);

	// Friendly URL stuff
    $detailpage = $this->GetPreference('detailpage',-1);
	$contentops = cmsms()->GetContentOperations();
    if( $detailpage == -1 )
      {
		$detailpage = $contentops->GetDefaultPageID();
      }
	$str = '/'.$this->GetPreference('urlprefix','[Pp]roducts');
	if( $this->GetPreference('usehierpathurls') )
	  {
		$this->RegisterRoute($str.'\/details\/(?P<returnid>[0-9]+)\/([^\/]+\/)+(?P<alias>.*)$/',
							 array('action'=>'details','returnid'=>$detailpage));
		$this->RegisterRoute($str.'\/details\/([^\/]+\/)+(?P<alias>.*)$/',
							 array('action'=>'details','returnid'=>$detailpage));
	  }

	/*$this->RegisterRoute($str.'\/(?P<productid>[0-9]+)\/(?P<returnid>[0-9]+)\/(?P<junk>.*?)$/',
						 array('action'=>'details'));
	$this->RegisterRoute($str.'\/(?P<productid>[0-9]+)\/(?P<junk>.*?)$/',
						 array('action'=>'details','returnid'=>$detailpage));
	$this->RegisterRoute($str.'\/viewcategory\/(?P<categoryid>[0-9]+)\/(?P<returnid>[0-9]+)$/',
						 array('action'=>'categorylist'));
	$this->RegisterRoute($str.'\/(?P<productid>[0-9]+)$/');*/
	//
	
	
	$this->RegisterRoute($str.'\/summary\/($P<returnid>[0-9]+)\/(?P<junk>.*?)$/');
	$this->RegisterRoute($str.'\/summary\/($P<returnid>[0-9]+)$/');
	$this->RegisterRoute($str.'\/bycategory\/(?P<categoryid>[0-9]+)\/(?P<returnid>[0-9]+)\/(?P<junk>.*?)$/');
	$this->RegisterRoute($str.'\/bycategory\/(?P<categoryid>[0-9]+)\/(?P<returnid>[0-9]+)$/');
	/*$this->RegisterRoute($str.'\/byhierarchy\/(?P<hierarchyid>[0-9]+)\/(?P<returnid>[0-9]+)\/(?P<junk>.*?)$/');
	$this->RegisterRoute($str.'\/byhierarchy\/(?P<hierarchyid>[0-9]+)\/(?P<returnid>[0-9]+)$/');*/
	
	$this->RegisterRoute($str.'\/byhierarchy\/(?P<hierarchyid>[0-9]+)\/(?P<returnid>[0-9]+)\/(?P<junk>.*?)$/', array('do_module_route_detection' => 1));
	$this->RegisterRoute($str.'\/byhierarchy\/(?P<hierarchyid>[0-9]+)\/(?P<returnid>[0-9]+)$/', array('do_module_route_detection' => 1));
	
	$lng_for_p = $this->GetPreference('kalbos', 'lt');
	$lng_for_p = explode(',', $lng_for_p);
	$routes_done = false;
	$routes_done2 = false;
	if (count($lng_for_p) > 0) {
		foreach ($lng_for_p as $val) {
			$tname = $this->GetPreference('summary_page_names_field_'.$val, '');
			if (!empty($tname)) {
				$routes_done = true;
				$letter = substr($tname, 0, 1);
				$left = substr($tname, 1);
				//[Pp]roducts
				$tname = '/['.strtoupper($letter).strtolower($letter).']'.$left;
				//echo $tname; die;
				$this->RegisterRoute($tname.'\/(?P<hier_alias>.*?)$/', array('do_module_route_detection' => 1));
				//jei naudojant visinius produktu puslapius neveikia, irasyti: byhierarchy\/
			}
			
			$tname2 = $this->GetPreference('detail_page_names_field_'.$val, '');
			if (!empty($tname2)) {
				$routes_done2 = true;
				$letter2 = substr($tname2, 0, 1);
				$left2 = substr($tname2, 1);
				
				$tname2 = '/['.strtoupper($letter2).strtolower($letter2).']'.$left2;
				
				$this->RegisterRoute($tname2.'\/(?P<prod_alias>.*?)$/', array('action' => 'details', 'do_module_route_detection' => 1));
				//jei naudojant visinius produktu puslapius neveikia, irasyti: byhierarchy\/
			}
			
			//$this->RegisterRoute($str.'\/(?P<productid>[0-9]+)\/(?P<returnid>[0-9]+)\/(?P<junk>.*?)$/', array('do_module_route_detection' => 1));
		}
	}
	if ($routes_done == false) {
		$this->RegisterRoute($str.'\/(?P<hier_alias>.*?)$/', array('do_module_route_detection' => 1));
	}
	if ($routes_done2 == false) {
		$this->RegisterRoute($str.'\/(?P<prod_alias>.*?)$/', array('do_module_route_detection' => 1));
	}
	
	
	
	$hierpage = $this->GetPreference('hierpage',-1);
	if( $hierpage <= 0 )
	  {
		$hierpage = $detailpage;
	  }
	$this->RegisterRoute($str.'\/hierarchy\/(?P<parent>[0-9]+)\/(?P<returnid>[0-9]+)$/');
	$this->RegisterRoute($str.'\/hierarchy\/(?P<parent>[0-9]+)\/(?P<returnid>[0-9]+)\/(?P<junk>.*?)$/');
	$this->RegisterRoute($str.'\/hierarchy\/(?P<parent>[0-9]+)\/(?P<junk>.*?)$/',
						 array('action'=>'hierarchy','returnid'=>$hierpage));
  }

  public function LazyLoadFrontend() { return FALSE; }  
  public function LazyLoadAdmin() { return TRUE; }

  function InstallPostMessage()
  {
	return $this->Lang('postinstall');
  }

  function UninstallPostMessage()
  {
	return $this->Lang('postuninstall');
  }

  function UninstallPreMessage()
  {
	return $this->Lang('preuninstall');
  }

  function GetHelp($lang='en_US')
  {
	return file_get_contents(dirname(__FILE__).'/help.inc');
  }

  function GetAdminSection()
  {
	return 'content';
  }

  function GetAuthor()
  {
	return 'calguy1000';
  }

  function GetAuthorEmail()
  {
	return 'calguy1000@cmsmadesimple.org';
  }

  function GetChangeLog()
  {
	return file_get_contents(dirname(__FILE__).'/changelog.html');
  }

  function GetEventDescription( $eventname )
  {
	return $this->lang('eventdesc-' . $eventname);
  }

  function GetEventHelp( $eventname )
  {
	return $this->lang('eventhelp-' . $eventname);
  }

  function HandlersEvents()
  {
	return TRUE;
  }


  /*---------------------------------------------------------
   DoAction()
   ---------------------------------------------------------*/
  function DoAction($name,$id,$params,$returnid='')
  {
    $smarty = cmsms()->GetSmarty();

    $smarty->assign_by_ref('mod',$this);
    $smarty->assign('returnid',$returnid);
    parent::DoAction($name,$id,$params,$returnid);
  }


  function _load_admin()
  {
	if( !$this->_admin_loaded )
	  {
		require_once(dirname(__FILE__).'/functions.admin_tools.php');
		$this->_admin_loaded = true;
	  }
  }


  // deprecated
  function GetTypesDropdown( $id, $name, $selected = '', $addtext = '', $selectone = false )
  {
	$this->_load_admin();
	return products_GetTypesDropdown($this,$id,$name,$selected,$addtext,$selectone);
  }
	

  // deprecated
  function &GetCategory($category_id,$full = false)
  {
	$gCms = cmsms();
	$db = $gCms->GetDb();
	$config = $gCms->GetConfig();

	$query = 'SELECT * FROM '.cms_db_prefix().'module_products_categories WHERE id = ?';
    $query2 = 'SELECT * FROM '.cms_db_prefix().'module_products_category_fields 
               WHERE category_id = ?';

	$row = $db->GetRow($query,array($category_id));
	if( !$row ) return FALSE;

	$onerow = new stdClass();
	$onerow->id = $row['id'];
	$onerow->name = $row['name'];
	$onerow->value = false;
	$onerow->file_location = $config['uploads_url'].'/'.$this->GetName().'/categories/'.$onerow->id;

	if( $full )
	  {
		$tmp2 = $db->GetArray($query2,$row['id']);
		if( is_array($tmp2) )
		  {
			$onerow->data = $tmp2;
		  }
	  }

	return $onerow;
  }


  // deprecated
  function GetCategories($full = false)
  {
	if( $full ) return product_utils::get_full_categories($full);
	return product_utils::get_categories($full);
  }


  // deprecated
  function GetCategoriesForProduct($product,$brief = false,$full = false)
  {
	$entryarray = array();

	$gCms = cmsms();
	$db = $gCms->GetDB();
	
	$entryarray = $this->GetCategories($full);

	$query = 'SELECT c.* FROM '.cms_db_prefix().'module_products_product_categories c WHERE c.product_id = ? ORDER BY c.category_id';
	$prodcats = $db->GetArray($query,array($product));
	
	$results = array();
	if( $brief )
	  {
		foreach( $prodcats as $oneprodcat )
		  {
			foreach( $entryarray as $entry )
			  {
				if( $oneprodcat['category_id'] == $entry->id )
				  {
					$entry->value = true;
					$results[] = $entry;
					break;
				  }
			  }
		  }
	  }
	else
	  {
		// full list of categories,
		// set value to true if this product is a member of this category
		foreach( $entryarray as $entry )
		  {
			$entry->value = false;
			foreach( $prodcats as $oneprodcat )
			  {
				if( $oneprodcat['category_id'] == $entry->id )
				  {
					$entry->value = true;
					break;
				  }
				
			  }

			$results[] = $entry;
		  }
	  }
	return $results;
  }
	

  // deprecated
  function GetFieldDefs($admin = false,$public = true)
  {
	return product_utils::get_fielddefs($admin,$public);
  }

	
  function GetFieldDefsNames($public = false) {
	$gCms = cmsms();
	$db = $gCms->GetDB();
	
	$val_f = '';
	
	if ($public == true) {
		$query = "SELECT id FROM ".cms_db_prefix()."module_products_fielddefs WHERE public > 0";
		$res_x = $db->getArray($query);
		
		$ids = array();
		foreach ($res_x as $vv) {
			$ids[] = $vv['id'];
		}
		
		if (count($ids) > 0) {
			$val_f = ', fv.value_'.implode(', fv.value_', $ids);
		}
	} else {
		$query = "SELECT id FROM ".cms_db_prefix()."module_products_fielddefs";//WHERE admin_only <= 0
		$res_x = $db->getArray($query);
		echo $db->sql;
		$ids = array();
		foreach ($res_x as $vv) {
			$ids[] = $vv['id'];
		}
		
		if (count($ids) > 0) {
			$val_f = ', fv.value_'.implode(', fv.value_', $ids);
		}
	}
	return $val_f;
  }
	
	
  // deprecated, move to class
  function GetFieldDefsForProduct($id,$admin = false,$public = true)
  {
	$gCms = cmsms();
	$db = $gCms->GetDB();
		
	$entryarray = $this->GetFieldDefs($admin,$public);
	
	
	$query = '';
	if( $admin == true && $public == true )
	  {
		$query = 'SELECT fv.* FROM '.cms_db_prefix().'module_products_fieldvals fv WHERE fv.product_id = ?';
	  }
	else if( $public == true )
	  {
		
		$val_f = $this->GetFieldDefsNames($public);
		
		$query = 'SELECT fv.product_id, fv.create_date, fv.modified_date '.$val_f.' FROM '.cms_db_prefix().'module_products_fieldvals fv WHERE fv.product_id = ?';
		
	  }
	else 
	  {
		
		$val_f = $this->GetFieldDefsNames();
		
		$query = 'SELECT fv.product_id, fv.create_date, fv.modified_date '.$val_f.' FROM '.cms_db_prefix().'module_products_fieldvals fv WHERE fv.product_id = ?';
	  }
	  
	$dbresult = $db->GetRow($query, array($id));

	$res = array();
	foreach( $entryarray as $entry )
	  {
		$newentry = clone $entry;
		
		$newentry->value = null;
		foreach ($dbresult as $r_key => $row)
		  {
			if (strpos($r_key, 'value_') !== false) {
				$temp_key = intval(str_replace('value_', '', $r_key));
				if ($temp_key == $newentry->id) {
					if( $newentry->type == 'dimensions' || $newentry->type == 'subscription')
					  {
						$row = $this->unser2($row);
					  }
					if($newentry->type == 'textarea') {
						$row = $this->unser2($row);
					}
					if($newentry->type == 'textarea_multi') {
						$row = unserialize($row);
					}
					if ($newentry->type == 'checkboxgroup') {
						
						$row = unserialize($row);
						$row_new = array();
						
						if (is_array($newentry->optionslng) && count($newentry->optionslng) > 0 && is_array($row) && count($row) > 0) {
							foreach ($newentry->optionslng as $key => $val) {
								$val_u = $val;
								$f_v = array_shift($val);
								if (in_array($f_v, $row)) {
									$row_new[$key] = $val_u;
								}
								
							}
						}
						
						$newentry->value_full = $row_new;
						
						
						/*echo '<pre>';
						print_r($row);
						echo '</pre>';*/
					}
					
					
					if($newentry->type == 'textbox' && @unserialize($row)) $row = $this->unser2($row);
					
					
					
					
					$newentry->value = $row;
					$newentry->fielddef_id = $newentry->id; // ??
					
					
					
					
					
					break;
				}
			}
		  }
		$res[] = $newentry;
	  }
		/*echo '<pre>';
		print_r($res);
		echo '</pre>';*/
	return $res;
  }
	

  function SearchResult($returnid, $productid, $attr = '')
  {
	$smarty = cmsms()->GetSmarty();
	$kalba = $smarty->get_template_vars('kalba');
	return product_ops::get_search_result($returnid,$productid,$attr, $kalba);
  }
	

  function SearchReindex(&$module)
  {
	$this->_load_admin();
	return products_SearchReindex($this,$module);
  }


  // deprecated ... move to class
  function GetSearchableText($product_id)
  {
	// the product name, the description, and all data from
	// text fields, textara fields, and dropdowns
	$product = product_ops::get_product($product_id);
	if( $product['status'] != 'published' ) return array();
	$defs = $this->GetFieldDefsForProduct($product_id);

	$results = array();
	$results[] = $product['product_name'];
	$results[] = $product['details'];
	$results[] = $product['sku'];
	$results[] = $product['alias'];
	foreach( $defs as $onedef )
	  {
		switch( $onedef->type )
		  {
		  case 'textbox':
		  case 'textarea':
		  case 'dropdown':
            if( isset($onedef->value) ) {
				//print_r($onedef->value);
				if (is_array($onedef->value) && count($onedef->value) > 0) {
					foreach ($onedef->value as $kk => $val) {
						if (!empty($val)) {
							$results[] = $val;
						}
					}
				} else {
					$results[] = $onedef->value;
				}
			}
			break;
		  }
	  }
	
	/*echo '<pre>';
	print_r($results);
	echo '</pre>';
	die;*/
	return $results;
  }


  // deprecated
  function GetProductNameFromId( $id )
  {
	$product = product_ops::get_product($id);
	return $product['product_name'];
  }


  // depreacated
  function is_taxable($product_id)
  {
	$tmp = product_ops::get_product($product_id);
	return $tmp['taxable'];
  }


  function is_shippable($product_id)
  {
	// todo: add something here.
	return TRUE;
  }


  // deprecated
  function GetProduct( $id )
  {
	return product_ops::get_product($id);
  }


  // deprecated
  function GetProductAttributes($product_id)
  {
	$results = array();
	$db = $this->GetDb();
	$query = "SELECT * FROM ".cms_db_prefix()."module_products_attribsets
               WHERE product_id = ? ORDER BY attrib_set_id";
	$dbresult = $db->Execute($query,array($product_id));
	while( $dbresult && ($row = $dbresult->FetchRow()) )
	  {
		$results[$row['attrib_set_id']] =  $row['attrib_set_name'];
	  }
	return $results;
  }


  // deprecated
  // ready to remove now?
  function GetProductAttributeDataComplete($product_id)
  {
	$db = $this->GetDb();
	$data = array();

	$query = 'SELECT * FROM '.cms_db_prefix().'module_products_attribsets
              WHERE product_id = ? ORDER BY attrib_set_id';
	$tmp = $db->GetArray($query,array($product_id));
	

	$tmp2 = cge_array::extract_field($tmp,'attrib_set_id');
	$q2 = 'SELECT * FROM '.cms_db_prefix().'module_products_attributes
            WHERE attrib_set_id IN ('.implode(',',$tmp2).') ORDER BY attrib_id ASC';
	$tmp3 = $db->GetArray($q2);

	for( $i = 0; $i < count($tmp); $i++ )
	  {
		$row =& $tmp[$i];

		$attribs = array();
		for( $j = 0; $j < count($tmp3); $j++ )
		  {
			$row2 =& $tmp3[$j];
			if( $row2['attrib_set_id'] < $row['attrib_set_id'] ) continue;
			if( $row2['attrib_set_id'] > $row['attrib_set_id'] ) break;

			$attribs[$row2['attrib_text']] = $row2['attrib_adjustment'];
		  }
		$data[$row['attrib_set_name']] = $attribs;
	  }

	if( !count($data) ) return false;
	return $data;
  }


  // deprecated
  static public function GetProductIdsFromCategories($str,$delim = ',')
  {
	if( empty($str) ) return FALSE;
	$names = explode($delim,$str);
	for( $i = 0; $i < count($names); $i++ )
	  {
		$names[$i] = trim(trim($names[$i]),"'");
	  }

	$db = cmsms()->GetDb();

	// convert names to category ids.
	$query = 'SELECT id FROM '.cms_db_prefix().'module_products_categories
               WHERE name IN ('.implode(',',$names).')';
	$categories = $db->GetCol($query);
	if( !$categories ) return FALSE;
	
	$query = 'SELECT product_id FROM '.cms_db_prefix().'module_products_product_categories
               WHERE category_id IN ('.implode(',',$categories).')';
	$products = $db->GetCol($query);
	return $products;
  }


  // deprecated 
  static public function GetProductIdsFromHierarchy($hier_str,$delim = ' | ')
  {
	if( empty($hier_str) ) return FALSE;
	$hier_str = trim($hier_str);
	if( $delim != ' | ' )
	  {
		$hier_str = str_replace($delim,' | ',$hier_str);
	  }
	
	$gCms = cmsms();
	$db = $gCms->GetDb();
	$hierarchies = array();
	if( endswith($hier_str,'*') )
	  {
		$hier_str = str_replace('*','%',$hier_str);
		
		$query = 'SELECT id FROM '.cms_db_prefix().'module_products_hierarchy 
               WHERE upper(long_name) LIKE upper(?)';
		$hierarchies = $db->GetCol($query,array($hier_str));
	  }
	else
	  {
		$query = 'SELECT id FROM '.cms_db_prefix().'module_products_hierarchy
               WHERE upper(long_name) = upper(?)';
		$hier_id = $db->GetOne($query,array($hier_str));
		if( !$hier_id )
		  {
			return FALSE;
		  }
		$hierarchies[] = $hier_id;
	  }

	$tmp = implode(',',$hierarchies);
	$query = 'SELECT product_id FROM '.cms_db_prefix()."module_products_prodtohier
                 WHERE hierarchy_id IN ($tmp)";
	$products = $db->GetCol($query);
	return $products;
  }


  // deprecated, move to ops
  function UpdateHierarchyPositions($kalbos = false)
  {
	return product_utils::update_hierarchy_positions($kalbos);
  }


  // deprecated, move to ops
  function BuildHierarchyList()
  {
	$tmp = hierarchy_ops::get_flat_list(FALSE);
	
	/*echo '<pre>';
	print_r($tmp);
	echo '</pre>';*/
	
	$list = array($this->Lang('none')=>-1);
	if( is_array($tmp) && count($tmp) ) {
	  foreach( $tmp as $one ) {
		if (is_array($one['long_name'])) {
			$list[$one['long_name']['lt']] = $one['id'];
		} else {
			$list[$one['long_name']] = $one['id']; // backwards.
		}
	  }
	}
	return $list;
  }


  // deprecated, move to ops
  function CreateHierarchyDropdown($id,$name,$selectedvalue)
  {
	$tmp = $this->BuildHierarchyList();
	$tmp = array_merge(array($this->Lang('any')=>''),$tmp);
	return $this->CreateInputDropdown($id,$name,$tmp,-1,$selectedvalue);
  }


  // deprecated... use get_pretty_url
  function CreatePrettyLink($id, $action, $returnid='', $contents='', $params=array(), 
							$warn_message='', $onlyhref=false, $inline=false, $addtext='', 
							$targetcontentonly=false, $prettyurl='')
  {
	// this method, if overridden, should call CreateLink for all stuff it can't
	// understand
	$products = '';
	$prettyurl = '';
	
	if( product_utils::can_do_pretty($action,$params) ) {
		
	  switch( $action ) {
	  case 'details':
		$prettyurl = product_ops::pretty_url($params['productid'],$returnid,$params);
		
		break;

	  case 'default':
		
		
		if( isset($params['categoryid']) ) {
		  // if the category id parameter is set, use bycategory
		  $prettyurl = sprintf("%s/bycategory/%d/%d",
							   $this->GetPreference('urlprefix','products'),
							   (int)$params['categoryid'],$returnid);
		  if( isset($params['categoryname']) ) {
			$prettyurl .= '/'.munge_string_to_url($params['categoryname']);
		  }
		  
		}
		else if( isset($params['hierarchyid']) ) {
			//print_r($params);
		  /*
		  // if the hierarchy id parameter is set, use byhierarchy
		  $prettyurl = sprintf("%s/byhierarchy/%d/%d",
							   $this->GetPreference('urlprefix','products'),
							   (int)$params['hierarchyid'],$returnid);*/
			$lng_for_p = $this->GetPreference('kalbos', 'lt');
			$lng_for_p = explode(',', $lng_for_p);
			$lang = '';
			$page_name = '';
			
			//echo $lang.'<br/>';
			
			if (is_array($lng_for_p) && count($lng_for_p) > 0) {
				foreach ($lng_for_p as $val) {
					if ($this->GetPreference('summary_page_field_'.$val) == $returnid) {
						$lang = $val;
						$page_name = $this->GetPreference('summary_page_names_field_'.$val);
					}
				}
			}
			
			if (!empty($lang)) {
				$db = $this->GetDb();
				$query = "SELECT * FROM ".cms_db_prefix()."module_products_hierarchy_linknames WHERE hier_id = ? AND lang = ?";
				$row = $db->GetRow($query, array($params['hierarchyid'], $lang));
				$prettyurl = $page_name.'/'.$row['alias'];
			} else {
				$prettyurl = sprintf("%s/byhierarchy/%d/%d",
				$this->GetPreference('urlprefix','products'),
				(int)$params['hierarchyid'],$returnid);
			}
			
			
		}
		else if( isset($params['fieldid']) ) {
		  // no pretty urls for this atm.
		  $prettyurl = '';
		}
		else {
		  // otherwise use summary
		  $prettyurl = sprintf("%s/summary/%d",
							   $this->GetPreference('urlprefix','products'),
							   $returnid);
		}
		
		break;

	  case 'categorylist':
		{
		  if( isset($params['categoryid']) && !isset($params['categorylistdtltemplate']) ) {
			$prettyurl = sprintf("%s/viewcategory/%s/%s",
								 $this->GetPreference('urlprefix','products'),
								 (int)$params['categoryid'],$returnid);
		  }
		}
		break;

	  case 'hierarchy':
		$prettyurl = sprintf('%s/hierarchy/%d',
							 $this->GetPreference('urlprefix','products'),
							 (int)$params['parent']);
		if( $this->GetPreference('hierpage',-1) == -1 ) {
		  // use returnid in the link.
		  $prettyurl .= '/'.$returnid;
		}
		if( $this->GetPreference('prettyhierurls',0) ) {
		  // add the name to the url.
		  $info = hierarchy_ops::get_hierarchy_info($params['parent']);
		  if( is_array($info) ) {
			{
			  $prettyurl .= '/'.munge_string_to_url($info['name']);
			}
		  }
		}
		break;
	  } // switch
	}

	if( isset($params['returnid']) ) unset($params['returnid']);
	$out = $this->CreateLink($id,$action,$returnid,$contents,$params,$warn_message,
							 $onlyhref,$inline,$addtext,$targetcontentonly,$prettyurl);
	//echo $out.'<br/>';
	return $out;
  }


  // creates a form-safe alias string
  function make_alias($string, $isForm=false)
  {
	$string = munge_string_to_url($string);
	$string = trim($string, '_');
	return strtolower($string);
  }


  function HandleUploadedImage($id,$name,$destdir,&$errors,$subfield='',$wmlocation='',$overwrite=false)
  {
	$this->_load_admin();
	return products_HandleUploadedImage($this,$id,$name,$destdir,$errors,$subfield,
										$wmlocation,$overwrite);
  }

  function HandleUploadedFile($id,$name,$destdir,&$errors,$subfield='',$wmlocation='',$overwrite=false)
  {
	$this->_load_admin();
	return products_HandleUploadedImage($this,$id,$name,$destdir,$errors,$subfield,
										$wmlocation,$overwrite);
  }


  function ProcessImage($srcname,$wmlocation='default')
  {
	$this->_load_admin();
	return products_ProcessImage($this,$srcname,$wmlocation);
  }


  // deprecated
  function GetHierarchyInfo($hierarchy_id)
  {
	return hierarchy_ops::get_hierarchy_info($hierarchy_id);
  }


  // deprecated
  function GetHierarchyPath($hiearchy_id)
  {
	return hierarchy_ops::get_hierarchy_path($hierarchy_id);
  }


  // deprecated
  function GetProductHierarchyPath($productid)
  {
	return product_ops::get_product_hierarchy_path($productid);
  }


  function DeleteProduct($productid,$update_search=true)
  {
	$this->_load_admin();
	return products_DeleteProduct($this,$productid,$update_search);
  }


  function _smarty_products_getcategory($params,&$smarty)
  {
	if( !isset($params['categoryid']) ) return;

	$catid = (int)$params['categoryid'];
	$obj = $this->GetCategory($catid);
	
	if( isset($params['assign']) )
	  {
		$smarty->assign($params['assign'],$obj);
		return;
	  }
	return $obj;
  }
  
  function getHierarchyParents($hier) {
	
	$ret = array();
	$db = $this->GetDb();
	
	$query = "SELECT parent_id FROM ".cms_db_prefix()."module_products_hierarchy WHERE id = ? ";
	$res = $db->getOne($query, array($hier));

	if ($res && $res > -1) {
		$ret2 = $this->getHierarchyParents($res);
	}
	if (count($ret2) > 0) {
		foreach ($ret2 as $val) {
			$ret[] = $val;
		}
		$ret[] = $hier;
	} else {
		$ret = array($hier);
	}
	
	return $ret;
  }
  
  function getHierarchyName($heir) {
	$db = $this->GetDb();
	$query = "SELECT name FROM ".cms_db_prefix()."module_products_hierarchy WHERE id = ? ";
	$res = $db->getOne($query, array($heir));
	$res = unserialize($res);
	
	return $res;
  }
  
  function _smarty_products_hierarchy_breadcrumb($params,&$smarty)
  {
	if( !isset($params['hierarchyid']) ) return;
	//echo 'zzz';
	$returnid = $this->GetPreference('hierpage');
	if( $returnid <= 0 ) $returnid = cms_utils::get_current_pageid();
	if( isset($params['pageid']) ) {
	  $tmp = $this->resolve_alias_or_id($params['pageid']);
	  if( $tmp ) $returnid = $tmp;
	}
	$delim = ' &raquo ';
	if( isset($params['delim']) ) {
	  $delim = $params['delim'];
	}

	$hierid = (int)$params['hierarchyid'];
	$bc = hierarchy_ops::get_breadcrumb('prod',$hierid,$returnid,$delim, $params);
	
	if( isset($params['assign']) ) {
	  $smarty->assign($params['assign'],$bc);
	  return;
	}
	return $bc;
  }

  function _smarty_products_hierarchy_parent($params,&$smarty)
  {
	if( !isset($params['hierarchyid']) ) return;
	$hid = (int)$params['hierarchyid'];
	$info = hierarchy_ops::get_hierarchy_info($hid);
	if( !is_array($info) ) return;

	if( isset($params['assign']) ) {
	  $smarty->assign($params['assign'],$info['parent_id']);
	  return;
	}
	return $info['parent_id'];
  }

  function get_product_info($product_id)
  {
	global $kalba;
	if (!$kalba) {
		$smarty = cmsms()->GetSmarty();
		$kalba = $smarty->get_template_vars('kalba');
	}
	$tmp = $this->GetProduct($product_id);
	if( !is_array($tmp) )
	  {
		return FALSE;
	  }
	$tmp2 = $this->GetProductAttributes($product_id);
	if( $tmp2 )
	  {
		$db = $this->GetDb();
		$attr_results = array();
		$query = 'SELECT * FROM '.cms_db_prefix().'module_products_attributes
                   WHERE attrib_set_id = ? ORDER BY attrib_id';
		foreach( $tmp2 as $attr_set_id => $attr_set_name )
		  {
			$attr_data = array('name'=>$attr_set_name);
			$tmp3 = $db->GetArray($query,array($attr_set_id));
			if( is_array($tmp3) )
			  {
				$tmp3 = cge_array::to_hash($tmp3,'attrib_id');
				$attr_data['values'] = $tmp3;
			  }
			$attr_results[$attr_set_id] = $attr_data;
		  }
		$tmp['attributes'] = $attr_results;
	  }
	$tmp3 = $this->GetFieldDefsForProduct($product_id,true,true);
	
	/*echo '<pre>';
	print_r($tmp3);
	echo '</pre>';*/
	
	$price_field = $this->GetPreference('price_field', '');
	$akcija_field = $this->GetPreference('akcija_field', '');
	
	if ($kalba != '' && $price_field != '') {
		
		$price = 0;
		$akcija_price = 0;
		$curency = '';
		foreach ($tmp3 as $key => $val) {
			if ($val->name == $price_field) {
				$price = $val->value[$kalba];
			}
			if ($val->name == $akcija_field) {
				$akcija_price = $val->value[$kalba];
			}
			
		}
		
		if ($akcija_price > 0) {
			$tmp['price'] = $akcija_price;
			$tmp['discount'] = $price - $akcija_price;
		} else {
			$tmp['price'] = $price;
		}
		
		$curency = $this->GetPreference('curency_field_'.$kalba);
		$tmp['curency'] = $curency;
		
	}
	
	if( is_array($tmp3) )
	  {
		$tmp['fields'] = $tmp3;
	  }
	return $tmp;
  }
  
  function getHierarchyId($kalba = '') {
	global $contentobj;
	$db = $this->GetDb();
	
	$temp = explode('/', $_REQUEST['page']);
	
	if ($temp[0] == 'Products' && is_numeric($temp[1]) && is_numeric($temp[2])/* == 'details'*/) {
		$alias = array_pop($temp);
		if ($alias == '' || $alias == '.html') {
			$alias = array_pop($temp);
		}
		$hier = array();
		while (count($temp) > 3) {
			$hier[] = array_pop($temp);
		}
		
		$hier = array_reverse($hier);
		$hier = implode('/', $hier);
		
		$qq_arr = array($hier);
		$qq = '';
		if (!empty($kalba)) {
			$qq = "AND lang = ?";
			$qq_arr[] = $kalba;
		}
		$query = "SELECT hier_id FROM ".cms_db_prefix()."module_products_hierarchy_linknames WHERE alias = ? ".$qq;
		$ret = $db->GetOne($query, $qq_arr);
		if ($ret > 0) {
			return $ret;
		} else {
			return false;
		}
	} else {
		$extras = array();
		$query = "SELECT * FROM ".cms_db_prefix()."module_products_hierarchy";
		$dbresult = $db->Execute($query);
		while( $dbresult && ($row = $dbresult->FetchRow()) ) {
			if (@unserialize($row['extra1'])) {
				$tmp = unserialize($row['extra1']);
				foreach ($tmp as $val) {
					if (!empty($val)) {
						$extras[$val] = $row['id'];
					}
				}
			}
		}
		if (isset($extras[$contentobj->Id()])) {
			return $extras[$contentobj->Id()];
		}
		
		return false;
	}
	
  }
  
  
  /*
  id - herarchijos id (jei 0 rodo visus)
  f_name - laukelio pavadinimas module_products_fielddefs lenteleje
  kalba - kalba
  */
  function getManufacturers($id, $f_name, $kalba, $full_info = false) {
	$db = $this->GetDb();
	$query = "SELECT * FROM ".cms_db_prefix()."module_products_fielddefs WHERE name = ?";
	$field = $db->GetRow($query, array($f_name));
	
	if ($field['id'] > 0) {
		$options = unserialize($field['optionslng']);
		$options2 = array();
		foreach ($options as $vv) {
			if ($full_info == true) {
				
				$options2[$vv['lt']] = array(
					'value' => $vv[$kalba],
					'image' => $vv['file'],
					'link' => $vv['link']
				);
				
			} else {
				$options2[$vv['lt']] = $vv[$kalba];
			}
		}
		
		if ($id > 0) {
			$query = "SELECT value_".$field['id']." AS val FROM ".cms_db_prefix()."module_products_prodtohier AS A LEFT JOIN ".cms_db_prefix()."module_products_fieldvals AS B ON B.product_id = A.product_id WHERE A.hierarchy_id = ? GROUP BY value_".$field['id']."";
			
			$array = $db->GetArray($query, array($id));
			if (count($array) > 0) {
				$ret = array();
				foreach ($array as $val) {
					
					if (isset($options2[$val['val']])) {
						$ret[] = $options2[$val['val']];
					}
				}
				if (count($ret) > 0) {
					
					return $ret;
				}
			}
		} else {
			return $options2;
		}
	}
	return false;
	
  }
  
  function getProdsByMf($mf, $f_name, $kalba, $hier_id = 0) {
	$db = $this->GetDb();
	$query = "SELECT * FROM ".cms_db_prefix()."module_products_fielddefs WHERE name = ?";
	$field = $db->GetRow($query, array($f_name));
	
	//$hier_id
	if ($field['id'] > 0) {
		$options = unserialize($field['optionslng']);
		$options2 = array();
		foreach ($options as $vv) {
			$options2[$vv[$kalba]] = $vv['lt'];
		}
		
		if ($hier_id > 0) { 
			$query = "SELECT A.product_id FROM ".cms_db_prefix()."module_products_fieldvals AS A LEFT JOIN ".cms_db_prefix()."module_products_prodtohier AS B ON B.product_id = A.product_id WHERE A.value_".$field['id']." = ? AND B.hierarchy_id = ?";
			$array = $db->GetArray($query, array($options2[$mf], $hier_id));
		} else {
			$query = "SELECT product_id FROM ".cms_db_prefix()."module_products_fieldvals WHERE value_".$field['id']." = ?";
			$array = $db->GetArray($query, array($options2[$mf]));
			
		}
		$ret = array();
		foreach ($array as $vv) {
			$ret[] = $vv['product_id'];
		}
		return $ret;
	}
	return false;
  }
  
	function getPrevNext($params1, $kalba) {
		$db = $this->GetDb();
		
		//print_r($params1);
		if (!$params1['hierarchyid']) {
			$params1['hierarchyid'] = $this->getHierarchyId($kalba);
		}
		
		$fieldefs = '';
		$tmp = $this->GetFieldDefs();
		if( is_array($tmp) ) {
			$fielddefs = array();
			for( $i = 0; $i < count($tmp); $i++ ) {
				$obj = $tmp[$i];
				$fielddefs[$obj->name] = $obj;
			}
		}
		$sortfield = 1;
		$joins = '';
		$sortby = $this->GetPreference('sortby','product_name');
		$sortorder = $this->GetPreference('sortorder','asc');
		$default_detailpage = $this->GetPreference('detailpage');
		//echo $default_detailpage;
		//$detailpage = $default_detailpage;
		//print_r($params1);
		if (!($detailpage > 0)) {
			$detailpage = $params1['returnid'];
		}
		if (isset($params1['detailpage'])) {
			$detailpage = trim($params1['detailpage']);
		}
		
		
		if( isset( $params1['sortorder'] ) ) {
			switch( $params1['sortorder'] ) {
				case 'asc':
				case 'desc':
				$sortorder = $params1['sortorder'];
			}
		}
		
		$tmp = strtolower(trim($params1['sortby']));
		switch( $tmp ) {
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
			case 'random':
				$sortby = 'RAND()';
				$sortorder = '';
			break;
			default:
				if( startswith($tmp,'f:') ) {
					$fieldname = substr($tmp,strlen('f:'));
					if( isset($fielddefs[$fieldname]) ) {
						$fieldid = $fielddefs[$fieldname]->id;
						$as = 'FV'.$sortfield++;
						$joins = cms_db_prefix()."module_products_fieldvals {$as} ON A.id = {$as}.product_id";
						$sortby = "{$as}.value_{$fieldid}";
					}
				}
			break;
		}
		
		if( isset($params1['sorttype']) ) {
			$tmp = trim($params1['sorttype']);
			$tmp = strtoupper($tmp);
			switch( $tmp ) {
				case 'STRING':
					$sorttype = '';
				break;
				case 'SIGNED':
				case 'UNSIGNED':
					$sorttype = $tmp;
			}
		}
		
		$query = "SELECT A.* FROM ".cms_db_prefix()."module_products AS A LEFT JOIN ".cms_db_prefix()."module_products_prodtohier AS B ON B.product_id = A.id ".$joins." WHERE B.hierarchy_id = ?";
		
		
		if($sorttype == '') {
			$query .= " ORDER BY ".$sortby." ".$sortorder;
		} else {
			$query .= ' ORDER BY CAST('.$sortby.' AS '.$sorttype.') '.$sortorder;
		}
		
		
		$rows = $db->GetArray($query, array($params1['hierarchyid']));
		//print_r($params1);
		//echo $db->sql;
		if (count($rows) > 1) {
			
			$next = '';
			$prev = '';
			
			$temp_prev = '';
			$temp_next = '';
			$one_more = false;
			
			
			
			foreach ($rows as $row) {
				
				if ($one_more == true) {
					
					$parms = $params;
					$parms['productid'] = $row['id'];
					
					if(product_utils::can_do_pretty('detail',$params1) ) {
						$prettyurl = product_ops::pretty_url($row['id'],$detailpage, $kalba);
					}
					
					$temp_next = $this->CreateLink($id,'details',$detailpage,'',$parms,
						  '',true,false,'',false,$prettyurl);
					break;
				} else {
					if ((isset($params1['alias']) && $params1['alias'] == $row['alias']) || (isset($params1['productid']) && $params1['productid'] == $row['id'])) {
						$one_more = true;
					} else {
						$parms = $params;
						$parms['productid'] = $row['id'];
						if(product_utils::can_do_pretty('detail',$params1) ) {
							$prettyurl = product_ops::pretty_url($row['id'],$detailpage, $kalba);
						}
						$temp_prev = $this->CreateLink($id,'details',$detailpage,'',$parms,
						  '',true,false,'',false,$prettyurl);
					}
				}
			}
			
			if ($temp_prev == '') {
				//naudojam paskutini!!
				$tmp_row = array_pop($rows);
				$parms = $params;
				$parms['productid'] = $tmp_row['id'];
				if(product_utils::can_do_pretty('detail',$params1) ) {
					$prettyurl = product_ops::pretty_url($tmp_row['id'],$detailpage, $kalba);
				}
				
				$prev = $this->CreateLink($id,'details',$detailpage,'',$parms,
						  '',true,false,'',false,$prettyurl);
				
			} else {
				$prev = $temp_prev;
			}
			if ($temp_next == '') {
				//naudojam pirma!!
				$tmp_row = array_shift($rows);
				$parms = $params;
				$parms['productid'] = $tmp_row['id'];
				if(product_utils::can_do_pretty('detail',$params1) ) {
					$prettyurl = product_ops::pretty_url($tmp_row['id'],$detailpage, $kalba);
				}
				
				$next = $this->CreateLink($id,'details',$detailpage,'',$parms,
						  '',true,false,'',false,$prettyurl);
				
			} else {
				$next = $temp_next;
			}
			//echo $prev;
			return array('prev' => $prev, 'next' => $next);
		}
		return false;
	}
	
	function addCompareProd($prod_id) {
		if ($prod_id > 0) {
			$comp = $_SESSION['compare_prod'];
			if (count($comp) < 3) {
				if (!isset($comp[$prod_id])) {
					$comp[$prod_id] = $prod_id;
				}
			}
			$_SESSION['compare_prod'] = $comp;
		}
	}
	
	function countCompareProd() {
		$comp = $_SESSION['compare_prod'];
		return count($comp);
	}
	
	function getCompareProd() {
		global $returnid, $id;
		$db = $this->GetDb();
		$config = $this->GetConfig();
		$ret = array();
		
		$comp = $_SESSION['compare_prod'];
		if (count($comp) > 0) {
			
			foreach ($comp as $val) {
				$query = "SELECT * FROM ".cms_db_prefix()."module_products WHERE id = ?";
				$row = $db->GetRow($query, array($val));
				
				$onerow = cge_array::to_object($row);
				$onerow->file_location = $config['uploads_url'].'/'.$this->GetName().'/product_'.$row['id'];

				// add canonical entry.
				$onerow->canonical = product_ops::pretty_url($row['id']);
				$parms = array('productid'=>$val);
				$onerow->detail_url = $this->CreateLink($id,'details',$returnid,'',$parms,
									'',true,false,'',false,$onerow->canonical);
				
				$fielddefs = $this->GetFieldDefsForProduct($row['id']);
				
				$fields = array();
				foreach( $fielddefs as $onedef ) {
					if( $onedef->type == 'image' ) {
						if( isset($onedef->value) && file_exists(cms_join_path($filedir,'thumb_'.$onedef->value)) ) {
							$onedef->thumbnail = 'thumb_'.$onedef->value;
						}
						if( isset($onedef->value) && file_exists(cms_join_path($filedir,'preview_'.$onedef->value)) ) {
							$onedef->preview = 'preview_'.$onedef->value;
						}
					}
					$fields[$onedef->name] = $onedef;
				}
				if( count($fields) ) {
					$onerow->fields = $fields;
				}
				
				$onerow->hierarchy_id = product_ops::get_product_hierarchy_id($row['id']);
				$onerow->breadcrumb = product_ops::create_hierarchy_breadcrumb($id,$row['id'],$returnid);
				$ret[] = $onerow;
			}
		}
		if (count($ret) == 0) {
			return false;
		}
		while (count($ret) < 3) {
			$ret[] = array();
		}
		return $ret;
	}
	
	function removeCompareProd($prod_id) {
		if ($prod_id > 0) {
			$comp = $_SESSION['compare_prod'];
			if (isset($comp[$prod_id])) {
				unset($comp[$prod_id]);
			}
			$_SESSION['compare_prod'] = $comp;
		}
	}
	
	function findManufacturerPage() {
		$db = $this->GetDb();
		
		$query = "SELECT id FROM ".cms_db_prefix()."module_products_hierarchy WHERE extra2 = '1'";
		$row = $db->getOne($query);
		
		return $row;
		
		//$this->CreatePrettyLink($id,'hierarchy',$returnid,'',array('parent'=>$parents[0]),'',true);
	}
	
	function getProductsOrderedBy($field, $sortorder, $kalba) {
		$db = $this->GetDb();
		
		$q = "SELECT id FROM ".cms_db_prefix()."module_products_fielddefs WHERE name = ?";
		$id = $db->GetOne($q, array($field));
		//echo $db->sql;
		$q = "SELECT product_id, value_".$id." as real_val FROM ".cms_db_prefix()."module_products_fieldvals";
		$names_garb = $db->GetArray($q);
		
		$names = array();
		foreach ($names_garb as $val) {
			$val['real_val'] = unserialize($val['real_val']);
			$val['real_val'] = $val['real_val'][$kalba];
			if (!empty($val['real_val'])) {
				$names[$val['product_id']] = $val['real_val'];
			}
		}
		if ($sortorder == 'desc') {
			arsort($names);
		} else {
			asort($names);
		}
		$names2 = array();
		foreach ($names as $key => $val) {
			$names2[] = $key;
		}
		return $names2;
	}
	
	function getFieldsByGroup($group) {
		$db = $this->GetDb();
		if (!empty($group)) {
			$array = $db->GetArray("SELECT name FROM ".cms_db_prefix()."module_products_fielddefs WHERE `group` = ? ORDER BY id", array($group));
			$return_group = array();
			foreach ($array as $val) {
				$return_group[] = $val['name'];
			}
			return $return_group;
		} else {
			return false;
		}
	}
	
	function GetFieldByName($name) {
		$db = $this->GetDb();
		if (!empty($name)) {
			$array = $db->GetRow("SELECT * FROM ".cms_db_prefix()."module_products_fielddefs WHERE `name` = ?", array($name));
			return $array;
		} else {
			return false;
		}
	}
	
	function GetFilterFields() {//visus
		
		$return = array();
		$fld_names = $this->getFieldsByGroup('Filter');
		
		if (is_array($fld_names) && count($fld_names) > 0) {
			foreach ($fld_names as $val) {
				$rr = $this->GetFieldByName($val);
				if (is_array($rr) && count($rr) > 0) {
					$return[] = $rr;
				}
				
			}
			if (count($return) > 0) {
				return $return;
			}
		}
		
		return false;
	}
	
	function recently_viewed($what,$prod_id=0, $limit=4) {
		switch ($what) {
			case 'add':
				if (isset($_SESSION['recently_viewed'])) {
					$arr = $_SESSION['recently_viewed'];
					if (!in_array($prod_id, $arr)) {
						array_unshift($arr, $prod_id);
						if (count($arr) > $limit) {
							array_pop($arr);
						}
						$_SESSION['recently_viewed'] = $arr;
					}
				} else {
					$_SESSION['recently_viewed'] = array($prod_id);
				}
			break;
			
			case 'get_all':
				$arr = $_SESSION['recently_viewed'];
				while (count($arr) > $limit) {
					array_pop($arr);
				}
				$_SESSION['recently_viewed'] = $arr;
				return $_SESSION['recently_viewed'];
			break;
		}
	}
	
	function get_redirect_to($redirect_to) {
		global $loop_counter;
		
		$db = $this->GetDb();
		$query_test = "SELECT redirect_to FROM ".cms_db_prefix()."module_products_hierarchy WHERE id = ?";
		$is_rec = $db->GetOne($query_test, array($redirect_to));
		
		if ($loop_counter > 10) {
			return false;
		} else {
			if ($is_rec > 0) {
				$loop_counter++;
				$redirect_to = $this->get_redirect_to($is_rec);
			}
			return $redirect_to;
		}
	}
	function unser($string, $kalba){
		$string = unserialize($string);
		if (!$string[$kalba])
			$string = $string['lt'];
		else	
			$string = $string[$kalba];
			
		return $string;
	}
	
	function unser2($string){
		$string = unserialize($string);
		
		if (!$string['en'])
			$string['en'] = $string['lt'];
		if (!$string['ru'])
			$string['ru'] = $string['lt'];
			
		
			
		return $string;
	}	
	
	function RouteDetection(CmsRoute& $route) {
		$db = $this->GetDb();
		/*echo '<pre>';
		print_r($route);
		echo '</pre>'; die;*/
		$result = $route->get_results();
		$return = array();
		$lang = '';
		if (isset($result['hier_alias']) && !empty($result['hier_alias'])) {
			$query = "SELECT * FROM ".cms_db_prefix()."module_products_hierarchy_linknames WHERE alias = ?";
			$row = $db->GetRow($query, array($result['hier_alias']));
			if (is_array($row) && count($row) > 0) {
				$hier_id = $row['hier_id'];
				$returnid = $this->GetPreference('summary_page_field_'.$row['lang']);
				$lang = $row['lang'];
				if ($returnid > 0) {
					$return['returnid'] = $returnid;
				}
				if ($hier_id > 0) {
					$return['hierarchyid'] = $hier_id;
				}
			}
			
			//tikrinam ar ne herarchijos redirectas
			if ($hier_id > 0 && !empty($lang)) {
				$query = "SELECT redirect_to FROM ".cms_db_prefix()."module_products_hierarchy WHERE id = ?";
				$redirect_to = $db->GetOne($query, array($return['hierarchyid']));
				
				if ($redirect_to > 0 && $this->isHierRecursion($return['hierarchyid']) == false) {
					
					$page_name = $this->GetPreference('summary_page_names_field_'.$lang);
							
				
					$query = "SELECT * FROM ".cms_db_prefix()."module_products_hierarchy_linknames WHERE hier_id = ? AND lang = ?";
					$row = $db->GetRow($query, array($redirect_to, $lang));
					header('Location: /'.$page_name.'/'.$row['alias'].'.html');
					die;
					
					
				}
			
			}
			
		} else if (isset($result['hierarchyid']) && $result['hierarchyid'] > 0 && isset($result['returnid']) && $result['returnid'] > 0) {
			//googlui, kad veiktu ir senoviniai linkai (daugiau niekam)
			$lng_for_p = $this->GetPreference('kalbos', 'lt');
			$lng_for_p = explode(',', $lng_for_p);
			$lang = '';
			$page_name = '';
			if (is_array($lng_for_p) && count($lng_for_p) > 0) {
				foreach ($lng_for_p as $val) {
					if ($this->GetPreference('summary_page_field_'.$val) == $result['returnid']) {
						$lang = $val;
						$page_name = $this->GetPreference('summary_page_names_field_'.$val);
					}
				}
			}
			if (!empty($lang)) {
				$query = "SELECT * FROM ".cms_db_prefix()."module_products_hierarchy_linknames WHERE hier_id = ? AND lang = ?";
				$row = $db->GetRow($query, array($result['hierarchyid'], $lang));
				header('Location: /'.$page_name.'/'.$row['alias'].'.html');
				die;
			}
		} else if (isset($result['prod_alias']) && !empty($result['prod_alias'])) {
			// print_r($result); die;
			//sita isimt, kai bus padaryti daugiakalbiai aliasai
			$lng_tmp = explode('/', $result[0]);
			
			$lng_for_p = $this->GetPreference('kalbos', 'lt');
			$lng_for_p = explode(',', $lng_for_p);
			$lang = '';
			$page_name = '';
			if (is_array($lng_for_p) && count($lng_for_p) > 0) {
				foreach ($lng_for_p as $val) {
					
					if (ucfirst($this->GetPreference('detail_page_names_field_'.$val)) == ucfirst($lng_tmp[0])) {
						$lang = $val;
					}
				}
			}
			
			
			//iki cia
			$query = "SELECT A.id, B.hierarchy_id FROM ".cms_db_prefix()."module_products AS A LEFT JOIN ".cms_db_prefix()."module_products_prodtohier AS B ON B.product_id = A.id WHERE A.alias = ?";
			$row = $db->GetRow($query, array($result['prod_alias']));
			if (is_array($row) && count($row) > 0) {
				$returnid = $this->GetPreference('detail_page_field_'.$lang);
				if ($returnid > 0) {
					$return['returnid'] = $returnid;
				}
				
				$return['productid'] = $row['id'];
				$return['hierarchyid'] = $row['hierarchy_id'];
				
			}
			
		}
		//print_r($return); die;
		return $return;
	}
	
	function isExistingId($prod_id) {
		$db = $this->GetDb();
		
		$query = "SELECT id FROM ".cms_db_prefix()."module_products WHERE id = ? ";
		$r = $db->GetOne($query, array($prod_id));
		
		if ($r > 0) {
			return true;
		}
		return false;
	}
	
	function uploadImage($prod_id, $field_id) {
		$db = $this->GetDb();
		
		$config = $this->GetConfig();
		
		if (check_login(true) && $field_id > 0 && !empty($prod_id)) {
			//print_r($_FILES);
			if ($_FILES['file']['error'] == 0 && $_FILES['file']['size'] > 0) {
				
				$path = $config['uploads_path'].'/'.$this->GetName().'/product_'.$prod_id.'/';
				$path2 = '/uploads/'.$this->GetName().'/product_'.$prod_id.'/';
				
				$file_t = explode('.', $_FILES['file']['name']);
				$ext = array_pop($file_t);
				$file_t = implode('.', $file_t);
				
				$file_name = munge_string_to_url($file_t, true).'_'.time().'.'.$ext;
				
				umask(0);
				if (!file_exists($path)) {
					mkdir($path, 0777, true);
				}
				
				//echo $path.$file_name;
				move_uploaded_file($_FILES["file"]["tmp_name"], $path.$file_name);
				chmod($path.$file_name, 0777);
				
				if ($this->isExistingId($prod_id)) {
					$query = "SELECT value_".$field_id." as val FROM ".cms_db_prefix()."module_products_fieldvals WHERE product_id = ?";
					$images = $db->GetOne($query, array($prod_id));
					
					if (!empty($images)) {
						$images = unserialize($images);
					} else {
						$images = array();
					}
					
					$images[] = $path2.$file_name;
					
					$images = serialize($images);
					
					$query = "UPDATE ".cms_db_prefix()."module_products_fieldvals SET `value_".$field_id."` = ? WHERE product_id = ? ";
					$db->Execute($query, array($images, $prod_id));
				} else {
					$query = "SELECT id, ordering FROM ".cms_db_prefix()."module_products_images_temp WHERE product_id = ? AND field_id = ? ORDER BY ordering DESC LIMIT 1";
					$max_row = $db->GetRow($query, array($prod_id, $field_id));
					if (is_array($max_row) && $max_row['id'] > 0) {
						$max = intval($max_row['ordering']) + 1;
					} else {
						$max = 0;
					}
					$query = "INSERT INTO ".cms_db_prefix()."module_products_images_temp SET product_id = ?, field_id = ?, value = ?, ordering = ?";
					$db->Execute($query, array($prod_id, $field_id, $path2.$file_name, $max));
				}
				
				return true;
			}
			
		}
		
		return false;
	}
	
	function GetProductsFileList($prod_id, $field_id) {
		$smarty = cmsms()->GetSmarty();
		$config = $this->GetConfig();
		$db = $this->GetDb();
		/*
		
		
		
		*/
		if (check_login(true) && $field_id > 0 && !empty($prod_id)) {
			/*$path = $config['uploads_path'].'/'.$this->GetName().'/product_'.$prod_id.'/';
			$path2 = $config['uploads_url'].'/'.$this->GetName().'/product_'.$prod_id.'/';
			
			if (file_exists($path)) {
				//echo 'zzz';
				if ($handle = opendir($path)) {
					$ret = array();
					while (false !== ($entry = readdir($handle))) {
						if ($entry != "." && $entry != "..") {
							$smarty->assign('image', $path2.$entry);
							$img = $this->ProcessTemplate('admin_image.tpl');
							$ret[] = array('full' => $path2.$entry, 'img' => $img);
						}
					}
					if (count($ret) > 0) {
						return $ret;
					}
					closedir($handle);
				}
			}*/
			if ($this->isExistingId($prod_id)) {
				$query = "SELECT value_".$field_id." as val FROM ".cms_db_prefix()."module_products_fieldvals WHERE product_id = ?";
				$images = $db->GetOne($query, array($prod_id));
				
				if (!empty($images)) {
					$images = unserialize($images);
						
					$ret = array();
					if (is_array($images) && count($images) > 0) {
						foreach ($images as $key => $entry) {
							
							$smarty->assign('image', $entry);
							$img = $this->ProcessTemplate('admin_image.tpl');
							$ret[] = array('full' => $entry, 'img' => $img, 'ordering' => $key);
							
						}
					}
					if (count($ret) > 0) {
						return $ret;
					}
				}
			} else {
				$query = "SELECT value FROM ".cms_db_prefix()."module_products_images_temp WHERE product_id = ? AND field_id = ? ORDER BY ordering ASC";
				$images = $db->GetCol($query, array($prod_id, $field_id));
				
				$ret = array();
				if (is_array($images) && count($images) > 0) {
					foreach ($images as $key => $entry) {
						$smarty->assign('image', $entry);
						$img = $this->ProcessTemplate('admin_image.tpl');
						$ret[] = array('full' => $entry, 'img' => $img, 'ordering' => $key);
					}
				}
				if (count($ret) > 0) {
					return $ret;
				}
			}
		}
		return false;
	}
	
	function ProductSortImages($ser, $prod_id, $field_id) {
		$db = $this->GetDb();
		/*
		print_r($product_id);
		print_r($field_id);*/
		//print_r($ser);
		if (check_login(true) && $field_id > 0 && !empty($prod_id) && is_array($ser) && count($ser) > 0) {
			
			if ($this->isExistingId($prod_id)) {
				$query = "SELECT value_".$field_id." as val FROM ".cms_db_prefix()."module_products_fieldvals WHERE product_id = ?";
				$images = $db->GetOne($query, array($prod_id));
				if (!empty($images)) {
					$images = unserialize($images);
					//print_r($images);
					$new_array = array();
					if (is_array($images) && count($images) > 0) {
						//print_r($ser);
						foreach ($ser as $key => $val) {
							
							$new_array[$key] = $images[$val];
						}
					}
					if (is_array($new_array) && count($new_array)) {
						ksort($new_array);
						
						//print_r($new_array);
						
						$new_array = serialize($new_array);
						
						
						
						$query = "UPDATE ".cms_db_prefix()."module_products_fieldvals SET `value_".$field_id."` = ? WHERE product_id = ? ";
						$db->Execute($query, array($new_array, $prod_id));
						
						return true;
					}
					
				}
				
			} else {
				
				$query = "SELECT id FROM ".cms_db_prefix()."module_products_images_temp WHERE product_id = ? AND field_id = ? ORDER BY ordering ASC";
				$images = $db->GetCol($query, array($prod_id, $field_id));
				
				if (is_array($images) && count($images) > 0) {
					foreach ($ser as $key => $val) {
						
						
						
						$query = "UPDATE ".cms_db_prefix()."module_products_images_temp SET `ordering` = ? WHERE id = ?";
						$db->Execute($query, array($key, $images[$val]));
						
					}
					
					return true;
					
				}
				
				
			}
			
		}
		return false;
	}
	
	function DellProductsFile($file, $prod_id, $field_id) {
		$db = $this->GetDb();
		$config = $this->GetConfig();
		//echo $file.', '.$prod_id.', '.$field_id;
		//print_r($config);
		//echo 'zzz';
		if (check_login(true) && $field_id > 0 && !empty($prod_id)) {
			if (!empty($file)) {
				
				$file_o = $file;
				$file = str_replace('/uploads', $config['uploads_path'] , $file);
				
				@unlink($file);
				
				if ($this->isExistingId($prod_id)) {
					$query = "SELECT value_".$field_id." as val FROM ".cms_db_prefix()."module_products_fieldvals WHERE product_id = ?";
					$images = $db->GetOne($query, array($prod_id));
					if (!empty($images)) {
						$images = unserialize($images);
						
						$new_array = array();
						if (is_array($images) && count($images) > 0) {
							foreach ($images as $key => $val) {
								if ($val != $file_o) {
									$new_array[] = $val;
								}
							}
						}
						
						if (count($new_array) > 0) {
							$new_array = serialize($new_array);
						} else {
							$new_array = '';
						}
						$query = "UPDATE ".cms_db_prefix()."module_products_fieldvals SET `value_".$field_id."` = ? WHERE product_id = ? ";
						$db->Execute($query, array($new_array, $prod_id));
						
						return true;
					}
				} else {
					$query = "DELETE FROM ".cms_db_prefix()."module_products_images_temp WHERE product_id = ? AND field_id = ? AND value = ? LIMIT 1";
					$db->Execute($query, array($prod_id, $field_id, $file_o));
					
					return true;
				}
				
			}
		}
		return false;
	}
	
	
	//gaunamas konkrecios hierarchijos fieldu id sarasas
	//naudojama keliose vietose, redaguoti atsargiai!
	//type: 1 = produkte, 2 = filtre
	function GetHierFields($hierarchy_id, $type = 1) {
		if ($hierarchy_id > 0) {
			$db = $this->GetDb();
			
			$query = "SELECT field_id FROM ".cms_db_prefix()."module_products_fieldtohier WHERE hier_id = ? AND type = ? ORDER BY id ASC";
			$row = $db->GetCol($query, array($hierarchy_id, $type));
			if (is_array($row) && count($row) > 0) {
				return $row;
			}
		}
		return false;
	}
	
	
	function UpdateHierFields($hierarchy_id, $fields, $type = 1) {
		if ($hierarchy_id > 0) {
			$db = $this->GetDb();
			
			$query = "DELETE FROM ".cms_db_prefix()."module_products_fieldtohier WHERE hier_id = ? AND type = ?";
			$db->Execute($query, array($hierarchy_id, $type));
			
			if (is_array($fields) && count($fields) > 0) {
				foreach ($fields as $val) {
					
					$query2 = "INSERT INTO ".cms_db_prefix()."module_products_fieldtohier SET hier_id = ?, field_id = ?, type = ?";
					$db->Execute($query2, array($hierarchy_id, $val, $type));
				}
				return true;
			}
		}
		return false;
	}
	
	function GetFilters($id, $hier_id, $get, $kalba, $main_kalba) {
		$db = $this->GetDb();
		
		$empty_fields = $this->GetPreference('empty_fields', '');
		$empty_fields = explode(',', $empty_fields);
		
		$fields = $this->GetHierFields($hier_id, 2);
		
		/*echo '<pre>';
		print_r($fields);
		echo '</pre>';*/
		if (is_array($fields) && count($fields) > 0) {
			
			$sql = " id = ".implode(" OR id = ", $fields);
			
			$query = "SELECT name FROM ".cms_db_prefix()."module_products_fielddefs WHERE ".$sql." ORDER BY FIELD(id,".implode(',', $fields).")";
			$names = $db->GetCol($query);
			if (is_array($names) && count($names) > 0) {
				$return = array();
				foreach ($names as $val) {
					$field = $this->GetFieldByName($val);
					//print_r($field);
					$field['prompts'] = unserialize($field['prompts']);
					$field['optionslng'] = unserialize($field['optionslng']);
					
					
					
					switch ($field['type']) {
						case 'dropdown':
							$field['optionsbylang'] = array();
							foreach ($field['optionslng'] as $val2) {
								
								if (in_array($val2[$kalba], $empty_fields)) {
									$field['optionsbylang'][$field['prompts'][$kalba]] = $val2[$kalba];
								} else {
									$field['optionsbylang'][$val2[$kalba]] = $val2[$kalba];
								}
							}
							
							if (isset($get['filt_'.$field['name']]) && !empty($get['filt_'.$field['name']])) {
								$selected = $get['filt_'.$field['name']];
							} else {
								$selected = '';
							}
							$field['input'] = $this->CreateInputDropdown($id, 'filt_'.$field['name'], $field['optionsbylang'], -1, $selected, '');
						break;
						
						case 'checkboxgroup';
							$field['optionsbylang'] = array();
							
							if (isset($get['filt_'.$field['name']]) && is_array($get['filt_'.$field['name']]) && count($get['filt_'.$field['name']]) > 0) {
								$field['selected_names'] = $get['filt_'.$field['name']];
							} else {
								$field['selected_names'] = array();
							}
							
							foreach ($field['optionslng'] as $key => $val2) {
								if (!in_array($val2[$kalba], $empty_fields)) {
									
									if (isset($get['filt_'.$field['name']]) && is_array($get['filt_'.$field['name']]) && in_array($val2[$kalba], $get['filt_'.$field['name']])) {
										$selected = $val2[$kalba];
									} else {
										$selected = '';
									}
									
									$field['input'][$key]['title'] = $val2[$kalba];
									$field['input'][$key]['input'] = $this->CreateInputCheckbox($id, 'filt_'.$field['name'].'[]', $val2[$kalba], $selected);
								}
							}
							
							
						break;
					}
					
					$return[] = $field;
					
				}
				if (count($return) > 0) {
					return $return;
				}
			}
		}
		return false;
	}
	
	function GetFieldById($field_id) {
		$field_id = intval($field_id);
		$db = $this->GetDb();
		
		//echo 'zz';
		if ($field_id > 0) {
			$array = $db->GetRow("SELECT * FROM ".cms_db_prefix()."module_products_fielddefs WHERE `id` = ?", array($field_id));
			if (is_array($array) && count($array) > 0) {
				return $array;
			}
		}
		return false;
	}
	
	function isHierRecursion($hier_id) {
		$hier_id = intval($hier_id);
		$db = $this->GetDb();
		
		if ($hier_id > 0) {
			$counter = 0;
			while ($hier_id > 0) {
				$query = "SELECT redirect_to FROM ".cms_db_prefix()."module_products_hierarchy WHERE id = ?";
				$hier_id = $db->GetOne($query, array($hier_id));
				
				if ($counter < 100) {
					$counter++;
				} else {
					return true;
				}
			}
		}
		return false;
	}
	
	function GetCurrentProductId() {
		$db = $this->GetDb();
		
		$path = $_SERVER['REQUEST_URI'];
		$path_t = explode('/', $path);
		$alias = end($path_t);
		$alias = explode('.', $alias);
		$alias = $alias[0];
		if (!empty($alias)) {
			$query = "SELECT id FROM ".cms_db_prefix()."module_products WHERE alias = ?";
			$product_id = $db->GetOne($query, array($alias));
			//echo $db->sql;
			if ($product_id > 0) {
				return $product_id;
			}
		}
		return false;
	}
	
	function orderHierProducts($params) {
		$db = $this->GetDb();
		$order_hierarchy_id = intval($params['order_hierarchy_id']);
		
		if ($order_hierarchy_id > 0 && is_array($params['ser']) && count($params['ser']) > 0 && check_login(true)) {
			
			foreach ($params['ser'] as $key => $val) {
				
				$query1 = "SELECT id FROM ".cms_db_prefix()."module_products_hierordering WHERE product_id = ? AND hier_id = ?";
				$ordering_id = $db->GetOne($query1, array($val, $order_hierarchy_id));
				if ($ordering_id > 0) {
				
					$query = "UPDATE ".cms_db_prefix()."module_products_hierordering SET order_id = ? WHERE id = ?";
					$db->Execute($query, array($key, $ordering_id));
					
				} else {
					
					$query = "INSERT INTO ".cms_db_prefix()."module_products_hierordering SET order_id = ?, product_id = ?, hier_id = ?";
					$db->Execute($query, array($key, $val, $order_hierarchy_id));
					
				}
			}
			return true;
		}
		return false;
		
	}
	
	function getChildrenHier($h_id) {
		$db = $this->GetDb();
		$query = "SELECT id FROM ".cms_db_prefix()."module_products_hierarchy WHERE parent_id = ?";
		$arr = $db->GetArray($query, array($h_id));
		$ret = array($h_id);
		if (is_array($arr) && count($arr) > 0) {
			foreach($arr as $val) {
				$ret2 = $this->getChildrenHier($val['id']);
				$ret = array_merge($ret2, $ret);
			}
		}
		return $ret;
	}
	
	function CreateInputSelectListSortible($id, $name, $items, $selecteditems=array(), $size=3, $addttext='', $multiple = true) {
		$id = cms_htmlentities($id);
		$name = cms_htmlentities($name);
		$size = cms_htmlentities($size);
		$multiple = cms_htmlentities($multiple);

		if( strstr($name,'[]') === FALSE && $multiple === true ) {
			$name.='[]';
		}
		$text = '<select class="cms_select" name="'.$id.$name.'"';
		if ($addttext != '') {
			$text .= ' ' . $addttext;
		}
		if( $multiple ) {
			$text .= ' multiple="multiple" ';
		}
		$text .= 'size="'.$size.'">';
		$count = 0;
		
		$selected_list = array();
		
		foreach ($items as $key=>$value) {
			
			$value = cms_htmlentities($value);
			
			if (!in_array($value, $selecteditems)) {
				$text .= '<option value="'.$value.'"';
				$text .= '>';
				$text .= $key;
				$text .= '</option>';
			} else {
				$text_tmp = '<option value="'.$value.'"';
				
				$text_tmp .= ' ' . 'selected="selected"';
				
				$text_tmp .= '>';
				$text_tmp .= $key;
				$text_tmp .= '</option>';
				
				$index = array_search($value, $selecteditems);
				
				$selected_list[$index] = $text_tmp;
			}
			$count++;
			
		}
		if (is_array($selected_list) && count($selected_list) > 0) {
			ksort($selected_list);
			$text .= implode('', $selected_list);
		}
		$text .= '</select>'."\n";

		return $text;
	}
} // class

# vim:ts=4 sw=4 noet
?>
