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
if( !isset( $gCms ) ) return;

$this->SetCurrentTab('prefs');
if( !$this->CheckPermission('Modify Site Preferences') )
  {
    return;
  }

if( isset($params['setecomhandlers']) )
  {
    $this->AddEventHandler('CGEcommerceBase','OrderUpdated',FALSE);
    $this->SetMessage($this->Lang('msg_eventhandlers_created'));
    $this->RedirectToTab($id);
  }

if( !isset( $params['submit'] ) )
  {
    $this->RedirectToTab($id);
  }

if( isset($params['taxable']) )
  {
    $this->SetPreference('default_taxable',(int)$params['taxable']);
  }
else
  {
    $this->SetPreference('default_taxable',0);
  }

if( isset($params['status']) )
  {
    $this->SetPreference('default_status',$params['status']);
  }
else
  {
    $this->SetPreference('default_status',0);
  }

if( isset($params['detailpage']) )
  {
    $this->SetPreference('detailpage',$params['detailpage']);
  }

if( isset($params['hierpage']) )
  {
    $this->SetPreference('hierpage',$params['hierpage']);
  }
if( isset($params['prettyhierurls']) )
  {
    $this->SetPreference('prettyhierurls',$params['prettyhierurls']);
  }

if( isset($params['sortorder']) )
  {
    $this->SetPreference('sortorder',$params['sortorder']);
  }

if( isset($params['summary_newdefault']) )
  {
    $this->SetPreference('summary_newdefault',(int)$params['summary_newdefault']);
  }

if( isset($params['summary_pagelimit']) )
  {
    $this->SetPreference('summary_pagelimit',(int)$params['summary_pagelimit']);
  }

if( isset($params['sortby']) )
  {
    $this->SetPreference('sortby',$params['sortby']);
  }

if( isset($params['currencysymbol']) )
  {
    $this->SetPreference('products_currencysymbol',trim($params['currencysymbol']));
  }

if( isset($params['weightunits']) )
  {
    $this->SetPreference('products_weightunits',trim($params['weightunits']));
  }

if( isset($params['lengthunits']) )
  {
    $this->SetPreference('products_lengthunits',trim($params['lengthunits']));
  }

if( isset($params['allowed_imagetypes']) )
  {
    $this->SetPreference('allowed_imagetypes',trim($params['allowed_imagetypes']));
  }

if( isset($params['allowed_filetypes']) )
  {
    $this->SetPreference('allowed_filetypes',trim($params['allowed_filetypes']));
  }

if( isset($params['autothumbnail']) )
  {
    $this->SetPreference('autothumbnail',(int)($params['autothumbnail']));
  }
if( isset($params['autothumbnail_size']) )
  {
    $this->SetPreference('auto_thumbnail_size',(int)($params['autothumbnail_size']));
  }

if( isset($params['autopreviewimg']) )
  {
    $this->SetPreference('autopreviewimg',(int)($params['autopreviewimg']));
  }
if( isset($params['autopreviewimg_size']) )
  {
    $this->SetPreference('auto_previewimg_size',(int)($params['autopreviewimg_size']));
  }

if( isset($params['urlprefix']) )
  {
    if( $params['urlprefix'] != '' )
      {
	$this->SetPreference('urlprefix',$params['urlprefix']);
      }
    else
      {
	$this->RemovePreference('urlprefix');
      }
  }

if( isset($params['autowatermark']) )
  {
    $this->SetPreference('autowatermark',$params['autowatermark']);
  }

if( isset($params['deleteproductfiles']) )
  {
    $this->SetPreference('deleteproductfiles',trim($params['deleteproductfiles']));
  }

$this->SetPreference('kalbos', trim($params['kalbos']));

$lng_for_cur = $params['kalbos'];
$lng_for_cur = explode(',', $lng_for_cur);
if (count($lng_for_cur) > 0) {
	foreach($lng_for_cur as $val) {
		$this->SetPreference('curency_field_'.$val, trim($params['curency_field_'.$val]));
		$this->SetPreference('pvm_field_'.$val, trim($params['pvm_field_'.$val]));
		$this->SetPreference('summary_page_field_'.$val, trim($params['summary_page_field_'.$val]));
		$this->SetPreference('summary_page_names_field_'.$val, trim($params['summary_page_names_field_'.$val]));
		$this->SetPreference('detail_page_field_'.$val, trim($params['detail_page_field_'.$val]));
		$this->SetPreference('detail_page_names_field_'.$val, trim($params['detail_page_names_field_'.$val]));
	}
}


$this->SetPreference('price_field', trim($params['price_field']));
$this->SetPreference('empty_fields', trim($params['empty_fields']));
$this->SetPreference('akcija_field', trim($params['akcija_field']));
$this->SetPreference('laukeliu_grupes', trim($params['laukeliu_grupes']));
$this->SetPreference('pavadinimas_field', trim($params['pavadinimas_field']));
$this->SetPreference('use_detailpage_for_search',(int)$params['use_detailpage_for_search']);
$this->SetPreference('usehierpathurls',(int)$params['usehierpathurls']);
$this->SetPreference('prodnotfound',trim($params['prodnotfound']));
$this->SetPreference('prodnotfoundmsg',trim($params['prodnotfoundmsg']));
$this->SetPreference('prodnotfoundpage',trim($params['prodnotfoundpage']));
$this->SetPreference('skurequired',(int)$params['skurequired']);

$this->RedirectToTab($id);

// EOF
?>