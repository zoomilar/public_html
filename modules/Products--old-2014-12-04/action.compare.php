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

$thetemplate = 'detail_compare';
if( isset($params['comparetemplate'] ) )
  {
    $thetemplate = 'detail_'.$params['comparetemplate'];
  }

global $gCms;
$config = $gCms->GetConfig();

$prods = $this->getCompareProd();

if ($prods == false) {
	$smarty->assign('redirect_f', 1);
}
/*
echo '<pre>';
print_r($prods);
echo '</pre>';
*/

function sort_this($a, $b) {
	//echo $a.' '.$b.'<br/>';
	if ($a == $b) {
        return 1;
    }
    return ($a < $b) ? 1 : -1;
}


$pagal_ka_luginam1 = $this->getFieldsByGroup('Įvertinimai');

/*
$pagal_ka_luginam1 = array(
	0 => 'foto_dydis',
	1 => 'funkcijos_kaina',
	2 => 'kategorija',
	3 => 'dxomark_ivertinimas',
);*/

$pirmumas_1 = array();

if (count($pagal_ka_luginam1) > 0) {
	foreach ($prods as $kk => $vv) {
		foreach ($pagal_ka_luginam1 as $kk2 => $vv2) {
			$cc = '';
			if (is_array($vv->fields[$vv2]->value)) {
				$cc = $vv->fields[$vv2]->value[$kalba];
			} else {
				$cc = $vv->fields[$vv2]->value;
			}
			if (!empty($cc)) {
				
				if (($cc == $prods[$kk+1]->fields[$vv2]->value[$kalba] && !empty($prods[$kk+1]->fields[$vv2]->value[$kalba])) || ($cc == $prods[$kk+1]->fields[$vv2]->value && !empty($prods[$kk+1]->fields[$vv2]->value))) {
					if (isset($pirmumas_1[$kk2])) {
						$pirmumas_1[$kk2] = $pirmumas_1[$kk2]+2;
					} else {
						$pirmumas_1[$kk2] = 2;
					}
				}
				if (isset($pirmumas_1[$kk2])) {
					$pirmumas_1[$kk2]++;
				} else {
					$pirmumas_1[$kk2] = 1;
				}
			}
		}
	}
}
uasort($pirmumas_1, 'sort_this');
/*echo '<pre>';
print_r($pirmumas_1);
echo '</pre>';*/

$pagal_ka_luginam2 = $this->getFieldsByGroup('Parametrai');
/*
$pagal_ka_luginam2 = array(
	0 => 'vaizdo_taskai',
	1 => 'jutiklio_dydis',
	2 => 'vaizdo_santykis',
	3 => 'vaizdo_dydis',
	4 => 'islaikymas'
);*/

$pirmumas_2 = array();
if (count($pagal_ka_luginam2) > 0) {
	foreach ($prods as $kk => $vv) {
		foreach ($pagal_ka_luginam2 as $kk2 => $vv2) {
			$cc = '';
			if (is_array($vv->fields[$vv2]->value)) {
				$cc = $vv->fields[$vv2]->value[$kalba];
			} else {
				$cc = $vv->fields[$vv2]->value;
			}
			
			if (!empty($cc)) {
				
				if (($cc == $prods[$kk+1]->fields[$vv2]->value[$kalba] && !empty($prods[$kk+1]->fields[$vv2]->value[$kalba])) || ($cc == $prods[$kk+1]->fields[$vv2]->value && !empty($prods[$kk+1]->fields[$vv2]->value))) {
					if (isset($pirmumas_2[$kk2])) {
						$pirmumas_2[$kk2] = $pirmumas_2[$kk2]+2;
					} else {
						$pirmumas_2[$kk2] = 2;
					}
				}
				
				if (isset($pirmumas_2[$kk2])) {
					$pirmumas_2[$kk2]++;
				} else {
					$pirmumas_2[$kk2] = 1;
				}
			}
		}
	}
}


uasort($pirmumas_2, 'sort_this');
/*echo '<pre>';
print_r($pirmumas_2);
echo '</pre>';*/

if ($_SESSION['hier_url']) {
	
	$parms['hierarchyid'] = $_SESSION['hier_url'][0];
	$summarypage = $_SESSION['hier_url'][1];
	
	$back_url = $this->CreatePrettyLink('cntnt01','default',$summarypage,'',$parms,'',true);
	
} else {
	$back_url = '#';
}

$smarty->assign('back_url', $back_url);

$smarty->assign('pagal_ka_luginam1', $pagal_ka_luginam1);
$smarty->assign('pirmumas_1', $pirmumas_1);

$smarty->assign('pagal_ka_luginam2', $pagal_ka_luginam2);
$smarty->assign('pirmumas_2', $pirmumas_2);

$smarty->assign('prods', $prods);
$smarty->assign('counter', 2);

echo $this->ProcessTemplateFromDatabase($thetemplate);


?>