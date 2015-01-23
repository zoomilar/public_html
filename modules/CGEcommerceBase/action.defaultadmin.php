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

echo $this->StartTabHeaders();
echo $this->SetTabHeader('myinfo',$this->Lang('tab_myinfo_settings'));
echo $this->SetTabHeader('general',$this->Lang('tab_general_settings'));
echo $this->SetTabHeader('policy',$this->Lang('tab_policy'));
echo $this->SetTabHeader('suppliers',$this->Lang('tab_supplier_settings'));
echo $this->SetTabHeader('cart',$this->Lang('tab_cart_settings'));
echo $this->SetTabheader('taxes',$this->Lang('tab_tax_settings'));
//echo $this->SetTabHeader('packaging',$this->Lang('tab_packaging_settings'));
echo $this->SetTabHeader('shipping',$this->Lang('tab_shipping_settings'));
echo $this->SetTabHeader('promotions',$this->Lang('tab_promotion_settings'));
echo $this->SetTabHeader('payment',$this->Lang('tab_payment_settings'));
echo $this->EndTabHeaders();

echo $this->StartTabContent();
echo $this->StartTab('myinfo');
include dirname(__FILE__).'/function.admin_myinfo_tab.php';
echo $this->EndTab();

echo $this->StartTab('general');
include dirname(__FILE__).'/function.admin_general_tab.php';
echo $this->EndTab();

echo $this->StartTab('policy');
include dirname(__FILE__).'/function.admin_policy_tab.php';
echo $this->EndTab();

echo $this->StartTab('suppliers');
include dirname(__FILE__).'/function.admin_suppliers_tab.php';
echo $this->EndTab();

echo $this->StartTab('cart');
include dirname(__FILE__).'/function.admin_cart_tab.php';
echo $this->EndTab();

echo $this->StartTab('taxes');
include dirname(__FILE__).'/function.admin_taxes_tab.php';
echo $this->EndTab();

// echo $this->StartTab('packaging');
// include dirname(__FILE__).'/function.admin_packaging_tab.php';
// echo $this->EndTab();

echo $this->StartTab('shipping');
include dirname(__FILE__).'/function.admin_shipping_tab.php';
echo $this->EndTab();

echo $this->StartTab('promotions');
include dirname(__FILE__).'/function.admin_promotions_tab.php';
echo $this->EndTab();

echo $this->StartTab('payment');
include dirname(__FILE__).'/function.admin_payments_tab.php';
echo $this->EndTab();

echo $this->EndTabContent();

#
# EOF
#
?>