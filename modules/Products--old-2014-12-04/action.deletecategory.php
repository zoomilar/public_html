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
$this->SetCurrentTab('categories');
$config = $gCms->GetConfig();
if (!$this->CheckPermission('Modify Products'))
{
	echo $this->ShowErrors($this->Lang('needpermission', array('Modify Products')));
	return;
}
if( !isset($params['catid']) )
{
  echo $this->ShowErrors($this->Lang('error_missingparam'));
  return;
}
$catid = (int)$params['catid'];

// Get the category details
$query = 'SELECT * FROM '.cms_db_prefix().'module_products_categories WHERE id = ?';
$row = $db->GetRow($query, array( $catid));

// Now remove any category fields
$query - 'SELECT * FROM '.cms_db_prefix().'module_products_category_fields WHERE category_id = ?';
$results = $db->GetArray($query,array($catid));
foreach( $results as $one )
{
  switch($one['field_type'])
    {
    case 'image':
    case 'file':
      $files = array($row['field_value'],'thumb_'.$row['field_value'],'preview_'.$row['field_value']);
      foreach( $files as $one )
	{
	  $fn = cms_join_path($config['uploads_path'],$this->GetName(),'categories',$catid,$one);
	  if( file_exists($fn) )
	    {
	      @unlink($fn);
	    }
	}
      break;
    }
}
$query = 'DELETE FROM '.cms_db_prefix().'module_products_category_fields WHERE category_id = ?';
$db->Execute($query,array($catid));

//Now remove the category
$query = "DELETE FROM ".cms_db_prefix()."module_products_categories WHERE id = ?";
$db->Execute($query, array($catid));

//And remove it from any entries
$query = "DELETE FROM module_products_product_categories WHERE category_id = ?";
$db->Execute($query, array($catid));

$this->RedirectToTab($id);

?>