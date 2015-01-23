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
if( !isset($gCms) ) return;


$contentops = $gCms->GetContentOperations();
$sortorder = $this->GetPreference('sortorder','asc');
$sortby = $this->GetPreference('sortby','product_name');

$smarty->assign('startform',
		$this->CreateFormStart($id,'admin_saveprefs',$returnid));
$smarty->assign('endform',
		$this->CreateFormEnd());
$smarty->assign('submit',
		$this->CreateInputSubmit($id,'submit',$this->Lang('submit')));

$smarty->assign('prompt_detailpage',$this->Lang('prompt_detailpage'));
$smarty->assign('input_detailpage',
		$contentops->CreateHierarchyDropdown('',$this->GetPreference('detailpage'),
					       $id.'detailpage'));

$statuses = array($this->Lang('published')=>'published',
		  $this->Lang('draft')=>'draft',
		  $this->Lang('disabled')=>'disabled');
$smarty->assign('input_status',
		$this->CreateInputDropdown($id,'status',
					   $statuses,-1,
					   $this->GetPreference('default_status','published')));
$smarty->assign('input_taxable',
		//		$this->CreateInputHidden($id,'taxable',0).
		$this->CreateInputCheckbox($id,'taxable',1,
					   $this->GetPreference('default_taxable',1)));

$sortorders = array($this->Lang('ascending')=>'asc',
		    $this->Lang('descending')=>'desc');
$smarty->assign('prompt_summarysortorder',$this->Lang('prompt_summarysortorder'));
$smarty->assign('input_summarysortorder',
		$this->CreateInputDropdown($id,'sortorder',$sortorders,-1,$sortorder));

if( !class_exists('cg_ecomm') )
  {
    $smarty->assign('prompt_currencysymbol',$this->Lang('prompt_currencysymbol'));
    $smarty->assign('input_currencysymbol',
		    $this->CreateInputText($id,'currencysymbol',
					   $this->GetPreference('products_currencysymbol')));
    
    $smarty->assign('prompt_weightunits',$this->Lang('prompt_weightunits'));
    $smarty->assign('input_weightunits',
		    $this->CreateInputText($id,'weightunits',
					   $this->GetPreference('products_weightunits')));

    $smarty->assign('prompt_lengthunits',$this->Lang('prompt_lengthunits'));
    $opts = array($this->Lang('inches')=>'in',
		  $this->Lang('centimeters')=>'cm');
    $smarty->assign('input_lengthunits',
		    $this->CreateInputDropdown($id,'lengthunits',$opts,-1,
					       $this->GetPreference('products_lengthunits')));
  }


$smarty->assign('input_allowed_imagetypes',
		$this->CreateInputText($id,'allowed_imagetypes',
				       $this->GetPreference('allowed_imagetypes'),50,255));

$smarty->assign('input_allowed_filetypes',
		$this->CreateInputText($id,'allowed_filetypes',
				       $this->GetPreference('allowed_filetypes'),50,255));

$smarty->assign('input_autothumbnail',
		$this->CreateInputYesNoDropdown($id,'autothumbnail',
						$this->GetPreference('autothumbnail')));

$smarty->assign('auto_thumbnail_size',
		$this->GetPreference('auto_thumbnail_size',75));

$smarty->assign('input_autopreviewimg',
		$this->CreateInputYesNoDropdown($id,'autopreviewimg',
						$this->GetPreference('autopreviewimg')));

$smarty->assign('auto_previewimg_size',
		$this->GetPreference('auto_previewimg_size',150));

$smarty->assign('urlprefix',$this->GetPreference('urlprefix',''));

$smarty->assign('prompt_kalbos',$this->Lang('prompt_kalbos'));

$smarty->assign('input_kalbos',
		$this->CreateInputText($id,'kalbos',
				       $this->GetPreference('kalbos', 'lt'),50,255));

/*					   
					   
$smarty->assign('prompt_curency_field',$this->Lang('prompt_curency_field'));

$smarty->assign('input_curency_field',
		$this->CreateInputText($id,'curency_field',
				       $this->GetPreference('curency_field', ''),50,255));
*/

$lng_for_cur = $this->GetPreference('kalbos', 'lt');
$lng_for_cur = explode(',', $lng_for_cur);

