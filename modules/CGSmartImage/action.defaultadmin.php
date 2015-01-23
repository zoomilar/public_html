<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGSmartImage (c) 2011 by Robert Campbell (calguy1000@cmsmadesimple.org)
#  
#  An addon module for CMS Made Simple to allow creating image tags in a smart
#  way to optimize performance.
# 
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005-2010 by Ted Kulp (wishy@cmsmadesimple.org)
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
if( !$this->CheckPermission('Modify Site Preferences') ) return;

echo $this->StartTabHeaders();
echo $this->SetTabHeader('aliases',$this->Lang('aliases'));
echo $this->SetTabHeader('responsive',$this->Lang('responsive'));
echo $this->SetTabHeader('embedding',$this->Lang('embedding'));
//echo $this->SetTabHeader('resizing',$this->Lang('resizing'));
echo $this->SetTabHeader('general',$this->Lang('general'));
echo $this->EndTabHeaders();

echo $this->StartTabContent();

echo $this->StartTab('aliases',$params);
include(dirname(__FILE__).'/function.admin_aliases_tab.php');
echo $this->EndTab();

echo $this->StartTab('responsive',$params);
include(dirname(__FILE__).'/function.admin_responsive_tab.php');
echo $this->EndTab();

echo $this->StartTab('embedding',$params);
include(dirname(__FILE__).'/function.admin_embedding_tab.php');
echo $this->EndTab();

// echo $this->StartTab('resizing',$this->Lang('resizing'));
// include(dirname(__FILE__).'/function.admin_resizing_tab.php');
// echo $this->EndTab();

echo $this->StartTab('general',$params);
include(dirname(__FILE__).'/function.admin_general_tab.php');
echo $this->EndTab();

echo $this->EndTabContent();
#
# EOF
#
?>