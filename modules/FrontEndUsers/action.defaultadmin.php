<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: FrontEndUsers (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow management of frontend
#  users, and their login process within a CMS Made Simple powered 
#  website.
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


//////////////////////////////////////////////////////////////////////
// DO THE ACTION
//////////////////////////////////////////////////////////////////////

if (! $this->_HasSufficientPermissions())  {
  echo "Breaking an entry, are we?";
  return;
 }

$db = $this->GetDb();
if( $this->_HasSufficientPermissions('siteprefs') ||
    $this->_HasSufficientPermissions('templates') ) {
  echo '<div class="pageoverflow" style="text-align: right; width: 80%;">';
  if( $this->_HasSufficientPermissions('siteprefs') ) {
    echo $this->CreateImageLink($id,'admin_settings',$returnid,
				$this->Lang('lbl_settings'),
				'icons/topfiles/preferences.gif',array(),'','',false);
  }
  if( $this->_HasSufficientPermissions('templates') ) {
    echo $this->CreateImageLink($id,'admin_templates',$returnid,
				$this->Lang('lbl_templates'),
				'icons/topfiles/template.gif',array(),'','',false);
  }
  echo '</div>';
}

// the tabs
echo $this->StartTabHeaders();

if( $this->_HasSufficientPermissions('properties') ) {
  echo $this->SetTabHeader( 'properties', $this->Lang('user_properties'));
}
if( $this->_HasSufficientPermissions('groups') ) {
  echo $this->SetTabHeader( 'groups', $this->Lang('groups'));
}
if( $this->_HasSufficientPermissions('users') ) {
  echo $this->SetTabHeader( 'users', $this->Lang('users'));
  echo $this->SetTabHeader( 'userhistory', $this->Lang('userhistory'));
 // echo $this->SetTabHeader( 'usermessages', $this->Lang('usermessages'));
  echo $this->SetTabHeader( 'admin', $this->Lang('admin'));
}
echo $this->EndTabHeaders();

// Thecontent of the tabs
echo $this->StartTabContent();

if( $this->_HasSufficientPermissions('properties') ) {
  echo $this->StartTab('properties',$params);
  include(dirname(__FILE__).'/function.admin_propertiestab.php');
  echo $this->EndTab();
}
    
if( $this->_HasSufficientPermissions('groups') ) {
  echo $this->StartTab('groups',$params);
  include(dirname(__FILE__).'/function.admin_groupstab.php');
  echo $this->EndTab();
}
if( $this->_HasSufficientPermissions('users') ) {
  echo $this->StartTab('users',$params);
  include(dirname(__FILE__).'/function.admin_userstab.php');
  echo $this->EndTab();
  
  echo $this->StartTab('userhistory',$params);
  include(dirname(__FILE__).'/action.userhistory.php');
  echo $this->EndTab();
  
 /* echo $this->StartTab('`',$params);
  include(dirname(__FILE__).'/function.usermessages.php');
  echo $this->EndTab();*/
  
  echo $this->StartTab('admin',$params);
  include(dirname(__FILE__).'/function.admin_admintab.php');
  echo $this->EndTab();
}

echo $this->EndTabContent();

?>