if (count($lng_for_cur) > 0) {
	$cur_arr = array();
	$pvm_arr = array();
	foreach ($lng_for_cur as $val) {
		$cur_arr[] = array('name' => $this->Lang('prompt_curency_field').' '.$val, 'value' => $this->CreateInputText($id,'curency_field_'.$val, $this->GetPreference('curency_field_'.$val, ''),50,255));
		$pvm_arr[] = array('name' => $this->Lang('prompt_pvm_field').' '.$val, 'value' => $this->CreateInputText($id,'pvm_field_'.$val, $this->GetPreference('pvm_field_'.$val, ''),50,255));
		
		$summary_pages[] = array('name' => $this->Lang('prompt_summary_page_field').' '.$val, 'value' => $this->CreateInputText($id,'summary_page_field_'.$val, $this->GetPreference('summary_page_field_'.$val, ''),50,255));
		
		$summary_page_names[] = array('name' => $this->Lang('prompt_summary_page_names_field').' '.$val, 'value' => $this->CreateInputText($id,'summary_page_names_field_'.$val, $this->GetPreference('summary_page_names_field_'.$val, ''),50,255));
		
		$detail_pages[] = array('name' => $this->Lang('prompt_detail_page_field').' '.$val, 'value' => $this->CreateInputText($id,'detail_page_field_'.$val, $this->GetPreference('detail_page_field_'.$val, ''),50,255));
		
		$detail_page_names[] = array('name' => $this->Lang('prompt_detail_page_names_field').' '.$val, 'value' => $this->CreateInputText($id,'detail_page_names_field_'.$val, $this->GetPreference('detail_page_names_field_'.$val, ''),50,255));
		
		
	}
	if (count($cur_arr) > 0) {
		$smarty->assign('input_curency_field', $cur_arr);
	}
	if (count($pvm_arr) > 0) {
		$smarty->assign('input_pvm_field', $pvm_arr);
	}
	
	if (count($summary_pages) > 0) {
		$smarty->assign('input_summary_page_field', $summary_pages);
	}
	if (count($summary_page_names) > 0) {
		$smarty->assign('input_summary_page_names_field', $summary_page_names);
	}
	if (count($detail_pages) > 0) {
		$smarty->assign('input_detail_page_field', $detail_pages);
	}
	if (count($detail_page_names) > 0) {
		$smarty->assign('input_detail_page_names_field', $detail_page_names);
	}
}

					   
$smarty->assign('prompt_empty_fields',$this->Lang('prompt_empty_fields'));

$smarty->assign('input_empty_fields',
		$this->CreateInputText($id,'empty_fields',
				       $this->GetPreference('empty_fields', ''),50,255));
					   
$smarty->assign('prompt_price_field',$this->Lang('prompt_price_field'));

$smarty->assign('input_price_field',
		$this->CreateInputText($id,'price_field',
				       $this->GetPreference('price_field', ''),50,255));
					   
					   
$smarty->assign('prompt_akcija_field',$this->Lang('prompt_akcija_field'));

$smarty->assign('input_akcija_field',
		$this->CreateInputText($id,'akcija_field',
				       $this->GetPreference('akcija_field', ''),50,255));
		
		
$smarty->assign('prompt_laukeliu_grupes',$this->Lang('prompt_laukeliu_grupes'));

$smarty->assign('input_laukeliu_grupes',
		$this->CreateInputText($id,'laukeliu_grupes',
				       $this->GetPreference('laukeliu_grupes', ''),50,255));

				
				
$smarty->assign('prompt_pavadinimas_field',$this->Lang('prompt_pavadinimas_field'));

$smarty->assign('input_pavadinimas_field',
		$this->CreateInputText($id,'pavadinimas_field',
				       $this->GetPreference('pavadinimas_field', ''),50,255));

					   
$opts = array();
$opts[$this->Lang('none')] = 'none';
$opts[$this->Lang('automatic')] = 'auto';
$opts[$this->Lang('adjustable')] = 'adjustable';
$smarty->assign('input_autowatermark',
                $this->CreateInputDropdown($id,'autowatermark',$opts,-1,
                   $this->GetPreference('autowatermark')));

$smarty->assign('summary_newdefault',$this->GetPreference('summary_newdefault',0));
$smarty->assign('summary_pagelimit',$this->GetPreference('summary_pagelimit',10000));

$sortings = array(
	$this->Lang('productname')=>'product_name',
	$this->Lang('price')=>'price',
	$this->Lang('createddate')=>'create_date',
	$this->Lang('modifieddate')=>'modified_date',
	$this->Lang('random')=>'random',
	$this->Lang('status')=>'status',
	$this->Lang('order_hierarchy')=>'order_hierarchy'
);
$smarty->assign('prompt_summarysorting',$this->Lang('prompt_summarysorting'));
$smarty->assign('input_summarysorting',
		$this->CreateInputDropdown($id,'sortby',$sortings,-1,$sortby));

$smarty->assign('input_deleteproductfiles',
		$this->CreateInputYesNoDropdown($id,'deleteproductfiles',
						$this->GetPreference('deleteproductfiles')));

$smarty->assign('input_usehierpathurls',
		$this->CreateInputYesNoDropdown($id,'usehierpathurls',
						$this->GetPreference('usehierpathurls',0)));

$smarty->assign('input_use_detailpage_for_search',
		$this->CreateInputYesNoDropdown($id,'use_detailpage_for_search',
						$this->GetPreference('use_detailpage_for_search',0)));

$smarty->assign('input_hierpage',
		$contentops->CreateHierarchyDropdown('',$this->GetPreference('hierpage'),
					       $id.'hierpage'));
$smarty->assign('prettyhierurls',$this->GetPreference('prettyhierurls',0));

$notfound_opts = array();
$notfound_opts['do404'] = $this->Lang('prompt_notfound_404');
$notfound_opts['do301'] = $this->Lang('prompt_notfound_301');
$notfound_opts['domsg'] = $this->Lang('prompt_notfound_errormsg');
$smarty->assign('notfound_opts',$notfound_opts);
$smarty->assign('prodnotfound',$this->GetPreference('prodnotfound','domsg'));
$smarty->assign('prodnotfoundmsg',$this->GetPreference('prodnotfoundmsg',$this->Lang('error_product_notfound')));
$smarty->assign('input_prodnotfoundpage',
		$contentops->CreateHierarchyDropdown('',$this->GetPreference('prodnotfoundpage',-1),$id.'prodnotfoundpage'));

$smarty->assign('skurequired',$this->GetPreference('skurequired',0));

echo $this->ProcessTemplate('prefs.tpl');

// EOF
?>
