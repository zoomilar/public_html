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
if( !isset($gCms) ) exit;
if( !$this->CheckPermission('Modify Products') ) exit;

#Put together a list of current categories...
$entryarray = array();
	
$query = "SELECT * FROM ".cms_db_prefix()."module_products_categories ORDER BY name";
$dbresult = $db->Execute($query);
	
$rowclass = 'row1';
	
while ($dbresult && $row = $dbresult->FetchRow())
  {
    $onerow = new stdClass();
	
    $onerow->id = $row['id'];
    $onerow->name = $this->CreateLink($id, 'editcategory', $returnid, $row['name'], array('catid'=>$row['id']));

    $onerow->fieldslink = $this->CreateImageLink($id,'editcategoryfields',$returnid,
                $this->Lang('edit_category_fields'),
                'database_edit.png',
                array('catid'=>$row['id']));

    $onerow->copylink = $this->CreateLink($id, 'copycategory', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/copy.gif', $this->Lang('copy'),'','','systemicon'), array('catid'=>$row['id']));
    $onerow->editlink = $this->CreateLink($id, 'editcategory', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('catid'=>$row['id']));

    $onerow->deletelink = $this->CreateLink($id, 'deletecategory', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('catid'=>$row['id']), $this->Lang('areyousure'));
	
    $onerow->rowclass = $rowclass;

    $entryarray[] = $onerow;
	
    ($rowclass=="row1"?$rowclass="row2":$rowclass="row1");
  }
	
$this->smarty->assign_by_ref('items', $entryarray);
$this->smarty->assign('itemcount', count($entryarray));
	
#Setup links
$this->smarty->assign('addlink', $this->CreateLink($id, 'addcategory', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/newfolder.gif', $this->Lang('addcategory'),'','','systemicon'), array(), '', false, false, '') .' '. $this->CreateLink($id, 'addcategory', $returnid, $this->Lang('addcategory'), array(), '', false, false, 'class="pageoptions"'));
	
$this->smarty->assign('categorytext', $this->Lang('category'));
	
#Display template
echo $this->ProcessTemplate('categorylist.tpl');
	

#
# EOF
#
?>