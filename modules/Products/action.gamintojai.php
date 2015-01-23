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

$path = $gCms->config['root_path'].'/languages/'.$kalba.'.conf';
if(is_file($path)) {
	$smarty->config_load($path);
	$langfile = $smarty->get_config_vars();
}

$thetemplate = 'detail_gamintojai';
if( isset($params['gamintojaitemplate'] ) )
  {
    $thetemplate = 'detail_'.$params['gamintojaitemplate'];
  }


//gamintojai!!!
global $manufacturers_field_name;
$manufacturers_field_name = 'gamintojai';

$main_manuf = $this->getManufacturers(0, $manufacturers_field_name, $kalba, true);
$manufacturer_page = $this->findManufacturerPage();

//echo $manufacturer_page;

//echo $this->CreatePrettyLink($id,'hierarchy',$langfile['summary_products'],'',array('parent'=>$manufacturer_page),'',true);

foreach ($main_manuf as $kk => $val) {
	$main_manuf[$kk]['url'] = $this->CreatePrettyLink('cntnt01','default',$langfile['summary_products'],'',array('hierarchyid' => $manufacturer_page),'',true).'?cntnt01filter1='.$val['value'];
}

/*
echo '<pre>';
print_r($main_manuf);
echo '</pre>';
*/
$smarty->assign('main_manuf', $main_manuf);

//
// Process the template
//
echo $this->ProcessTemplateFromDatabase($thetemplate);

#
# EOF
#
?>
