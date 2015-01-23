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
$this->SetCurrentTab('general');

if( isset($params['submit']) )
  {
    $this->SetPreference('croptofit_default_loc',trim($params['croptofit_default_loc']));
    $this->SetPreference('cache_age',(int)$params['cache_age']);
    $this->SetPreference('cache_path',$params['cache_path']);
    $this->SetPreference('image_url_prefix',trim($params['image_url_prefix']));
    $this->SetPreference('image_url_hascachedir',(isset($params['image_url_hascachedir']))?(int)$params['image_url_hascachedir']:0);
    $this->SetMessage($this->Lang('msg_prefsupdated'));
  }
else if( isset($params['clear_now']) )
  {
    // clear all files from cache dir older than N days
    try
      {
	$this->SetPreference('cache_age',(int)$params['cache_age']);
	$n_removed = $this->clear_cached_files();
	$this->SetMessage($this->Lang('msg_cachecleaned',$n_removed));
	$this->Audit('',$this->Lang('act_cachecleaned'),$this->Lang('msg_cachecleaned',$n_removed));
      }
    catch( Exception $e )
      {
	$this->SetError($e->getMessage());
      }
  }
else if( isset($params['clear_all']) )
  {
    // just nuke the cache directory completely.
    $config = cmsms()->GetConfig();
    //$dir = $config['uploads_path'].'/_'.$this->GetName();
	$cache_path = $this->GetPreference('cache_path', cms_join_path('uploads', '_'.$this->GetName()));
	$dir = cms_join_path($config['root_path'], $cache_path);	
    cge_dir::recursive_rmdir($dir);
    $this->SetMessage($this->Lang('msg_cacheremoved'));
  }

$this->RedirectToTab($id);

#
# EOF
#
?>